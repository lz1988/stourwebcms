<?php   if(!defined('SLINEINC')) exit("Request Error!");
/**
 * 模板类
 *
 * @version        $Id: STTag.class.php
 * @package        Stourweb.Libraries
 * @copyright      Copyright (c) 2008- 2014, Stourweb, Inc.
 * @link           http://www.stourweb.com
 */

class STTag
{
    var $IsReplace=FALSE; //标记是否已被替代，供解析器使用
    var $TagName="";      //标记名称
    var $InnerText="";    //标记之间的文本
    var $StartPos=0;      //标记起始位置
    var $EndPos=0;        //标记结束位置
    var $CAttribute="";   //标记属性描述,即是class STAttribute
    var $TagValue="";     //标记的值
    var $TagID = 0;

    /**
     *  获取标记的名称和值
     *
     * @access    public
     * @return    string
     */
    function GetName()
    {
        return strtolower($this->TagName);
    }

    /**
     *  获取值
     *
     * @access    public
     * @return    string
     */
    function GetValue()
    {
        return $this->TagValue;
    }

    //下面两个成员函数仅是为了兼容旧版
    function GetTagName()
    {
        return strtolower($this->TagName);
    }

    function GetTagValue()
    {
        return $this->TagValue;
    }

    //获取标记的指定属性
    function IsAttribute($str)
    {
        return $this->CAttribute->IsAttribute($str);
    }

    function GetAttribute($str)
    {
        return $this->CAttribute->GetAtt($str);
    }

    function GetAtt($str)
    {
        return $this->CAttribute->GetAtt($str);
    }

    function GetInnerText()
    {
        return $this->InnerText;
    }
}

/**
 * STTagParse 思途标签解析类
 * @package          STTagParse
 * @subpackage       Stourweb.Libraries
 * @link             http://www.stourweb.com
 */
class STTagParse
{
    var $NameSpace = 'sline';   //标记的名字空间
    var $TagStartWord = '{';   //标记起始
    var $TagEndWord = '}';     //标记结束
    var $TagMaxLen = 64;       //标记名称的最大值
    var $CharToLow = TRUE;     // TRUE表示对属性和标记名称不区分大小写
    var $IsCache = FALSE;      //是否使用缓冲
    var $TempMkTime = 0;
    var $CacheFile = '';
    var $SourceString = '';    //模板字符串
    var $CTags = '';           //标记集合
    var $Count = -1;           //$Tags标记个数
    var $refObj = '';          //引用当前模板类的对象
    var $templetTagDir;//用户模板标签

    function __construct()
    {
        if(!isset($GLOBALS['cfg_tplcache']))
        {
            $GLOBALS['cfg_tplcache'] = 'N';
        }
        if($GLOBALS['cfg_tplcache']=='Y')
        {
            $this->IsCache = TRUE;
        }
        else
        {
            $this->IsCache = FALSE;
        }
        $this->NameSpace = 'sline';
        $this->TagStartWord = '{';
        $this->TagEndWord = '}';
        $this->TagMaxLen = 64;
        $this->CharToLow = TRUE;
        $this->SourceString = '';
        $this->CTags = Array();
        $this->Count = -1;
        $this->TempMkTime = 0;
        $this->CacheFile = '';
    }

    function STTagParse()
    {
        $this->__construct();
    }

    /**
     *  设置标记的命名空间，默认为sline
     *
     * @access    public
     * @param     string   $str   字符串
     * @param     string   $s   开始标记
     * @param     string   $e   结束标记
     * @return    void
     */
    function SetNameSpace($str, $s="{", $e="}")
    {
        $this->NameSpace = strtolower($str);
        $this->TagStartWord = $s;
        $this->TagEndWord = $e;
    }

    /**
     *  重置成员变量或Clear
     *
     * @access    public
     * @return    void
     */
    function SetDefault()
    {
        $this->SourceString = '';
        $this->CTags = '';
        $this->Count=-1;
    }
    
    /**
     *  强制引用
     *
     * @access    public
     * @param     object  $refObj  隶属对象
     * @return    void
     */
    function SetRefObj(&$refObj)
    {
        $this->refObj = $refObj;
    }

    function GetCount()
    {
        return $this->Count+1;
    }

    function Clear()
    {
        $this->SetDefault();
    }

    /**
     *  检测模板缓存
     *
     * @access    public
     * @param     string   $filename  文件名称
     * @return    string
     */
    function LoadCache($filename)
    {
        global $cfg_tplcache,$cfg_tplcache_dir;
        if(!$this->IsCache)
        {
            return FALSE;
        }
        $cdir = dirname($filename);
        $cachedir = SLINEROOT.$cfg_tplcache_dir;
        $ckfile = str_replace($cdir,'',$filename).substr(md5($filename),0,16).'.inc';
        $ckfullfile = $cachedir.'/'.$ckfile;
        $ckfullfile_t = $cachedir.'/'.$ckfile.'.txt';
        $this->CacheFile = $ckfullfile;
        $this->TempMkTime = filemtime($filename);
        if(!file_exists($ckfullfile)||!file_exists($ckfullfile_t))
        {
            return FALSE;
        }

        //检测模板最后更新时间
        $fp = fopen($ckfullfile_t,'r');
        $time_info = trim(fgets($fp,64));
        fclose($fp);
        if($time_info != $this->TempMkTime)
        {
            return FALSE;
        }

        //引入缓冲数组
        include($this->CacheFile);

        //把缓冲数组内容读入类
        if( isset($z) && is_array($z) )
        {
            foreach($z as $k=>$v)
            {
                $this->Count++;
                $ctag = new STTAg();
                $ctag->CAttribute = new STAttribute();
                $ctag->IsReplace = FALSE;
                $ctag->TagName = $v[0];
                $ctag->InnerText = $v[1];
                $ctag->StartPos = $v[2];
                $ctag->EndPos = $v[3];
                $ctag->TagValue = '';
                $ctag->TagID = $k;
                if(isset($v[4]) && is_array($v[4]))
                {
                    $i = 0;
                    foreach($v[4] as $k=>$v)
                    {
                        $ctag->CAttribute->Count++;
                        $ctag->CAttribute->Items[$k]=$v;
                    }
                }
                $this->CTags[$this->Count] = $ctag;
            }
        }
        else
        {
            //模板没有缓冲数组
            $this->CTags = '';
            $this->Count = -1;
        }
        return TRUE;
    }

    /**
     *  写入缓存
     *
     * @access    public
     * @param     string
     * @return    string
     */
    function SaveCache()
    {
        $fp = fopen($this->CacheFile.'.txt',"w");
        fwrite($fp,$this->TempMkTime."\n");
        fclose($fp);
        $fp = fopen($this->CacheFile,"w");
        flock($fp,3);
        fwrite($fp,'<'.'?php'."\r\n");
        if(is_array($this->CTags))
        {
            foreach($this->CTags as $tid=>$ctag)
            {
                $arrayValue = 'Array("'.$ctag->TagName.'",';
                $arrayValue .= '"'.str_replace('$','\$',str_replace("\r","\\r",str_replace("\n","\\n",str_replace('"','\"',str_replace("\\","\\\\",$ctag->InnerText))))).'"';
                $arrayValue .= ",{$ctag->StartPos},{$ctag->EndPos});";
                fwrite($fp,"\$z[$tid]={$arrayValue}\n");
                if(is_array($ctag->CAttribute->Items))
                {
                    foreach($ctag->CAttribute->Items as $k=>$v)
                    {
                        $v = str_replace("\\","\\\\",$v);
                        $v = str_replace('"',"\\".'"',$v);
                        $v = str_replace('$','\$',$v);
                        $k = trim(str_replace("'","",$k));
                        if($k=="")
                        {
                            continue;
                        }
                        if($k!='tagname')
                        {
                            fwrite($fp,"\$z[$tid][4]['$k']=\"$v\";\n");
                        }
                    }
                }
            }
        }
        fwrite($fp,"\n".'?'.'>');
        fclose($fp);
    }

    /**
     *  载入模板文件
     *
     * @access    public
     * @param     string   $filename  文件名称
     * @return    string
     */
    function LoadTemplate($filename,$tagdir='')
    {
        $this->SetDefault();
        if(!file_exists($filename))
        {
           
			
			$this->SourceString = " $filename Not Found! ";
            $this->ParseTemplet();
        }
        else
        {
            $fp = @fopen($filename, "r");
            while($line = fgets($fp,1024))
            {
                $this->SourceString .= $line;
            }
            fclose($fp);
            if($this->LoadCache($filename))
            {
                return '';
            }
            else
            {
                $this->ParseTemplet();
            }
        }
        $this->templetTagDir = empty($tagdir) ? dirname($filename).'/taglib' :$tagdir;

    }

    // 仅用于兼容旧版本
    function LoadTemplet($filename)
    {
        $this->LoadTemplate($filename);
    }

    // 仅用于兼容旧版本
    function LoadFile($filename)
    {
        $this->LoadTemplate($filename);
    }

    /**
     *  载入模板字符串
     *
     * @access    public
     * @param     string  $str  字符串
     * @return    void
     */
    function LoadSource($str,$tagdir='')
    {
        /*
        $this->SetDefault();
        $this->SourceString = $str;
        $this->IsCache = FALSE;
        $this->ParseTemplet();
        */
        //优化模板字符串存取读取方式
        $filename = SLINEDATA.'/tplcache/'.md5($str).'.inc';

        if( !is_file($filename) )
        {
            file_put_contents($filename, $str);
        }
        $this->LoadTemplate($filename,$tagdir);
    }

    function LoadString($str)
    {
        $this->LoadSource($str);
    }

    /**
     *  获得指定名称的Tag的ID(如果有多个同名的Tag,则取没有被取代为内容的第一个Tag)
     *
     * @access    public
     * @param     string  $str  字符串
     * @return    int
     */
    function GetTagID($str)
    {
        if($this->Count==-1)
        {
            return -1;
        }
        if($this->CharToLow)
        {
            $str=strtolower($str);
        }
        foreach($this->CTags as $id=>$CTag)
        {
            if($CTag->TagName==$str && !$CTag->IsReplace)
            {
                return $id;
                break;
            }
        }
        return -1;
    }

    /**
     *  获得指定名称的CTag数据类(如果有多个同名的Tag,则取没有被分配内容的第一个Tag)
     *
     * @access    public
     * @param     string  $str  字符串
     * @return    string
     */
    function GetTag($str)
    {
        if($this->Count==-1)
        {
            return '';
        }
        if($this->CharToLow)
        {
            $str=strtolower($str);
        }
        foreach($this->CTags as $id=>$CTag)
        {
            if($CTag->TagName==$str && !$CTag->IsReplace)
            {
                return $CTag;
                break;
            }
        }
        return '';
    }

    /**
     *  通过名称获取标记
     *
     * @access    public
     * @param     string  $str  字符串
     * @return    string
     */
    function GetTagByName($str)
    {
        return $this->GetTag($str);
    }

    /**
     *  获得指定ID的CTag数据类
     *
     * @access    public
     * @param     string  标签id
     * @return    string
     */
    function GetTagByID($id)
    {
        if(isset($this->CTags[$id]))
        {
            return $this->CTags[$id];
        }
        else
        {
            return '';
        }
    }

    /**
     *  给_vars数组传递一个元素
     *
     * @access    public
     * @param     string   $vname  标签名
     * @param     string   $vvalue  标签值
     * @return    string
     */
    function AssignVar($vname, $vvalue)
    {
        if(!isset($_sys_globals['define']))
        {
            $_sys_globals['define'] = 'yes';
        }
        $_sys_globals[$vname] = $vvalue;
    }

    /**
     *  分配指定ID的标记的值
     *
     * @access    public
     * @param     string   $i  标签id
     * @param     string  $str  字符串
     * @param     string  $runfunc  运行函数
     * @return    void
     */
    function Assign($i, $str, $runfunc = TRUE)
    {
        if(isset($this->CTags[$i]))
        {
            $this->CTags[$i]->IsReplace = TRUE;
            $this->CTags[$i]->TagValue = $str;

            if( $this->CTags[$i]->GetAtt('function')!='' && $runfunc )
            {
                $this->CTags[$i]->TagValue = $this->EvalFunc( $str, $this->CTags[$i]->GetAtt('function'),$this->CTags[$i] );
            }
        }
    }

    /**
     *  分配指定名称的标记的值，如果标记包含属性，请不要用此函数
     *
     * @access    public
     * @param     string  $tagname  标签名称
     * @param     string  $str  字符串
     * @return    void
     */
    function AssignName($tagname, $str)
    {
        foreach($this->CTags as $id=>$CTag)
        {
            if($CTag->TagName==$tagname)
            {
                $this->Assign($id,$str);
            }
        }
    }

    /**
     *  处理特殊标记
     *
     * @access    public
     * @return    void
     */
    function AssignSysTag()
    {
        global $_sys_globals;
        for($i=0;$i<=$this->Count;$i++)
        {
            $CTag = $this->CTags[$i];
            $str = '';

            //获取一个外部变量
            if( $CTag->TagName == 'global' )
            {
               
				$str = $this->GetGlobals($CTag->GetAtt('name'));
				
                if( $this->CTags[$i]->GetAtt('function')!='' )
                {
                    //$str = $this->EvalFunc( $this->CTags[$i]->TagValue, $this->CTags[$i]->GetAtt('function'),$this->CTags[$i] );
                    $str = $this->EvalFunc( $str, $this->CTags[$i]->GetAtt('function'),$this->CTags[$i] );
                }
                $this->CTags[$i]->IsReplace = TRUE;
                $this->CTags[$i]->TagValue = $str;
            }

            //引入静态文件
            else if( $CTag->TagName == 'include' )
            {
                $filename = ($CTag->GetAtt('file')=='' ? $CTag->GetAtt('filename') : $CTag->GetAtt('file') );
				
			    if( $this->CTags[$i]->GetAtt("if")!="" )
				{
                  if(eval("return {$this->CTags[$i]->GetAtt('if')} ;" )) //添加条件判断
				  {

                    $str = $this->IncludeFile($filename,$CTag->GetAtt('ismake'));
				  }
				}
				else
				{
				   $str = $this->IncludeFile($filename,$CTag->GetAtt('ismake'));
				}
				
				
                $this->CTags[$i]->IsReplace = TRUE;
                $this->CTags[$i]->TagValue = $str;
            }

            //循环一个普通数组
            //循环一个普通数组
            else if( $CTag->TagName == 'foreach' )
            {
                $arr = $this->CTags[$i]->GetAtt('array');
                if(isset($GLOBALS[$arr]))
                {
                    $index=0;
					$str='';
				    foreach($GLOBALS[$arr] as $k=>$v)
                    {
                        $istr = '';
						
                        $istr .= preg_replace("/\[field:num([\r\n\t\f ]+)\/\]/is",$index,$this->CTags[$i]->InnerText);
					
						$fstr= preg_replace("/\[field:key([\r\n\t\f ]+)\/\]/is",$k,$istr);
                   
						$sstr= preg_replace("/\[field:value([\r\n\t\f ]+)\/\]/is",$v,$fstr);
					
						$index++;
						$str.=$sstr;
                    }
                }
				
				
                $this->CTags[$i]->IsReplace = TRUE;
                $this->CTags[$i]->TagValue = $str;
            }

            //设置/获取变量值
            else if( $CTag->TagName == 'var' )
            {
                $vname = $this->CTags[$i]->GetAtt('name');
                if($vname=='')
                {
                    $str = '';
                }
                else if($this->CTags[$i]->GetAtt('value')!='')
                {
                    $_vars[$vname] = $this->CTags[$i]->GetAtt('value');
                }
                else
                {
                    $str = (isset($_vars[$vname]) ? $_vars[$vname] : '');
                }
                $this->CTags[$i]->IsReplace = TRUE;
                $this->CTags[$i]->TagValue = $str;
            }

            //运行PHP接口
            if( $CTag->GetAtt('runphp') == 'yes' )
            {
                $this->RunPHP($CTag, $i);
            }
            if(is_array($this->CTags[$i]->TagValue))
            {
                $this->CTags[$i]->TagValue = 'array';
            }
        }
    }

    //运行PHP代码
    function RunPHP(&$refObj, $i)
    {
        $MeValue = $phpcode = '';
        if($refObj->GetAtt('source')=='value')
        {
            $phpcode = $this->CTags[$i]->TagValue;
        }
        else
        {
            $MeValue = $this->CTags[$i]->TagValue;
            $phpcode = $refObj->GetInnerText();

        }
		
        $phpcode = preg_replace("/'@me'|\"@me\"|@me/i", '$MeValue', $phpcode);
		
        @eval($phpcode);

        $this->CTags[$i]->TagValue = $MeValue;
        $this->CTags[$i]->IsReplace = TRUE;
    }

    /**
     *  把分析模板输出到一个字符串中
     *  不替换没被处理的值
     *
     * @access    public
     * @return    string
     */
    function GetResultNP()
    {
        $ResultString = '';
        if($this->Count==-1)
        {
            return $this->SourceString;
        }
        $this->AssignSysTag();
        $nextTagEnd = 0;
        $strok = "";
        for($i=0;$i<=$this->Count;$i++)
        {
            if($this->CTags[$i]->GetValue()!="")
            {
                if($this->CTags[$i]->GetValue()=='#@Delete@#')
                {
                    $this->CTags[$i]->TagValue = "";
                }
                $ResultString .= substr($this->SourceString,$nextTagEnd,$this->CTags[$i]->StartPos-$nextTagEnd);
                $ResultString .= $this->CTags[$i]->GetValue();
                $nextTagEnd = $this->CTags[$i]->EndPos;
            }
        }
        $slen = strlen($this->SourceString);
        if($slen>$nextTagEnd)
        {
            $ResultString .= substr($this->SourceString,$nextTagEnd,$slen-$nextTagEnd);
        }
        return $ResultString;
    }

    /**
     *  把分析模板输出到一个字符串中,并返回
     *
     * @access    public
     * @return    string
     */
    function GetResult()
    {
        $ResultString = '';
        if($this->Count==-1)
        {
            return $this->SourceString;
        }

        $this->AssignSysTag();
        $nextTagEnd = 0;
        $strok = "";

        for($i=0;$i<=$this->Count;$i++)
        {

            $ResultString .= substr($this->SourceString,$nextTagEnd,$this->CTags[$i]->StartPos-$nextTagEnd);

            $ResultString .= $this->CTags[$i]->GetValue();

            $nextTagEnd = $this->CTags[$i]->EndPos;

        }


        $slen = strlen($this->SourceString);
        if($slen>$nextTagEnd)
        {
            $ResultString .= substr($this->SourceString,$nextTagEnd,$slen-$nextTagEnd);
        }

        //$ResultString=$this->CompressHtml($ResultString);
        return $ResultString;
    }

    /**
     *  直接输出解析模板
     *
     * @access    public
     * @return    void
     */
    function Display()
    {
        echo $this->GetResult();
    }
    /**
     * 压缩html : 清除换行符,清除制表符,去掉注释标记
     * @param $string
     * @return 压缩后的$string
     * */
    function CompressHtml($string)
    {
        //$string = str_replace("\r\n", '', $string); //清除换行符
        //$string = str_replace("\n", '', $string); //清除换行符
       // $string = str_replace("\t", '', $string); //清除制表符
        $pattern = array (
            "/> *([^ ]*) *</",
            "/<!--[^!]*-->/"


        );
        $replace = array (
            ">\\1<",
            ""


        );
        return preg_replace($pattern, $replace, $string);

    }

    /**
     *  把解析模板输出为文件
     *
     * @access    public
     * @param     string   $filename  要保存到的文件
     * @return    string
     */
    function SaveTo($filename,$body='')
    {
       
		$body=empty($body)?$this->GetResult():$body;

	    $fp = @fopen($filename,"w") or die("Tag Engine Create File False");
        fwrite($fp,$body);
        fclose($fp);
    }

    /**
     *  解析模板
     *
     * @access    public
     * @return    string
     */
    function ParseTemplet()
    {
        $TagStartWord = $this->TagStartWord;
        $TagEndWord = $this->TagEndWord;
        $sPos = 0; $ePos = 0;
        $FullTagStartWord =  $TagStartWord.$this->NameSpace.":";
        $sTagEndWord =  $TagStartWord."/".$this->NameSpace.":";
        $eTagEndWord = "/".$TagEndWord;
        $tsLen = strlen($FullTagStartWord);
        $sourceLen=strlen($this->SourceString);
        
        if( $sourceLen <= ($tsLen + 3) )
        {
            return;
        }
        $cAtt = new STAttributeParse();
        $cAtt->charToLow = $this->CharToLow;

        //遍历模板字符串，请取标记及其属性信息
        for($i=0; $i < $sourceLen; $i++)
        {
            $tTagName = '';

            //如果不进行此判断，将无法识别相连的两个标记
            if($i-1 >= 0)
            {
                $ss = $i-1;
            }
            else
            {
                $ss = 0;
            }
            $sPos = strpos($this->SourceString,$FullTagStartWord,$ss);
            $isTag = $sPos;
            if($i==0)
            {
                $headerTag = substr($this->SourceString,0,strlen($FullTagStartWord));
                if($headerTag==$FullTagStartWord)
                {
                    $isTag=TRUE; $sPos=0;
                }
            }
            if($isTag===FALSE)
            {
                break;
            }

            for($j=($sPos+$tsLen);$j<($sPos+$tsLen+$this->TagMaxLen);$j++)
            {
                if($j>($sourceLen-1))
                {
                    break;
                }
                else if( preg_match("/[\/ \t\r\n]/", $this->SourceString[$j]) || $this->SourceString[$j] == $this->TagEndWord )
                {
                    break;
                }
                else
                {
                    $tTagName .= $this->SourceString[$j];
                }
            }
            if($tTagName!='')
            {
                $i = $sPos+$tsLen;
                $endPos = -1;
                $fullTagEndWordThis = $sTagEndWord.$tTagName.$TagEndWord;
                
                $e1 = strpos($this->SourceString,$eTagEndWord, $i);
                $e2 = strpos($this->SourceString,$FullTagStartWord, $i);
                $e3 = strpos($this->SourceString,$fullTagEndWordThis,$i);
                
                //$eTagEndWord = /} $FullTagStartWord = {tag: $fullTagEndWordThis = {/tag:xxx]
                
                $e1 = trim($e1); $e2 = trim($e2); $e3 = trim($e3);
                $e1 = ($e1=='' ? '-1' : $e1);
                $e2 = ($e2=='' ? '-1' : $e2);
                $e3 = ($e3=='' ? '-1' : $e3);
                //not found '{/tag:'
                if($e3==-1) 
                {
                    $endPos = $e1;
                    $elen = $endPos + strlen($eTagEndWord);
                }
                //not found '/}'
                else if($e1==-1) 
                {
                    $endPos = $e3;
                    $elen = $endPos + strlen($fullTagEndWordThis);
                }
                //found '/}' and found '{/tag:'
                else
                {
                    //if '/}' more near '{sline:'、'{/sline:' , end tag is '/}', else is '{/tag:'
                    if($e1 < $e2 &&  $e1 < $e3 )
                    {
                        $endPos = $e1;
                        $elen = $endPos + strlen($eTagEndWord);
                    }
                    else
                    {
                        $endPos = $e3;
                        $elen = $endPos + strlen($fullTagEndWordThis);
                    }
                }

                //not found end tag , error
                if($endPos==-1)
                {
                    echo "Tag postion $sPos, '$tTagName' Error！<br />\r\n";
                    break;
                }
                $i = $elen;
                $ePos = $endPos;

                //分析所找到的标记位置等信息
                $attStr = '';
                $innerText = '';
                $startInner = 0;
                for($j=($sPos+$tsLen);$j < $ePos;$j++)
                {
                    if($startInner==0 && ($this->SourceString[$j]==$TagEndWord && $this->SourceString[$j-1]!="\\") )
                    {
                        $startInner=1;
                        continue;
                    }
                    if($startInner==0)
                    {
                        $attStr .= $this->SourceString[$j];
                    }
                    else
                    {
                        $innerText .= $this->SourceString[$j];
                    }
                }
                //echo "<xmp>$attStr</xmp>\r\n";
                $cAtt->SetSource($attStr);
                if($cAtt->cAttributes->GetTagName()!='')
                {
                    $this->Count++;
                    $CDTag = new STTag();
                    $CDTag->TagName = $cAtt->cAttributes->GetTagName();
                    $CDTag->StartPos = $sPos;
                    $CDTag->EndPos = $i;
                    $CDTag->CAttribute = $cAtt->cAttributes;
                    $CDTag->IsReplace = FALSE;
                    $CDTag->TagID = $this->Count;
                    $CDTag->InnerText = $innerText;
                    $this->CTags[$this->Count] = $CDTag;
                }
            }
            else
            {
                $i = $sPos+$tsLen;
                break;
            }
        }//结束遍历模板字符串

        if($this->IsCache)
        {
            $this->SaveCache();
        }
    }

    /**
     *  处理某字段的函数
     *
     * @access    public
     * @param     string   $fieldvalue  字段值
     * @param     string   $functionname  函数名称
     * @param     object  $refObj  隶属对象
     * @return    string
     */
    function EvalFunc($fieldvalue,$functionname,&$refObj)
    {
        $SlineFieldValue = $fieldvalue;
        $func = $functionname;
        //echo $func."</br>";
        $functionname = str_replace("{\"","[\"",$functionname);
        $functionname = str_replace("\"}","\"]",$functionname);
        $functionname = preg_replace("/'@me'|\"@me\"|@me/i",'$SlineFieldValue',$functionname);
        $functionname = "\$SlineFieldValue = ".$functionname;
        try{
            eval($functionname.";");

        }
        catch(Exception $e)
        {
            print $e->getMessage();
            exit;
        };
        if(empty($SlineFieldValue))
        {
            return $SlineFieldValue;
        }
        else
        {
            return $SlineFieldValue;
        }
    }

    /**
     *  获得一个外部变量
     *
     * @access    public
     * @param     string   $varname  变量名称
     * @return    string
     */
    function GetGlobals($varname)
    {
        $varname = trim($varname);

        //禁止读取数据库密码
        if($varname=="dbuserpwd"||$varname=="cfg_dbpwd")
        {
            return "";
        }

        //正常情况
        if(isset($GLOBALS[$varname]))
        {
            return $GLOBALS[$varname];
        }
        else
        {
            return "";
        }
    }

    /**
     *  引入文件
     *
     * @access    public
     * @param     string  $filename  文件名
     * @param     string  $ismake  是否需要编译
     * @return    string
     */
    function IncludeFile($filename, $ismake='no')
    {
        global $cfg_df_style;
        $restr = '';
        if($filename=='')
        {
            return '';
        }
        if( file_exists(SLINEROOT."/templets/".$filename) )
        {
            $okfile = SLINEROOT."/templets/".$filename;
        }
        else if(file_exists(SLINEROOT.'/templets/'.$cfg_df_style.'/'.$filename) )
        {
            $okfile = SLINEROOT.'/templets/'.$cfg_df_style.'/'.$filename;
        }
        else if(file_exists(SLINEROOT.'/templets/smore/uploadtemplets/'.$filename))
        {
            $okfile = SLINEROOT.'/templets/smore/uploadtemplets/'.$filename;
        }
		else if(file_exists(SLINEROOT.'/templets/smore/'.$filename))
		{
		    $okfile = SLINEROOT.'/templets/smore/'.$filename;
		}
        else
        {
            return "无法在这个位置找到： $filename";
        }


        //编译
        if($ismake!="no")
        {
            require_once(SLINEINC."/parsetag.func.php");
            $dtp = new STTagParse();
            $dtp->LoadTemplet($okfile);
			
            MakeOneTag($dtp,$this->refObj,'Y',$this->templetTagDir);
            $restr = $dtp->GetResult();
			
        }
        else
        {
            $fp = @fopen($okfile,"r");
            while($line=fgets($fp,1024)) $restr.=$line;
            fclose($fp);
        }
        return $restr;
    }
}

/**********************************************
//ST模板标记属性集合
**********************************************/
//属性的数据描述
class STAttribute
{
    var $Count = -1;
    var $Items = ""; //属性元素的集合
    //获得某个属性
    function GetAtt($str)
    {
        if($str=="")
        {
            return "";
        }
        if(isset($this->Items[$str]))
        {
            return $this->Items[$str];
        }
        else
        {
            return "";
        }
    }

    //同上
    function GetAttribute($str)
    {
        return $this->GetAtt($str);
    }

    //判断属性是否存在
    function IsAttribute($str)
    {
        if(isset($this->Items[$str])) return TRUE;
        else return FALSE;
    }

    //获得标记名称
    function GetTagName()
    {
        return $this->GetAtt("tagname");
    }

    // 获得属性个数
    function GetCount()
    {
        return $this->Count+1;
    }
}

/*******************************
//属性解析器(本版本中已经支持使用\'这种语法,和用.间隔表示name属性,如 field.body)

********************************/
class STAttributeParse
{
    var $sourceString = "";
    var $sourceMaxSize = 1024;
    var $cAttributes = "";
    var $charToLow = TRUE;
    function SetSource($str='')
    {
        $this->cAttributes = new STAttribute();
        $strLen = 0;
        $this->sourceString = trim(preg_replace("/[ \r\n\t]{1,}/"," ",$str));
        
        //为了在function内能使用数组，这里允许对[ ]进行转义使用
        $this->sourceString = str_replace('\]',']',$this->sourceString);
        $this->sourceString = str_replace('[','[',$this->sourceString);
        /*
        $this->sourceString = str_replace('\>','>',$this->sourceString);
        $this->sourceString = str_replace('<','>',$this->sourceString);
        $this->sourceString = str_replace('{','{',$this->sourceString);
        $this->sourceString = str_replace('\}','}',$this->sourceString);
        */
        
        $strLen = strlen($this->sourceString);
        if($strLen>0 && $strLen <= $this->sourceMaxSize)
        {
            $this->ParseAttribute();
        }
    }

    //解析属性
    function ParseAttribute()
    {
        $d = '';
        $tmpatt = '';
        $tmpvalue = '';
        $startdd = -1;
        $ddtag = '';
        $hasAttribute=FALSE;
        $strLen = strlen($this->sourceString);

        // 获得Tag的名称，解析到 cAtt->GetAtt('tagname') 中
        for($i=0; $i<$strLen; $i++)
        {
            if($this->sourceString[$i]==' ')
            {
                $this->cAttributes->Count++;
                $tmpvalues = explode('.', $tmpvalue);
                $this->cAttributes->Items['tagname'] = ($this->charToLow ? strtolower($tmpvalues[0]) : $tmpvalues[0]);
                if(isset($tmpvalues[1]) && $tmpvalues[1]!='')
                {
                    $this->cAttributes->Items['name'] = $tmpvalues[1];
                }
                $tmpvalue = '';
                $hasAttribute = TRUE;
                break;
            }
            else
            {
                $tmpvalue .= $this->sourceString[$i];
            }
        }

        //不存在属性列表的情况
        if(!$hasAttribute)
        {
            $this->cAttributes->Count++;
            $tmpvalues = explode('.', $tmpvalue);
            $this->cAttributes->Items['tagname'] = ($this->charToLow ? strtolower($tmpvalues[0]) : $tmpvalues[0]);
            if(isset($tmpvalues[1]) && $tmpvalues[1]!='')
            {
                $this->cAttributes->Items['name'] = $tmpvalues[1];
            }
            return ;
        }
        $tmpvalue = '';

        //如果字符串含有属性值，遍历源字符串,并获得各属性
        for($i; $i<$strLen; $i++)
        {
            $d = $this->sourceString[$i];
            //查找属性名称
            if($startdd==-1)
            {
                if($d != '=')
                {
                    $tmpatt .= $d;
                }
                else
                {
                    if($this->charToLow)
                    {
                        $tmpatt = strtolower(trim($tmpatt));
                    }
                    else
                    {
                        $tmpatt = trim($tmpatt);
                    }
                    $startdd=0;
                }
            }

            //查找属性的限定标志
            else if($startdd==0)
            {
                switch($d)
                {
                    case ' ':
                        break;
                    case '"':
                        $ddtag = '"';
                        $startdd = 1;
                        break;
                    case '\'':
                        $ddtag = '\'';
                        $startdd = 1;
                        break;
                    default:
                        $tmpvalue .= $d;
                        $ddtag = ' ';
                        $startdd = 1;
                        break;
                }
            }
            else if($startdd==1)
            {
                if($d==$ddtag && ( isset($this->sourceString[$i-1]) && $this->sourceString[$i-1]!="\\") )
                {
                    $this->cAttributes->Count++;
                    $this->cAttributes->Items[$tmpatt] = trim($tmpvalue);
                    $tmpatt = '';
                    $tmpvalue = '';
                    $startdd = -1;
                }
                else
                {
                    $tmpvalue .= $d;
                }
            }
        }//for

        //最后一个属性的给值
        if($tmpatt != '')
        {
            $this->cAttributes->Count++;
            $this->cAttributes->Items[$tmpatt] = trim($tmpvalue);
        }
        //print_r($this->cAttributes->Items);
    }// end func
}
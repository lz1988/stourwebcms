<?php  
  if(!defined('SLINEINC')) exit('Request Error!');
 /*****
 * 视图类
 *
 * @version        $Id: view.class.php  2011年4月30日Z netman $
 * @package        Sline.Libraries
 * @copyright      Copyright (c) 2011 - 2012, Stourweb, Inc.
 * @link           http://www.stourweb.com
 ****/
require_once(SLINEINC."/sttag.class.php");

class View
{
    var $dsql;
    var $dtp;
    var $TypeID;
    var $Fields;
    var $TypeLink;
    var $pvCopy;
    var $refObj;
    var $remoteDir;
    var $templetTagDir;

    /**
     *   php5构造函数
     *
     * @access    public
     * @param     int  $typeid  栏目ID
     * @param     int  $needtypelink  是否需要栏目连接
     * @return    void 
     */
    function __construct($typeid=0,$aid=0)
    {
        if(!isset($cfg_mainsite)) extract($GLOBALS, EXTR_SKIP);

        $this->TypeID = $typeid;
        $this->dsql = $GLOBALS['dsql'];
        $this->dtp = new STTagParse();
        $this->dtp->SetNameSpace("sline","{","}");
        $this->dtp->SetRefObj($this);
        $this->remoteDir = '';
		       
        $this->Fields['typeid'] = $typeid;
        $this->Fields['indexName'] = $GLOBALS['cfg_indexname'];
        $this->Fields['baseDir'] = $GLOBALS['cfg_basedir'];
        $this->Fields['modDir'] = $GLOBALS['cfg_templets_dir'];

		
        
		//设置一些全局参数的值
        $this->Fields['phpurl'] = $cfg_phpurl;
        //$this->Fields['indexurl'] = $cfg_mainsite.$cfg_indexurl;
        $this->Fields['templeturl'] = $cfg_templeturl;
        $this->Fields['indexname'] = $cfg_indexname;
        $this->Fields['templetdef'] = $cfg_templets_dir.'/'.$cfg_df_style;
		
		if(0 == $GLOBALS['cfg_web_open'])//网站状态
		{
		   echo "<p align=\"center\">网站维护中,暂时关闭.请稍后访问</p>";	
		   exit;
		}

        
    }
    
    //php4构造函数
    function View($typeid=0)
    {
        $this->__construct($typeid);
    }

    /**
     *  重新指定引入的对象
     *
     * @access    private
     * @param     object  $refObj  引用对象
     * @return    void
     */
    function SetRefObj(&$refObj)
    {
        $this->dtp->SetRefObj($refObj);
        if(isset($refObj->TypeID))
        {
            $this->__construct($refObj->TypeID);
        }
    }

  

    /**
     *  设置要解析的模板
     *
     * @access    public
     * @param     string  $temp  模板
     * @param     string  $stype  设置类型
     * @return    string
     */
    function SetTemplet($temp,$stype="file",$tagdir="")
    {
        if($stype=="string")
        {
            $this->dtp->LoadSource($temp,$tagdir);
        }
        else
        {
			
			if(file_exists($temp))
			{
              $this->dtp->LoadTemplet($temp);
			}
			else
			{
			  
			   
			   $temp = str_replace(SLINETEMPLATE ."/".$GLOBALS['cfg_df_style'] ."/",SLINETEMPLATE ."/smore/" ,$temp);
			   $this->dtp->LoadTemplet($temp);
			}
        }
      /*  if($this->TypeID > 0)
        {
            $this->Fields['position'] = $this->TypeLink->GetPositionLink(TRUE);
            $this->Fields['title'] = $this->TypeLink->GetPositionLink(false);
        }*/
        $this->templetTagDir = !empty($tagdir) ? $tagdir : dirname($temp).'/taglib';

        $this->ParseTemplet();
    }

    /**
     *  显示内容
     *
     * @access    public
     * @return    void
     */
    function Display()
    {
        $this->dtp->Display();
    }

    /**
     *  获取内容
     *
     * @access    public
     * @return    string
     */
    function GetResult()
    {
        return $this->dtp->GetResult();
    }

    /**
     *  保存结果为文件
     *
     * @access    public
     * @param     string  $filename  文件名
     * @param     string  $isremote  是否远程
     * @return    string
     */
      function SaveToHtml($filename,$body='')
    {
       
        $this->dtp->SaveTo($filename,$body);
    }
    /**
     *  解析模板里的标签
     *
     * @access    private
     * @return    void
     */
    function ParseTemplet()
    {
     
        $this->MakeOneTag($this->dtp,$this); //编译模板
    }

   
function MakeOneTag(&$dtp, &$refObj, $parfield='Y')
{
    
    $dtp->setRefObj($refObj);
    //读取自由调用tag列表
    $usertags = array(); //用户模板标签
	$templettags = array(); //当前使用模板tag
	$standardtags = array(); //标准模板tag
	$usetemppath = SLINEINC.'/taglib/'.$GLOBALS['cfg_df_style'];

    //用户模板标签
    if(is_dir($this->templetTagDir))
    {
        $utag= dir($this->templetTagDir);
        while($filename = $utag->read())
        {
            if(preg_match("/\.lib\./", $filename))
            {
                $usertags[] = str_replace('.lib.php','',$filename);
            }
        }
        $utag->Close();
    }

	if(file_exists($usetemppath))
	{
		$tetag = dir($usetemppath);
		while($filename = $tetag->read())
		{
			if(preg_match("/\.lib\./", $filename))
			{
				$templettags[] = str_replace('.lib.php','',$filename);
			}
		}
		$tetag->Close();
	}
	
    $stag = dir(SLINEINC.'/taglib/smore');
	while($filename = $stag->read())
    {
        if(preg_match("/\.lib\./", $filename))
        {
            $standardtags[] = str_replace('.lib.php','',$filename);
        }
    }
    $stag->Close();

    //遍历tag元素
    if(!is_array($dtp->CTags))
    {
        return '';
    }
    foreach($dtp->CTags as $tagid=>$ctag)
    {
        $tagname = $ctag->GetName();
        if($tagname=='field' && $parfield=='Y')
        {
            $vname = $ctag->GetAtt('name');
            if( $vname=='array' && isset($refObj->Fields) )
            {
                $dtp->Assign($tagid,$refObj->Fields);
            }
            else if(isset($refObj->Fields[$vname]))
            {
                $dtp->Assign($tagid,$refObj->Fields[$vname]);
            }
            else if($ctag->GetAtt('noteid') != '')
            {
                if( isset($refObj->Fields[$vname.'_'.$ctag->GetAtt('noteid')]) )
                {
                    $dtp->Assign($tagid, $refObj->Fields[$vname.'_'.$ctag->GetAtt('noteid')]);
                }
            }
            continue;
        }

		//先判断是否在使用模板的模板标签里面,如果存在则直接调用,如果不存在则判断是否在标准模板里,
        if(in_array($tagname,$usertags))
        {
            $filename = $this->templetTagDir.'/'.$tagname.'.lib.php';
            include_once($filename);
            $funcname = 'lib_'.$tagname;
            $dtp->Assign($tagid,$funcname($ctag,$refObj));
        }

        else if(in_array($tagname,$templettags))
        {
            $filename = SLINEINC.'/taglib/'.$GLOBALS['cfg_df_style'].'/'.$tagname.'.lib.php';
            include_once($filename);
            $funcname = 'lib_'.$tagname;
            $dtp->Assign($tagid,$funcname($ctag,$refObj));
        }
		else if(in_array($tagname,$standardtags))
		{
			$filename = SLINEINC.'/taglib/smore/'.$tagname.'.lib.php';
            include_once($filename);
            $funcname = 'lib_'.$tagname;
            $dtp->Assign($tagid,$funcname($ctag,$refObj));
			
		}
    }
  }

    //关闭所占用的资源
    function Close()
    {
    }
	
	//获取栏目title,关键词,描述.
	function GetChannelKeywords($typeid=0)
	{
	   global $dsql;
       $webid = $GLOBALS['sys_child_webid'];//webid赋值
	   //如果typeid=0则读取首页默认关键词.标题
	   if($typeid==0)
	   {

              $this->Fields['seotitle']=$GLOBALS['cfg_seotitle'];
              $this->Fields['keywords']=$GLOBALS['cfg_keywords'];
              $this->Fields['description']=$GLOBALS['cfg_description'];

	   }
	   else
	   {
	      $sql="select seotitle,shortname as typename ,linktitle,tagword,url,keyword as seokeyword,description as seodescription,jieshao from #@__nav where typeid ={$typeid} and webid='$webid'";
		  
		
		  $row = $dsql->GetOne($sql);
		
		  if(is_array($row))
		  {
			  $row['seotitle']=empty($row['seotitle'])?$row['typename']:$row['seotitle'];
              $row['typename']=!empty($row['linktitle']) ? $row['linktitle'] : $row['typename'];
		     foreach($row as $k=>$v)
            {
                $this->Fields[$k] = $v;
            }
			//print_r($this->Fields);
		  }
		  $this->Fields['taglook']=GetTagsLink($row['tagword']);
	   
	   }
	   
	   
	
	}
	
	
}//End Class
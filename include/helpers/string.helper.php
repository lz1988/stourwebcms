<?php  if(!defined('SLINEINC')) exit('sline');
/**
 * 字符串
 *
 * @version        $Id: string.helper.php 1 2011-07-20 11:43:09Z
 * @package        Sline.Helpers
 * @copyright      Copyright (c) 2008 - 2014, Stourweb, Inc.
 * @link           http://www.stourweb.com
 */
//拼音的缓冲数组
$pinyins = Array();

/**
 *  中文截取2，单字节截取模式
 *  如果是request的内容，必须使用这个函数
 *
 * @access    public
 * @param     string  $str  需要截取的字符串
 * @param     int  $slen  截取的长度
 * @param     int  $startdd  开始标记处
 * @return    string
 */
if ( ! function_exists('cn_substrR'))
{
    function cn_substrR($str, $slen, $startdd=0)
    {
        $str = cn_substr(stripslashes($str), $slen, $startdd);
        return addslashes($str);
    }
}

/**
 *  中文截取2，单字节截取模式
 *
 * @access    public
 * @param     string  $str  需要截取的字符串
 * @param     int  $slen  截取的长度
 * @param     int  $startdd  开始标记处
 * @return    string
 */
if ( ! function_exists('cn_substr'))
{
    function cn_substr($str, $slen, $startdd=0)
    {
        global $cfg_soft_lang;
        if($cfg_soft_lang=='utf-8')
        {
            return cn_substr_utf8($str, $slen, $startdd);
        }
        $restr = '';
        $c = '';
        $str_len = strlen($str);
        if($str_len < $startdd+1)
        {
            return '';
        }
        if($str_len < $startdd + $slen || $slen==0)
        {
            $slen = $str_len - $startdd;
        }
        $enddd = $startdd + $slen - 1;
        for($i=0;$i<$str_len;$i++)
        {
            if($startdd==0)
            {
                $restr .= $c;
            }
            else if($i > $startdd)
            {
                $restr .= $c;
            }

            if(ord($str[$i])>0x80)
            {
                if($str_len>$i+1)
                {
                    $c = $str[$i].$str[$i+1];
                }
                $i++;
            }
            else
            {
                $c = $str[$i];
            }

            if($i >= $enddd)
            {
                if(strlen($restr)+strlen($c)>$slen)
                {
                    break;
                }
                else
                {
                    $restr .= $c;
                    break;
                }
            }
        }
        return $restr;
    }
}

/**
 *  utf-8中文截取，单字节截取模式
 *
 * @access    public
 * @param     string  $str  需要截取的字符串
 * @param     int  $slen  截取的长度
 * @param     int  $startdd  开始标记处
 * @return    string
 */
if ( ! function_exists('cn_substr_utf8'))
{
    function cn_substr_utf8($str, $length, $start=0)
    {
        if(strlen($str) < $start+1)
        {
            return '';
        }
        preg_match_all("/./su", $str, $ar);
        $str = '';
        $tstr = '';

        //为了兼容mysql4.1以下版本,与数据库varchar一致,这里使用按字节截取
        for($i=0; isset($ar[0][$i]); $i++)
        {
            if(strlen($tstr) < $start)
            {
                $tstr .= $ar[0][$i];
            }
            else
            {
                if(strlen($str) < $length + strlen($ar[0][$i]) )
                {
                    $str .= $ar[0][$i];
                }
                else
                {
                    break;
                }
            }
        }
        return $str;
    }
}

/**
 *  HTML转换为文本
 *
 * @param    string  $str 需要转换的字符串
 * @param    string  $r   如果$r=0直接返回内容,否则需要使用反斜线引用字符串
 * @return   string
 */
if ( ! function_exists('Html2Text'))
{
    function Html2Text($str,$r=0)
    {
        $str = preg_replace("/<sty(.*)\\/style>|<scr(.*)\\/script>|<!--(.*)-->/isU","",$str);
	    $alltext = "";
		$start = 1;
		for($i=0;$i<strlen($str);$i++)
		{
			if($start==0 && $str[$i]==">")
			{
				$start = 1;
			}
			else if($start==1)
			{
				if($str[$i]=="<")
				{
					$start = 0;
					$alltext .= " ";
				}
				else if(ord($str[$i])>31)
				{
					$alltext .= $str[$i];
				}
			}
		}
		$alltext = str_replace("　"," ",$alltext);
		$alltext = preg_replace("/&([^;&]*)(;|&)/","",$alltext);
		$alltext = preg_replace("/[ ]+/s"," ",$alltext);
        if($r==0)
        {
            return $alltext;
        }
        else
        {
            $str = stripslashes($alltext);
            return addslashes($str);
        }
    }
}



/**
 *  文本转HTML
 *
 * @param    string  $txt 需要转换的文本内容
 * @return   string
 */
if ( ! function_exists('Text2Html'))
{
    function Text2Html($txt)
    {
        $txt = str_replace("  ", "　", $txt);
        $txt = str_replace("<", "&lt;", $txt);
        $txt = str_replace(">", "&gt;", $txt);
        $txt = preg_replace("/[\r\n]{1,}/isU", "<br/>\r\n", $txt);
        return $txt;
    }
}

/**
 *  获取半角字符
 *
 * @param     string  $fnum  数字字符串
 * @return    string
 */
if ( ! function_exists('GetAlabNum'))
{
    function GetAlabNum($fnum)
    {
        $nums = array("０","１","２","３","４","５","６","７","８","９");
        //$fnums = "0123456789";
        $fnums = array("0","1","2","3","4","5","6","7","8","9");
        $fnum = str_replace($nums, $fnums, $fnum);
        $fnum = preg_replace("/[^0-9\.-]/", '', $fnum);
        if($fnum=='')
        {
            $fnum=0;
        }
        return $fnum;
    }
}

/**
 *  获取拼音以gbk编码为准
 *
 * @access    public
 * @param     string  $str     字符串信息
 * @param     int     $ishead  是否取头字母
 * @param     int     $isclose 是否关闭字符串资源
 * @return    string
 */
if ( ! function_exists('GetPinyin'))
{
    function GetPinyin($str, $ishead=0, $isclose=1)
    {
        global $cfg_soft_lang;
		
		if($cfg_soft_lang=='utf-8')
        {
            return SpGetPinyin(utf82gb($str), $ishead, $isclose);
        }
        else
        {
            return SpGetPinyin($str, $ishead, $isclose);
        }
    }
}

/**
 *  获取拼音信息
 *
 * @access    public
 * @param     string  $str  字符串
 * @param     int  $ishead  是否为首字母
 * @param     int  $isclose  解析后是否释放资源
 * @return    string
 */
function SpGetPinyin($str, $ishead=0, $isclose=1)
{
    global $pinyins;
    $restr = '';
    $str = trim($str);
    $slen = strlen($str);
    if($slen < 2)
    {
        return $str;
    }
	
    if(count($pinyins) == 0)
    {
        $fp = fopen(SLINEINC.'/data/pinyin.dat', 'r');
        while(!feof($fp))
        {
            $line = trim(fgets($fp));
            $pinyins[$line[0].$line[1]] = substr($line, 3, strlen($line)-3);
        }
        fclose($fp);
    }
    for($i=0; $i<$slen; $i++)
    {
        if(ord($str[$i])>0x80)
        {
            $c = $str[$i].$str[$i+1];
            $i++;
            if(isset($pinyins[$c]))
            {
                if($ishead==0)
                {
                    $restr .= $pinyins[$c];
                }
                else
                {
                    $restr .= $pinyins[$c][0];
                }
            }else
            {
                $restr .= "_";
            }
        }else if( preg_match("/[a-z0-9]/i", $str[$i]) )
        {
            $restr .= $str[$i];
        }
        else
        {
            $restr .= "_";
        }
    }
    if($isclose==0)
    {
        unset($pinyins);
    }
	$sheng = "/.*sheng.*/";
	$shi = "/.*shi.*/";
	$qu = "/.*qu.*/";
	if(preg_match($sheng,$restr,$matches))
	{
		$restr = str_replace('sheng','',$matches[0]);
	}
	if(preg_match($shi,$restr,$matches))
	{
		$restr = str_replace('shi','',$matches[0]);
	}
	if(preg_match($qu,$restr,$matches))
	{
		$restr = str_replace('qu','',$matches[0]);
	}
    return $restr;
}


/**
 *  将实体html代码转换成标准html代码（兼容php4）
 *
 * @access    public
 * @param     string  $str     字符串信息
 * @param     long    $options  替换的字符集
 * @return    string
 */

if ( ! function_exists('htmlspecialchars_decode'))
{
        function htmlspecialchars_decode($str, $options=ENT_COMPAT) {
                $trans = get_html_translation_table(HTML_SPECIALCHARS, $options);

                $decode = ARRAY();
                foreach ($trans AS $char=>$entity) {
                        $decode[$entity] = $char;
                }

                $str = strtr($str, $decode);

                return $str;
        }
}

function ClearHtml($content)
 {  

   $content = preg_replace("/<a[^>]*>/i", "", $content);  

   $content = preg_replace("/<\/a>/i", "", $content);   

   $content = preg_replace("/<div[^>]*>/i", "", $content);  
   
    $content = preg_replace("/<font[^>]*>/i", "", $content); 
	 $content = preg_replace("/<strong[^>]*>/i", "", $content); 
  $content = preg_replace("/<\/font[^>]*>/i", "", $content); 
	 $content = preg_replace("/<\/strong[^>]*>/i", "", $content); 
   $content = preg_replace("/<\/div>/i", "", $content); 
   $content = preg_replace("/<p>/i", "", $content);    
   $content = preg_replace("/<\/p>/i", "", $content);       
   $content = preg_replace("/<!--[^>]*-->/i", "", $content);//注释内容  

   $content = preg_replace("/style=.+?['|\"]/i",'',$content);//去除样式  

   $content = preg_replace("/class=.+?['|\"]/i",'',$content);//去除样式  

   $content = preg_replace("/id=.+?['|\"]/i",'',$content);//去除样式     

   $content = preg_replace("/lang=.+?['|\"]/i",'',$content);//去除样式      

   $content = preg_replace("/width=.+?['|\"]/i",'',$content);//去除样式   

   $content = preg_replace("/height=.+?['|\"]/i",'',$content);//去除样式   

   $content = preg_replace("/border=.+?['|\"]/i",'',$content);//去除样式   

   $content = preg_replace("/face=.+?['|\"]/i",'',$content);//去除样式   

   $content = preg_replace("/face=.+?['|\"]/",'',$content);//去除样式 只允许小写 正则匹配没有带 i 参数

   return $content;

}

function cutstr_html($string, $sublen)    
{

  $string = strip_tags($string);

  $string = preg_replace ('/\n/is', '', $string);

  $string = preg_replace ('/ |　/is', '', $string);

  $string = preg_replace ('/&nbsp;/is', '', $string);

  preg_match_all("/[\x01-\x7f]|[\xc2-\xdf][\x80-\xbf]|\xe0[\xa0-\xbf][\x80-\xbf]|[\xe1-\xef][\x80-\xbf][\x80-\xbf]|\xf0[\x90-\xbf][\x80-\xbf][\x80-\xbf]|[\xf1-\xf7][\x80-\xbf][\x80-\xbf][\x80-\xbf]/", $string, $t_string);   

  if(count($t_string[0]) - 0 > $sublen) $string = join('', array_slice($t_string[0], 0, $sublen))."…";   

  else $string = join('', array_slice($t_string[0], 0, $sublen));

  return $string;

 }





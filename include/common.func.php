<?php
/**
 * 系统核心函数存放文件
 * @version        $Id: common.func.php 4 16:39 2011年04月30日Z netman $
 * @package        SLine.Libraries
 * @copyright      Copyright (c) 2007 - 2010, DesDev, Inc.
 * @link           http://www.stourweb.com
 */
if(!defined('SLINEINC')) exit('sline');


$_helpers = array();
function helper($helpers)
{
    //如果是数组,则进行递归操作
    if (is_array($helpers))
    {
        foreach($helpers as $sline)
        {
            helper($sline);
        }
        return;
    }

    if (isset($_helpers[$helpers]))
    {
        continue;
    }
    if (file_exists(SLINEINC.'/helpers/'.$helpers.'.helper.php'))
    { 
        include_once(SLINEINC.'/helpers/'.$helpers.'.helper.php');
        $_helpers[$helpers] = TRUE;
	
    }
    // 无法载入小助手
    if ( ! isset($_helpers[$helpers]))
    {
        exit('Unable to load the requested file: helpers/'.$helpers.'.helper.php');                
    }
}



/**
 *  载入小助手,这里用户可能载入用helps载入多个小助手
 *
 * @access    public
 * @param     string
 * @return    string
 */
function helpers($helpers)
{
    helper($helpers);
}

//兼容php4的file_put_contents
if(!function_exists('file_put_contents'))
{
    function file_put_contents($n, $d)
    {
        $f=@fopen($n, "w");
        if (!$f)
        {
            return FALSE;
        }
        else
        {
            fwrite($f, $d);
            fclose($f);
            return TRUE;
        }
    }
}


function ShowMsg($msg, $gourl, $onlymsg=0, $limittime=0)
{
    if(empty($GLOBALS['cfg_plus_dir'])) $GLOBALS['cfg_plus_dir'] = '..';

    $htmlhead  = "<html>\r\n<head>\r\n<title>{$GLOBALS['cfg_webname']}提示信息</title>\r\n<meta http-equiv=\"Content-Type\" content=\"text/html; charset=gb2312\" />\r\n";
    $htmlhead .= "<base target='_self'/>\r\n<style>div{line-height:160%;}</style></head>\r\n<body leftmargin='0' topmargin='0' bgcolor='#FFFFFF'>".(isset($GLOBALS['ucsynlogin']) ? $GLOBALS['ucsynlogin'] : '')."\r\n<center>\r\n<script>\r\n";
    $htmlfoot  = "</script>\r\n</center>\r\n</body>\r\n</html>\r\n";

    
    
    $litime = ($limittime==0 ? 1000 : $limittime);
    $func = '';

    if($gourl=='-1')
    {
        if($limittime==0) $litime = 5000;
        $gourl = "javascript:history.go(-1);";
    }
	

    if($gourl=='' && $onlymsg==1)
    {
        $msg = "<script>alert(\"".str_replace("\"","“",$msg)."\");</script>";
		
    }
	else if($gourl !='' && $onlymsg==1)
	{
	   $msg = "<script>alert(\"".str_replace("\"","“",$msg)."\");window.history.back(-1);</script>"; 
	
	}
    else
    {
        //当网址为:close::objname 时, 关闭父框架的id=objname元素
        if(preg_match('/close::/',$gourl))
        {
            $tgobj = trim(preg_replace('/close::/', '', $gourl));
            $gourl = 'javascript:;';
            $func .= "window.parent.document.getElementById('{$tgobj}').style.display='none';\r\n";
        }
        
        $func .= "      var pgo=0;
      function JumpUrl(){
        if(pgo==0){ location='$gourl'; pgo=1; }
      }\r\n";
        $rmsg = $func;
        $rmsg .= "document.write(\"<br /><div style='width:450px;padding:0px;border:1px solid #7497ab;'>";
        $rmsg .= "<div class='topbg' style='padding:0px 6px;height:28px;line-height:28px;color:#fff;font-size:12px;border-bottom:1px solid #7497ab;background:url({$GLOBALS['cfg_basehost']}/stourtravel/img/title_1.jpg) repeat-x;'><b>{$GLOBALS['cfg_webname']}提示</b></div>\");\r\n";
        $rmsg .= "document.write(\"<div style='height:130px;font-size:10pt;background:#DEF0FA'><br />\");\r\n";
       $rmsg .= "document.write(\"".str_replace("\"","“",$msg)."\");\r\n";
        $rmsg .= "document.write(\"";
        
        if($onlymsg==0)
        {
            if( $gourl != 'javascript:;' && $gourl != '')
            {
                $rmsg .= "<br /><a href='{$gourl}'>如果你的浏览器没反应，请点击这里...</a>";
                $rmsg .= "<br/></div>\");\r\n";
                $rmsg .= "setTimeout('JumpUrl()',$litime);";
            }
            else
            {
                $rmsg .= "<br/></div>\");\r\n";
            }
        }
        else
        {
            $rmsg .= "<br/><br/></div>\");\r\n";
        }
		
        $msg  = $htmlhead.$rmsg.$htmlfoot;
    }
    echo $msg;
}

/**
 *  获取验证码的session值
 *
 * @return    string
 */
function GetCkVdValue()
{
	@session_id($_COOKIE['PHPSESSID']);
    @session_start();
    return isset($_SESSION['total_value']) ? $_SESSION['total_value'] : '';
}

/**
 *  PHP某些版本有Bug，不能在同一作用域中同时读session并改注销它，因此调用后需执行本函数
 *
 * @return    void
 */
function ResetVdValue()
{
    @session_start();
   // $_SESSION['securimage_code_value'] = '';
	$_SESSION['total_value']='';
}


if( file_exists(SLINEINC.'/extend.func.php') )
{
    require_once(SLINEINC.'/extend.func.php');
}

//taglib标签赋值
function FillAttsDefault(&$atts, $attlist)
{
    $attlists = explode(',', $attlist);
    for($i=0; isset($attlists[$i]); $i++)
    {
        list($k, $v) = explode('|', $attlists[$i]);
        if(!isset($atts[$k]))
        {
            $atts[$k] = $v;
        }
    }
}

/**
 *  修复浏览器XSS hack的函数
 *
 * @param     string   $val  需要处理的内容
 * @return    string
 */
if ( ! function_exists('RemoveXSS'))
{
    function RemoveXSS($val)
	 {
       $val = htmlspecialchars($val);
	   CheckInjection($val);//注入检测
	   $val = preg_replace('/([\x00-\x08,\x0b-\x0c,\x0e-\x19])/', '', $val);
       $search = 'abcdefghijklmnopqrstuvwxyz';
       $search .= 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
       $search .= '1234567890!@#$%^&*()';
       $search .= '~`";:?+/={}[]-_|\'\\';
       for ($i = 0; $i < strlen($search); $i++) {
          $val = preg_replace('/(&#[xX]0{0,8}'.dechex(ord($search[$i])).';?)/i', $search[$i], $val); // with a ;
          $val = preg_replace('/(&#0{0,8}'.ord($search[$i]).';?)/', $search[$i], $val); // with a ;
       }

       $ra1 = array('javascript', 'vbscript', 'expression', 'applet', 'meta', 'xml', 'blink', 'link', 'style', 'script', 'embed', 'object', 'iframe', 'frame', 'frameset', 'ilayer', 'layer', 'bgsound', 'title', 'base');
       $ra2 = array('onabort', 'onactivate', 'onafterprint', 'onafterupdate', 'onbeforeactivate', 'onbeforecopy', 'onbeforecut', 'onbeforedeactivate', 'onbeforeeditfocus', 'onbeforepaste', 'onbeforeprint', 'onbeforeunload', 'onbeforeupdate', 'onblur', 'onbounce', 'oncellchange', 'onchange', 'onclick', 'oncontextmenu', 'oncontrolselect', 'oncopy', 'oncut', 'ondataavailable', 'ondatasetchanged', 'ondatasetcomplete', 'ondblclick', 'ondeactivate', 'ondrag', 'ondragend', 'ondragenter', 'ondragleave', 'ondragover', 'ondragstart', 'ondrop', 'onerror', 'onerrorupdate', 'onfilterchange', 'onfinish', 'onfocus', 'onfocusin', 'onfocusout', 'onhelp', 'onkeydown', 'onkeypress', 'onkeyup', 'onlayoutcomplete', 'onload', 'onlosecapture', 'onmousedown', 'onmouseenter', 'onmouseleave', 'onmousemove', 'onmouseout', 'onmouseover', 'onmouseup', 'onmousewheel', 'onmove', 'onmoveend', 'onmovestart', 'onpaste', 'onpropertychange', 'onreadystatechange', 'onreset', 'onresize', 'onresizeend', 'onresizestart', 'onrowenter', 'onrowexit', 'onrowsdelete', 'onrowsinserted', 'onscroll', 'onselect', 'onselectionchange', 'onselectstart', 'onstart', 'onstop', 'onsubmit', 'onunload');
       $ra = array_merge($ra1, $ra2);

       $found = true; 
       while ($found == true) 
	   {
          $val_before = $val;
          for ($i = 0; $i < sizeof($ra); $i++) {
             $pattern = '/';
             for ($j = 0; $j < strlen($ra[$i]); $j++) {
                if ($j > 0) {
                   $pattern .= '(';
                   $pattern .= '(&#[xX]0{0,8}([9ab]);)';
                   $pattern .= '|';
                   $pattern .= '|(&#0{0,8}([9|10|13]);)';
                   $pattern .= ')*';
                }
                $pattern .= $ra[$i][$j];
             }
             $pattern .= '/i';
             $replacement = substr($ra[$i], 0, 2).'<x>'.substr($ra[$i], 2);
             $val = preg_replace($pattern, $replacement, $val); 
             if ($val_before == $val) {
                $found = false;
             }
          }
       }
       $val = htmlspecialchars($val);
       return $val;
    }
}

/**
 *  检查注入函数
 *
 * @param     string   $val  需要处理的内容
 * @return    string
 */

if ( ! function_exists('CheckInjection'))
{
    function CheckInjection($val)
	{


  	//注入检测
		$notallow="select | insert | and | or | update | delete |\'|\/\*|\*|\.\.\/|\.\/| union | into |load_file|outfile";
		
		
		if(eregi($notallow,$val))
		{
		  
			exit('输入参数有误!');
			
		}
		

   }
}
/**
 * 车务功能函数
 *
 * @param     int  $tagword  tag词
 * @return    string
 */

	function GetDataHandle($type,$tablerow,$dtp2)
	{
		//echo $type;
		$likeType="";
		$webid=!empty($tablerow['webid']) ? $tablerow['webid'] : 0;
		$weburl=GetWebURLByWebid($webid);
	    $tablerow['smallcarpic']=GetPicture($tablerow['smallcarpic']);
		$tablerow['carpic']=GetPicture($tablerow['carpic']);
	    if($type!="priceforcar")
		{
		  //$url=($tablerow['webid']==0) ? "/cars/show_{$tablerow['aid']}.html" : "/cars/brief_{$tablerow['aid']}_{$tablerow['webid']}.html";
		  $url="/cars/show_{$tablerow['aid']}.html";
		}
		else
		{
		  $url=($tablerow['webid']==0) ? "/lines/show_{$tablerow['aid']}.html" : "/lines/brief_{$tablerow['aid']}_{$tablerow['webid']}.html";
		 
		}
	
		switch($type)
		{
			case 'hot'://热门?暂时以istop排序？
				$tablerow['url'] = $GLOBALS['cfg_cmsurl'].$url;
				$tablerow['title']=$tablerow['title'];
				$tablerow['price']=(empty($tablerow['nowprice']) || $tablerow['nowprice']==0) ? '<span class="rmb_1">电询</span>' :"<span class='rmb_1'>￥</span>".$tablerow['nowprice']."<span class=\"qi_1\">起</span>";
			
				if(!empty($tablerow['smallcarpic']))
				{
				  $tablerow['litpic']=$weburl.$tablerow['smallcarpic'];
				}
				if($tablerow['litpic']=="")
				{
				   $tablerow['litpic']=$GLOBALS['cfg_cmsurl']."/templets/default/images/pic_tem.gif";
				}
				if(is_array($dtp2->CTags))
				{
					foreach($dtp2->CTags as $tagid=>$ctag)
					{
						if($ctag->GetName()=='array')
						{
							$dtp2->Assign($tagid, $tablerow);
						}
						else
						{
						  $value=empty($tablerow[$ctag->GetName()]) ? '' : $tablerow[$ctag->GetName()];
						
						  $dtp2->Assign($tagid,$value);
						}
					}
				}
				$likeType= $dtp2->GetResult();
			break;
			case 'recommend'://
				
				if(!empty($tablerow['smallcarpic']))
				{
				 
				  $tablerow['litpic']=$weburl.$tablerow['smallcarpic'];
				}
				
				if($tablerow['litpic']=="")
				{
				   $tablerow['litpic']=$GLOBALS['cfg_cmsurl']."/templets/default/images/pic_tem.gif";
				}
				$tablerow['url'] = $GLOBALS['cfg_cmsurl'].$url;
				$tablerow['title']=$tablerow['title'];
				$tablerow['price']=(empty($tablerow['nowprice']) || $tablerow['nowprice']==0) ? '<span class="rmb_1">电询</span>' :"<span class='rmb_1'>￥</span>".$tablerow['nowprice']."<span class=\"qi_1\">起</span>";
				if(is_array($dtp2->CTags))
				{
					foreach($dtp2->CTags as $tagid=>$ctag)
					{
						if($ctag->GetName()=='array')
						{
							$dtp2->Assign($tagid, $tablerow);
						}
						else
						{
						  $value=empty($tablerow[$ctag->GetName()]) ? '' : $tablerow[$ctag->GetName()];
						
						  $dtp2->Assign($tagid,$value);
						}
					}
				}
				$likeType= $dtp2->GetResult();
			break;
			case 'stylelist':
				$tablerow['title']=$tablerow['kindname'];
				$tablerow['typename'] =$tablerow['kindname'];
				$tablerow['price']=(empty($tablerow['nowprice']) || $tablerow['nowprice']==0) ? '<span class="rmb_1">电询</span>' :"<span class='rmb_1'>￥</span>".$tablerow['nowprice']."<span class=\"qi_1\">起</span>";
				$tablerow['url']=$GLOBALS['cfg_cmsurl']."/cars/search_".$tablerow['aid'].'_0_0.html';
				if(is_array($dtp2->CTags))
				{
					foreach($dtp2->CTags as $tagid=>$ctag)
					{
						//if(isset($tablerow[$ctag->GetName()])) $dtp2->Assign($tagid,$tablerow[$ctag->GetName()]);
						if($ctag->GetName()=='array')
								{
									$dtp2->Assign($tagid, $tablerow);
								}
								else
								{
								  //if(isset($tablerow[$ctag->GetName()])) $dtp2->Assign($tagid,$tablerow[$ctag->GetName()]);
								  $value=empty($tablerow[$ctag->GetName()]) ? '' : $tablerow[$ctag->GetName()];
						
						          $dtp2->Assign($tagid,$value);
								}
									//echo $tagid.$row[$ctag->GetName()].'---';
					}
				}
				$likeType= $dtp2->GetResult();
			break;
			case 'brandlist':
				//$tablerow['typelink'] = $GLOBALS['cfg_cmsurl'].$tablerow['url'];
				$tablerow['title']=$tablerow['kindname'];
				
				$tablerow['url']=$GLOBALS['cfg_cmsurl']."/cars/search_0_".$tablerow['aid'].'_0.html';
				$tablerow['typename'] =$tablerow['kindname'];
				if(is_array($dtp2->CTags))
				{
					foreach($dtp2->CTags as $tagid=>$ctag)
					{
						if($ctag->GetName()=='array')
						{
							$dtp2->Assign($tagid, $tablerow);
						}
						else
						{
						  $value=empty($tablerow[$ctag->GetName()]) ? '' : $tablerow[$ctag->GetName()];
						
						  $dtp2->Assign($tagid,$value);
						}
					}
				}
				$likeType= $dtp2->GetResult();
			break;
			case 'listofkind':
				$tablerow['title']=$tablerow['title'];
				$tablerow['price']=(empty($tablerow['nowprice']) || $tablerow['nowprice']==0) ? '<span class="rmb_1">电询</span>' :"<span class='rmb_1'>￥</span>".$tablerow['nowprice']."<span class=\"qi_1\">起</span>";
				$tablerow['url'] = $GLOBALS['cfg_cmsurl'].$url;
			
				if(!empty($tablerow['smallcarpic']))
				{
				 
				  $tablerow['litpic']=$weburl.$tablerow['smallcarpic'];
				}
				
				if($tablerow['litpic']=="")
				{
				   $tablerow['litpic']=$GLOBALS['cfg_cmsurl']."/templets/default/images/pic_tem.gif";
				}
				if(is_array($dtp2->CTags))
				{
					foreach($dtp2->CTags as $tagid=>$ctag)
					{
						if($ctag->GetName()=='array')
						{
							$dtp2->Assign($tagid, $tablerow);
						}
						else
						{
						  $value=empty($tablerow[$ctag->GetName()]) ? '' : $tablerow[$ctag->GetName()];
						
						  $dtp2->Assign($tagid,$value);
						}
					}
				}
				$likeType= $dtp2->GetResult();
			break;
			case 'right_hot':
				$tablerow['title']=$tablerow['title'];
				$tablerow['url'] = $GLOBALS['cfg_cmsurl'].$url;
				$tablerow['modtime']=date('Y-m-d H:i:s',$tablerow['modtime']);
				if(!empty($tablerow['smallcarpic']))
				{
				 
				  $tablerow['litpic']=$weburl.$tablerow['smallcarpic'];
				}
				
				if($tablerow['litpic']=="")
				{
				   $tablerow['litpic']=$GLOBALS['cfg_cmsurl']."/templets/default/images/pic_tem.gif";
				}
				
				$tablerow['price']=(empty($tablerow['nowprice']) || $tablerow['nowprice']==0) ? '<span class="rmb_1">电询</span>' :"<span class='rmb_1'>￥</span>".$tablerow['nowprice']."<span class=\"qi_1\">起</span>";
				if(is_array($dtp2->CTags))
				{
					foreach($dtp2->CTags as $tagid=>$ctag)
					{
						if($ctag->GetName()=='array')
						{
							$dtp2->Assign($tagid, $tablerow);
						}
						else
						{
						  $value=empty($tablerow[$ctag->GetName()]) ? '' : $tablerow[$ctag->GetName()];
						
						  $dtp2->Assign($tagid,$value);
						}
					}
				}
				$likeType= $dtp2->GetResult();
			break;
			
			case "pricerange":
				
				if($tablerow['min']!=''&&$tablerow['max']!='')
				{
					$tablerow['typename']=$tablerow['min'].'元~'.$tablerow['max'].'元';
				}
				if($tablerow['min']=='')
				{
					$tablerow['typename']=$tablerow['max'].'元以下';
					$tablerow['min']=0;
				}
				if($tablerow['max']=='')
				{
					$tablerow['typename']=$tablerow['min'].'元以上';
					$tablerow['max']=99999999;
				}
				$tablerow['title']=$tablerow['typename'];
				$tablerow['url']=$GLOBALS['cfg_cmsurl']."/cars/search_0_0_".$tablerow['aid'].'.html';
				if(is_array($dtp2->CTags))
				{
					foreach($dtp2->CTags as $tagid=>$ctag)
					{
						if($ctag->GetName()=='array')
						{
							$dtp2->Assign($tagid, $tablerow);
						}
						else
						{
						  $value=empty($tablerow[$ctag->GetName()]) ? '' : $tablerow[$ctag->GetName()];
						
						  $dtp2->Assign($tagid,$value);
						}
					}
				}
				$likeType= $dtp2->GetResult();
			break;
			case 'priceforline':
				$tablerow['title']=$tablerow['title'];
				$tablerow['url'] = $weburl.$url;
				if(is_array($dtp2->CTags))
				{
					foreach($dtp2->CTags as $tagid=>$ctag)
					{
						if($ctag->GetName()=='array')
						{
							$dtp2->Assign($tagid, $tablerow);
						}
						else
						{
						  $value=empty($tablerow[$ctag->GetName()]) ? '' : $tablerow[$ctag->GetName()];
						
						  $dtp2->Assign($tagid,$value);
						}
					}
				}
				$likeType= $dtp2->GetResult();
			break;
			case 'priceforcar':
				$tablerow['title']=$tablerow['title'];
				$tablerow['url'] = $weburl.$url;
				if(is_array($dtp2->CTags))
				{
					foreach($dtp2->CTags as $tagid=>$ctag)
					{
						if($ctag->GetName()=='array')
						{
							$dtp2->Assign($tagid, $tablerow);
						}
						else
						{
						  $value=empty($tablerow[$ctag->GetName()]) ? '' : $tablerow[$ctag->GetName()];
						
						  $dtp2->Assign($tagid,$value);
						}
					}
				}
				$likeType= $dtp2->GetResult();
			break;
			
		}
		//echo $likeType;
		
		return $likeType;
  }
  

function array_sort($arr,$keys,$type='asc')
{

    $keysvalue = $new_array = array();

    foreach ($arr as $k=>$v){

        $keysvalue[$k] = $v[$keys];
	}
	
    if($type == 'asc'){

        asort($keysvalue,SORT_NUMERIC);

    }else{
        arsort($keysvalue,SORT_NUMERIC);
      }

	
	//sort($keysvalue,SORT_NUMERIC);
	reset($keysvalue);
	

    foreach ($keysvalue as $k=>$v){

        $new_array[$k] = $arr[$k];

    }
	
	
	
 return $new_array;
}
require_once(SLINEINC.'/safe.func.php');
 
  


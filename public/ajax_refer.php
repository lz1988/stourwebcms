<?php 
require_once(dirname(__FILE__)."/../include/common.inc.php");
require_once(dirname(__FILE__)."/../include/cloudsearch.class.php");
require_once(dirname(__FILE__)."/getkeyword.php");

if($dopost=='getcloudsearch')
{
	
	if(!empty($refer))
	{
		
		$keyword=geKeyword($refer);
		
		if(!empty($keyword))
		{
			$pageno = 1;
            $pagesize = 8;
            $typeid = 0;
            $database=$cfg_searchdb;
            $searchobj=new CloudSearch();
            $searchobj->setParameter($typeid,$keyword,$pageno,$pagesize,$database);
            $result=$searchobj->getSearch();
			$out=getList($result,$keyword);
			echo $out;
			
		}
	}
	
}

if($dopost == 'Login')
{
	if($cfg_mb_open == 'Y')
	{
		if($cfg_ml->IsLogin())
		{
			$str = '<a href="' . $GLOBALS['cfg_cmsurl'] . '/member/">个人中心</a><a href="' . $GLOBALS['cfg_cmsurl'] . '/member/login.php?dopost=logout">退出登录</a>';
		}
		else
		{
			$str = '<a href="' . $GLOBALS['cfg_cmsurl'] . '/member/login.php">登录</a>' . 
			       '<a href="' . $GLOBALS['cfg_cmsurl'] . '/member/reg.php">注册</a>';
		}
	}
	else
	{
		$str = '';
	}
	echo $str;
}
function getList($list,$keyword)
{
	global $cfg_cmsurl;
	$key=urlencode($keyword);
	$str="<h3>您可能感兴趣的内容<span><a href=\"{$cfg_cmsurl}/cloudsearch_{$key}_0_1.html\" target=\"_blank\">+更多&raquo;</a></span></h3>";    
    $out='';
      
	for($i=0;isset($list[$i]);$i++)
	{
		$row=$list[$i];
		$channelname=getChannelName($row['tablename']);
		$title=setColor($keyword,cn_substr($row['title'],36));
		$litpic=getLitpic($row['imgurl'],$row['webid'],$row);
		
		$url=getUrl($row['aid'],$row['webid'],$row['tablename'],$row['tag']);
		if(!empty($row['title']))
		{
		  $out.="<li><span class=\"fl\">[{$channelname}]</span><a href=\"{$url}\" target=\"_blank\" title=\"{$row['title']}\">{$title}</a></li>";
		}
	}
	if(!empty($out))
	{
	  $out=$str."<ul>".$out."</ul>";
	}
	
    return $out;
	
}

//获取channelname
function getChannelName($tablename)
{
	$arr=array('sline_line'=>'线路',
	           'sline_hotel'=>'酒店',
			   'sline_car'=>'车务',
			   'sline_article'=>'攻略',
			   'sline_spot'=>'景点',
			   'sline_photo'=>'相册',
			   'sline_leave'=>'问答');
   $out=$arr[$tablename];
   return $out;
	
	
}
function getPreUrl($tablename,$webid)
{
	$weburl=GetWebURLByWebid($webid);
	if($webid!=0)
	{
		$arr=array('sline_line'=>'/lines/',
	           'sline_hotel'=>'/hotels/',
			   'sline_car'=>'/cars/',
			   'sline_article'=>'/raider/',
			   'sline_spot'=>'/spots/',
			   'sline_photo'=>'/photos/',
			   'sline_leave'=>'/questions/');
	}
	else
	{
		$arr=array('sline_line'=>'/lines/',
	           'sline_hotel'=>'/hotels/',
			   'sline_car'=>'/cars/',
			   'sline_article'=>'/raiders/',
			   'sline_spot'=>'/spots/',
			   'sline_photo'=>'/photos/',
			   'sline_leave'=>'/questions/');
	}
   $out=$weburl.$arr[$tablename];
   return $out;
	
	
}
//获取图像
function getLitpic($imgurl,$webid,$row)
{
	$litpic='';
	$linkurl=getUrl($row['aid'],$row['webid'],$row['tablename'],$row['tag']);
	if(!empty($imgurl))
	{
	  $url=GetWebURLByWebid($webid);
	  $litpic=$url.$imgurl;
	  $litpic=" <li class=\"search_img_1\"><a href=\"{$linkurl}\" target=\"blank\"><img src=\"{$litpic}\" width=\"112\" height=\"84\" /></a></li>";
	}
	
	
	return $litpic;
	
}
//获取链接地址
function getUrl($aid,$webid,$tablename,$tag)
{
	$url=getPreUrl($tablename,$webid);
	if($tablename!='sline_photo')
	{
	  $url.="show_{$aid}.html";	
	}
	else
	{
	  $url.="show_{$aid}_{$tag}.html";	
	}
	return $url;
}

//设置关键词颜色
function setColor($keyword,$value)
{
	
	$str=str_replace($keyword,"<span class=\"color\">{$keyword}</span>",$value);
	return $str;
	
}
?>

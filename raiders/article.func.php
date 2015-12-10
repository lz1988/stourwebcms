<?php
require_once(dirname(__FILE__)."/../include/common.inc.php");

//获取攻略信息

function getArticleInfo($aid)
{
	global $dsql;
    $webid = $GLOBALS['sys_child_webid'];
    $sql="select a.* from #@__article a where a.aid=$aid and a.webid='$webid'";
    $row=$dsql->GetOne($sql);
	return $row;
	
}

/**
 *  获得上一篇,下一篇
 *
 * @access    private
 * @return    string
 */

function GetPreNext($id)
{
	global $dsql;
	
	$aid=$id;
	$info =array();
  
	  
	$preRow =  $dsql->GetOne("Select aid,title,shownum From #@__article where aid<$aid and webid='0' order by aid desc");
	$nextRow = $dsql->GetOne("Select aid,title,shownum From #@__article where aid>$aid And webid='0' order by aid asc");

   
	if(is_array($preRow))
	{
		if(mb_strlen($preRow['title'],'utf-8')>22)
		{
		$pre_article=mb_substr($preRow['title'],0,22,'utf-8').'...';
		}
		else
		  $pre_article=$preRow['title'];
		
		$url = $GLOBALS['cfg_cmsurl']."/raiders/show_{$preRow['aid']}.html";
		$info['pre'] = "上一篇：<a href='$url'>{$pre_article}</a> ";
	   
	}
	else
	{
		$info['pre'] = "上一篇：没有了 ";
		
	}
	if(is_array($nextRow))
	{
		
		if(mb_strlen($nextRow['title'],'utf-8')>22)
		{
		  $next_article=mb_substr($nextRow['title'],0,22,'utf-8').'...';
		}
		else
		  $next_article=$nextRow['title'];
		$url = $GLOBALS['cfg_cmsurl']."/raiders/show_{$nextRow['aid']}.html";
		$info['next'] = "下一篇：<a href='$url'>{$next_article}</a> ";
	}
	else
	{
		$info['next'] = "下一篇：没有了 ";
	   
	}
  
  
	return $info;
}

//搜索页面

//获取上级
function getParkind($id)
{
	global $dsql;
	$sql = "select id,kindname from #@__destinations where id='$id'";
	$pname = $dsql->GetOne($sql);
	if(is_array($pname))
	{
		$str = ' &raquo; <a href="' . $GLOBALS['cfg_cmsurl'] . '/' . $pname['id'] . '/raiders/" rel="nofollow">' . $pname['kindname'] . '攻略</a>';
	}
	else
	{
		$str = '';
	}
	return $str;
}
   


/**
     *  生成searchtitle,keyword,description等信息.
     *
     * @access    private
     * @return    array
     */
function generateInfo($seoinfo)
{
   global $attrname;
   $arr=array();
   $subtitle=$seoinfo['shortname'];
   if($childid==0 && $attrid!=0)
   {
	  $searchtitle=$seoinfo['shortname'];     
   }
   else
   {
	  $searchtitle=$seoinfo['seotitle'];    
   }
   if(!empty($attrname))
   {
	  $searchtitle.="_{$attrname}";
	  $subtitle.="{$attrname}" ;  
   }   
  
   $arr['searchtitle']=$searchtitle;
   $arr['subtitle']=$subtitle;
   $arr['keyword']=!empty($seoinfo['keyword'])?"<meta name=\"keywords\" content=\"".$seoinfo['keyword']."\"/>":"";
   $arr['description']=!empty($seoinfo['description'])?"<meta name=\"description\" content=\"".$seoinfo['description']."\"/>":"";
   return $arr;
}


function getArticleSeoInfo($typeid,$childid=0)
{ 
  global $dsql,$sys_webid,$cfg_article_title,$cfg_article_desc;
  if($childid==0)
  {
    $sql="select shortname,seotitle,keyword,description,tagword from #@__nav where typeid={$typeid} and webid=0";
  }
  else
  {
    $sql="select a.kindname as shortname,b.seotitle,b.description,b.keyword from #@__destinations as a inner join #@__article_kindlist b on a.id=b.kindid where a.id={$childid} and isopen='1'";
  }

  $row=$dsql->GetOne($sql);
  if($childid!=0)
	{
	  $seotitle=str_replace('XXX',$row['shortname'],$cfg_article_title);
	
	  $description=str_replace('XXX',$row['shortname'],$cfg_article_desc);
	}
	
	if(empty($row['seotitle']))
	{
	   $row['seotitle']=!empty($seotitle) ? $seotitle : $row['shortname'];	
	}
	if(empty($row['description']))
	{
	   $row['description']=	!empty($description) ? $description : '';	
	}
   
   return $row;
}




function getAttName($atid)
{
   global $dsql,$attrid;
   $out='';
   if($attrid!=0)
   {
	  $attid=$attrid;
	
   }
   else
   {
	  $attid=$atid;
	  
   }
   
   $attid=str_replace('_',',',$attid);
   if(!empty($attid))
   {   
     $sql="select attrname from #@__article_attr where id in($attid)";
     $row=$dsql->GetOne($sql);
	 $out=$row['attrname'];
   }
   return $out;
   
}
function getArticleDestPinyin($destid)
{
	global $dsql;
	$sql="select pinyin  from #@__destinations where id='$destid'";
	$result=$dsql->GetOne($sql);
	
	return $result['pinyin'];
}




function getArticleNum($destid)
{
	if(empty($destid))
	  return;
	global $dsql;
	$sql="select count(*) as num from #@__article where find_in_set($destid,kindlist)";
	$result=$dsql->GetOne($sql);
	
	return $result['num'];
}
function getArticleAttrlist($attrid)
{

    global $dsql;
    $sql="select id,attrname from #@__article_attr where id in ($attrid)";
    $result=$dsql->getAll($sql);
    return $result;    
 
}
function getArticleMianbaoHtml($destid)
{
     $result=Helper_Archive::getParentDestNav($destid);
	 foreach($result as $k=>$v)
	 {
		 $str.=' &raquo; <a href="/raiders/'.$v['pinyin'].'/">'.$v['kindname'].'</a>';
	 }
	 return $str;
}
function getArticleChildDest($destid)
{
	global $dsql;
	
	if($flag)
	{
		$dest_arr=explode(',',$destid);
		sort($dest_arr);
		$destid=array_pop($dest_arr);
	}
	
	
	$destid=empty($destid)?0:$destid;
	$sql="select a.id,a.kindname from #@__destinations a left join #@__article_kindlist b on a.id=b.kindid where a.isopen=1 and a.pid='$destid' order by b.displayorder";
	$result=$dsql->getAll($sql);
	
	if(empty($result))
	{
		$sql2="select pid from #@__destinations where id='$destid'";
		$re=$dsql->GetOne($sql2);
		$sql="select a.id,a.kindname from #@__destinations a left join #@__article_kindlist b on a.id=b.kindid where a.isopen=1 and a.pid={$re['pid']} order by b.displayorder";
		$result=$dsql->getAll($sql);
	}
	return $result;
}
function getArticleDestJieshao($dest_id)
{
	global $dsql;
	$sql="select jieshao from #@__article_kindlist where kindid='$dest_id'";
	$result=$dsql->GetOne($sql);
	return $result['jieshao'];
	
}

function getArticleUrl($val=null,$key=null,$exclude=null)
{
	$arr=array('attrid');
	$url="/raiders/";
	$table="#@__article_attr";
	return Helper_Archive::getUrlStatic($val,$key,$exclude,$arr,$url,$table);
}
function getArticleUrlCls($class,$key,$val=null,$grouppid=null,$table="#@__article_attr")
{
	 return Helper_Archive::getParamUrlCls($class,$key,$val,$grouppid,$table);
}
function getArticleNewComment($articleid)
{
	global $dsql;
	$newcomment=$dsql->GetOne("select * from #@__comment where typeid=4 and articleid={$articleid} and pid=0 order by addtime desc");
		$userinfo=$GLOBALS['User']->getInfoByMid($newcomment['memberid']);
		 
		 if(empty($newcomment))
		    return '';
		//最新评论及评论数量
		$row['commentnum']=Helper_Archive::getCommentNum($row['id'],4);
		
		$row['commentlitpic']=getUploadFileUrl($userinfo['litpic']);
		$row['commentnickname']=empty($userinfo['nick'])?'匿名':$userinfo['nickname'];
		$row['commentid']=$newcomment['id'];
		$row['commentcontent']=$newcomment['content'];
		$row['commentaddtime']=$newcomment['addtime'];
	    return $row;	
}
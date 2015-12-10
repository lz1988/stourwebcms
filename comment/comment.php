<?php
    require_once(dirname(__FILE__)."/../include/common.inc.php");
	
	if($dopost=='checkcode')
	{
		$checkc=strtolower(GetCkVdValue());
        if($checkc==strtolower($checkcode))
		   echo 'ok';
		else
		   echo 'no';
		 exit;  
	}
	
	
	
	$checkc=strtolower(GetCkVdValue());
    if($checkc!=strtolower($checkcode))
		 Helper_Archive::showMsg("验证码错误",-1,0,3);
	
	if(empty($articleid)||empty($content)||empty($typeid))
	   Helper_Archive::showMsg("评论错误",-1,0,3);
	    
    $pid=empty($pid)?0:$pid;
	$dockid=empty($dockid)?0:$dockid;
	$memberid=$niming==1?0:$User->uid;
	$addtime=time();
	$content=htmlspecialchars($content);
	if(!get_magic_quotes_gpc())
	{
		$content=addslashes($content);
	}
	
	switch($typeid)
	{
		case 1:
		  $table='#@__line';
		  $urlpath='lines';
		  break;
		case 4:
		  $table='#@__article';
		  $urlpath='raiders';
		  break;
		case 6:
		  $table='#@__photo';
		  $urlpath='photos';  
		  break;
		default:
		   break;    	
	}
	
	
	$temp_aid=$dsql->GetOne("select aid from $table where id=".$articleid);
	$url="/{$urlpath}/show_{$temp_aid['aid']}.html";
	
	
	$sql="insert into #@__comment(typeid,articleid,memberid,content,pid,dockid,addtime) values($typeid,$articleid,'$memberid','$content','$pid','$dockid','$addtime')";
	$result=$dsql->ExecuteNoneQuery($sql);

	if($result)
	   Helper_Archive::showMsg("评论成功",$url,1,3);
	else
	    Helper_Archive::showMsg("评论错误",$url,0,3);   
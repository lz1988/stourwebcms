<?php
    require_once(dirname(__FILE__)."/../include/common.inc.php");
	
    $pid=empty($pid)?0:$pid;
	$dockid=empty($dockid)?0:$dockid;
	$memberid=$user->uid?$user->uid:0;
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
	
	$sql="insert into #@__comment(typeid,articleid,memberid,content,pid,dockid,addtime) values($typeid,$articleid,'$memberid','$content','$pid','$dockid','$addtime')";
	$result=$dsql->ExecuteNoneQuery($sql);

	if($result)
	   echo 'ok';
	else
	   echo 'no';   
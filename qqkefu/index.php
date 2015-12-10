<?php 
    
	
    require '../include/common.inc.php';
	
	$configfile ='config.main.php';
	
	include ($configfile);
	$path='tl'.$qqcl;
    //$path = 'tl3';
    if($display==0) exit;
	include $path.'/kefu.php';
	


 function getPrefix($webid)
 {
	 global $dsql;
	 $sql="select webprefix from #@__weblist where webid=$webid";
     $row=$dsql->GetOne($sql);
	 if(is_array($row))
	 {
	  $root=$row['webprefix'];
	 }
	 return $root;
	 
 }
 
 function getUrlContent($path,$webid)
{
	ob_start();
	include $path.'/kefu.php';
	$data=ob_get_contents();
	ob_clean();
	return $data;
}

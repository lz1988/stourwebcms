<?php 
header("HTTP/1.1 404 Not Found");
header("Status: 404 Not Found");
$GLOBALS['is404'] = 1;
require_once(dirname(__FILE__)."/include/common.inc.php");
require_once(dirname(__FILE__)."/include/view.class.php");
$pv = new View();
$pv->SetTemplet(SLINETEMPLATE ."/".$cfg_df_style ."/" . "/public/404.htm");
$pv->Display();
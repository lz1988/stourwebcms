<?php
require_once(dirname(__FILE__)."/../include/common.inc.php");
require_once(dirname(__FILE__)."/../include/visit_stats.class.php");
if($dopost == "getstats")
{
	$j = date("j") < 10 ? "0" . date("j") : date("j");
	$type = date("Y") . "||" . date("n") . "||" . $j;
	$variable = date("Y") . date("n") . $j;
	$status = new Stats($type, $variable);
	$arr = array();
	//$status->get($type,$variable);
	$arr["today"] = $status->getshow($variable);
	$arr["sums"] = $GLOBALS["cfg_stats"] + $status->getsum();
	echo json_encode($arr);
}

if($dopost == 'visit')
{
	$visit = new Visit_Stats($referrer, $php_self,$title);
	$visit->Visit();
}
?>
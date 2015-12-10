<?php
require_once(dirname(__FILE__)."/../include/common.inc.php");
$typeid=2; //酒店栏目
require_once SLINEINC."/view.class.php";

$pv = new View($typeid);

$pv->Fields['roomid'] = $roomid;

$pv->Fields['hotelid'] = $hotelid;
	
$pv->SetTemplet(SLINETEMPLATE ."/".$cfg_df_style ."/" ."hotels/" ."hotel_calendar.htm");

$pv->Display();
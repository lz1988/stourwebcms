<?php
require_once(dirname(__FILE__)."/../include/common.inc.php");
$typeid=2; //酒店栏目
require_once SLINEINC."/view.class.php";
$action = empty($action) ? 'search' : $action;
//列表搜索页
if($action=='search') //搜索页
{
    $nowdate = date('Y-m-d');
    $tomorrow = date('Y-m-d',strtotime('+1 day'));
    $searchUrl = $cfg_basehost."/ctrip/index.php?m=hotel&a=search&check_in=$nowdate&check_out=$tomorrow&cid=28";

    $pv = new View($typeid);
    $pv->GetChannelKeywords($typeid);//根据栏目类型获取关键词.介绍,栏目名称
    $templet =  SLINETEMPLATE ."/".$cfg_df_style ."/" ."hotels/" ."hotel_ctrip_index.htm";
    $pv->Fields['searchurl'] = $searchUrl;
    $pv->SetTemplet($templet);
    $pv->Display();
}
else if($action=='detail') //详细页
{
    $pv = new View($typeid);
    $detailurl = $cfg_basehost.'/ctrip/index.php?m=hotel&a=detail&hid='.$hid.'&cid='.$cid.'&cname=&check_in='.$check_in.'&check_out='.$check_out;
    $templet =  SLINETEMPLATE ."/".$cfg_df_style ."/" ."hotels/" ."hotel_ctrip_detail.htm";

    $pv->Fields['seotitle'] = $hotelname.'预订';
    $pv->Fields['keyword'] = $hotelname;
    $pv->Fields['description'] = $description;
    $pv->Fields['detailurl'] = $detailurl;
    $pv->SetTemplet($templet);
    $pv->Display();


}
else if($action == 'booking')
{
    $pv = new View($typeid);
    $bookingurl = $cfg_basehost.'/ctrip/index.php?m=hotel&a=booking&iframe='.urlencode($iframe);
    $templet =  SLINETEMPLATE ."/".$cfg_df_style ."/" ."hotels/" ."hotel_ctrip_booking.htm";
    $pv->Fields['seotitle'] ='酒店预订';
    //$pv->Fields['keyword'] = $hotelname;
   // $pv->Fields['description'] = $description;
    $pv->Fields['bookingurl'] = $bookingurl;
    $pv->SetTemplet($templet);
    $pv->Display();

}



?>
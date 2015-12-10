<?php
require_once(dirname(__FILE__)."/../include/common.inc.php");
require_once(dirname(__FILE__).'/config.php');
require_once SLINEINC."/view.class.php";
$pv = new View($typeid);
$typename = GetTypeName($typeid);
$templet =  SLINETEMPLATE."/smore/jieban/xuqiu.htm";
$pv->Fields['typename'] = $typename;
$pv->Fields['islogin'] = $User->IsLogin() ? 1 : 0;

if($User->IsLogin())
{
    $userinfo = $User->getInfoByMid($User->uid);
    $pv->Fields['kefuimage'] = empty($userinfo['litpic']) ? $GLOBALS['cfg_templets_skin'].'/images/member_default.gif' : $userinfo['litpic'];
}
else
{
    $pv->Fields['kefuimage'] =  $GLOBALS['cfg_templets_skin'].'/images/member_default.gif';
}

$pv->SetTemplet($templet);
$pv->Display();


?>
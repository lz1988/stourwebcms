<?php
require_once(dirname(__FILE__) . "/../include/common.inc.php");
require_once(SLINEROOT.'/jieban/func.php');
require_once(dirname(__FILE__) . '/config.php');

require_once SLINEINC . "/view.class.php";
$pv = new View($typeid);
if (!isset($id)) exit('Wrong Id');
$id = RemoveXSS($id); //防止跨站攻击
$row = JieBan::getProductInfo($id);
if (empty($row['id']))  head404();
if (is_array($row))
{
    JieBan::updateVisit($row['id']);
    $memberinfo = Helper_Archive::getMemberInfo($row['memberid']);
    $row['title'] = JieBan::getJiebanTitle($row);
    $row['kindnamelist'] = JieBan::getKindnameList($row,'-');

    $row['membername'] = $memberinfo['nickname'];
    $row['memberlitpic'] = $memberinfo['litpic'] ? $memberinfo['litpic'] : $GLOBALS['cfg_templets_skin'].'/images/member_default.gif';
    $row['url'] = $GLOBALS['cfg_cmsurl'].'/jieban/show_'.$row['id'].'.html';
    $row['attrlist'] = JieBan::getAttrList($row['attrid']);
    $row['joinnum'] = JieBan::getJoinNumber($row['id']);
    $row['memo'] = $row['memo']=='null' ? '' : $row['memo'];
    $row['vartime'] = empty($row['vartime']) ? 0 : $row['vartime'];

    $row['pkname'] = get_par_value($row['kindlist'], $typeid);
    $row['destid'] = array_remove_value($row['kindlist']);
    $row['pinyin'] = Helper_Archive::getDestPinyin($row['destid']);
    $row['kindid'] = $row['destid'];
    if(!empty($row['lineid']))
    {
        $row['lineinfo'] = JieBan::getLineInfo($row['lineid']);
        $GLOBALS['condition']['_hasline'] = 1;
    }
    //短信状态判断
    $msgInfo = Helper_Archive::getDefineMsgInfo2('reg_msgcode');
    if($msgInfo['isopen']==1)
    {
        $GLOBALS['condition']['_msgcode'] = 1;
        $row['msgtype'] = 'msg';
    }
    else
    {
        $GLOBALS['condition']['_txtcode'] = 1;
        $row['msgtype'] = 'txt';
    }
    @session_start();
    if(!isset($_SESSION['last_access'])||(time()-$_SESSION['last_access'])>120)
    {
        $_SESSION['last_access'] = time();
        $token = md5(time());
        $_SESSION['csrf_token_jb2'] = $token;
    }


    foreach ($row as $k => $v)
    {
        $pv->Fields[$k] = $v;
    }
}
$pv->Fields['typeid'] = $typeid;
$pv->Fields['csrf_token_jb2'] = $token;


//获取上级开启了导航的目的地
getTopNavDest($row['kindlist']);
$typename = GetTypeName($typeid); //获取栏目名称.
$pv->Fields['typename'] = $typename;
$templet = SLINETEMPLATE . "/" . $cfg_df_style . "/" . "jieban/" . "show.htm"; //系统标准模板
$pv->SetTemplet($templet);
$pv->Display();
exit();


?>

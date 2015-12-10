<?php
require_once(dirname(__FILE__) . "/../include/common.inc.php");
require_once(SLINEROOT.'/tongyong/func.php');
require_once(dirname(__FILE__) . '/config.php');

require_once SLINEINC . "/view.class.php";
$pv = new View($typeid);
if (!isset($aid)) exit('Wrong Id');
$aid = RemoveXSS($aid); //防止跨站攻击
$row = TongYong::getProductInfo($aid,$typeid);
if (empty($row['articleid']))  head404();
if (is_array($row))
{
    TongYong::updateVisit($row['articleid']);
    $row['litpic'] = !empty($row['litpic']) ? $row['litpic'] : getDefaultImage();

    $row['description'] = !empty($row['description']) ? "<meta name=\"description\" content=\"" . $row['description'] . "\"/>" : "";
    $row['keyword'] = !empty($row['keyword']) ? "<meta name=\"keywords\" content=\"" . $row['keyword'] . "\"/>" : "";

    $row['pkname'] = get_par_value($row['kindlist'], $typeid);

    $row['destid'] = array_remove_value($row['kindlist']);
    $row['pinyin'] = Helper_Archive::getDestPinyin($row['destid']);

    $row['kindid'] = $row['destid'];

    //是否设置了目的地条件,便于展示推荐线路
    if (!empty($row['destid']))
    {
        $GLOBALS['condition']['_hasdest'] = 1;
    }
    foreach ($row as $k => $v)
    {
        $pv->Fields[$k] = $v;
    }
}
$pv->Fields['typeid'] = $typeid;
$pv->Fields['modulename'] = $module_name;
$pv->Fields['modulepinyin'] = $module_pinyin;
$piclist = TongYong::handlePicture($row['piclist']);
$firstpic = isset($piclist) ? array($piclist[0]) : array('litpic'=>getDefaultImage(),'desc'=>$row['title']);
unset($piclist[0]);
//获取上级开启了导航的目的地
getTopNavDest($row['kindlist']);
$typename = GetTypeName($typeid); //获取栏目名称.
$pv->Fields['typename'] = $typename;
$pv->Fields['title'] = !empty($row['seotitle']) ? $row['seotitle'] : $row['title'];
$pv->Fields['addtime'] = empty($row['modtime']) ? $row['addtime'] : $row['modtime'];
$templets = $row['templet'];
if (strpos($templets, 'uploadtemplets') !== false) {
    $templet = SLINETEMPLATE . '/smore/' . $templets . '/index.htm'; //使用自定义模板
} else {
    $templet = SLINETEMPLATE . "/" . $cfg_df_style . "/" . "tongyong/" . "tongyong_show.htm"; //系统标准模板
}
$pv->SetTemplet($templet);
$pv->Display();
exit();


?>

<?php

/**----
 * search.php 可接收4个参数
 *
 * 参数1:$dest_id 子栏目
 * 参数2:$totalresult,总页数.
 * 参数3:$pageno,当前页
 *------*/
@session_start();


require_once(dirname(__FILE__) . "/../include/common.inc.php");
$file = SLINEDATA . "/autotitle.cache.inc.php"; //载入智能title配置
require_once(dirname(__FILE__) . "/photo.func.php");
require_once SLINEINC . "/view.class.php";


if (file_exists($file))
{
    require_once($file);
}

$typeid = 6; //栏目

if (!is_numeric($dest_id) && !empty($dest_id)) //如果dest_id不是数字,则用户使用拼音访问需要获取相应的目的地id,否则,则直接赋值
{

    $d_id = Helper_Archive::getDestIdByPinYin($dest_id);
    $dest_id = !empty($d_id) ? $d_id : $dest_id;
    if ($dest_id == 'all')
    {
        $dest_id = 0;
    }
}

$html = dirname(__FILE__) . '/index.html';
if (file_exists($html) && $genpage != 1)
{
    include($html);
    exit;
}


require_once SLINEINC . "/listview.class.php";

$pv = new View($typeid);
$pv->GetChannelKeywords($typeid);
$pv->Fields['seokeyword'] = !empty($pv->Fields['seokeyword']) ? "<meta name=\"keywords\" content=\"" . $pv->Fields['seokeyword'] . "\"/>" : "";
$pv->Fields['seodescription'] = !empty($pv->Fields['seodescription']) ? "<meta name=\"description\" content=\"" . $pv->Fields['seodescription'] . "\"/>" : "";
$pv->Fields['seotitle'] = !empty($pv->Fields['seotitle']) ? $pv->Fields['seotitle'] : $pv->Fields['shortname'];

Helper_Archive::loadModule('common');

$dest_id = RemoveXSS($dest_id); //防止跨站攻击
$attrid = Helper_Archive::pregReplace($attrid,4);

getTopNavDest($dest_id); //顶部导航
$typename = GetTypeName($typeid);

$where = "a.webid is not null";
if (!empty($dest_id))
{
    $where .= " and FIND_IN_SET($dest_id,a.kindlist)";
    $join = " #@__kindorderlist b on(a.id = b.aid and b.typeid='6' and b.classid='$dest_id') ";
    $tableorder = " ifnull(b.isding,0) desc,ifnull(b.isjian,0) desc,ifnull(b.displayorder,9999) asc,a.modtime desc,a.addtime desc";
    $destinfo = getPhotoDestInfo($dest_id);


    $pv->Fields['seokeyword'] = !empty($destinfo['keyword']) ? "<meta name=\"keywords\" content=\"" . $destinfo['keyword'] . "\"/>" : "";
    $pv->Fields['seodescription'] = !empty($destinfo['description']) ? "<meta name=\"description\" content=\"" . $destinfo['description'] . "\"/>" : "";
    $pv->Fields['seotitle'] = !empty($destinfo['seotitle']) ? $destinfo['seotitle'] : $destinfo['shortname'];


}
else
{
    $join = " #@__allorderlist b on(a.id = b.aid and b.typeid='6') ";
    $tableorder = " ifnull(b.isding,0) desc,ifnull(b.isjian,0) desc,ifnull(b.displayorder,9999) asc,a.modtime desc,a.addtime desc";
}
if (!empty($attrid))
{
    $attrid_arr = explode('_', $attrid);
    foreach ($attrid_arr as $k => $v)
    {
        $where .= !empty($v) ? " and FIND_IN_SET($v,a.attrid)" : '';
    }
}


$_photoModule = new CommonModule('sline_photo as a');


//获取目的地列表 
$destlist = getPhotoChildDest($dest_id);

//获取目的地面包屑
$mianbao = getPhotoMianbao($dest_id);

//获取结果集
$pagesize = 12; //每页数量
$pageno = empty($pageno) ? 1 : $pageno; //第几页
$offset = ($pageno - 1) * $pagesize;
$count = $_photoModule->getCount($where);

$photolist = $_photoModule->getAll($where, $tableorder, "$offset,$pagesize", "a.*", $join);
$page = getPhotoPage($count, $pageno, $pagesize, array('dest_id' => $dest_id, 'attrid' => $attrid)); //获取分页结果

foreach ($photolist as $k => $v)
{
    $weburl = GetWebURLByWebid($v['webid']);
    $photolist[$k]['pic'] = getUploadFileUrl(str_replace('litimg', 'allimg', $v['litpic']));

    $photolist[$k]['url'] = $weburl . '/photos/show_' . $v['aid'] . '.html';


}


$destname = !empty($dest_id) ? Helper_Archive::getDestName($dest_id) : '全部';

foreach ($attrid_arr as $k => $v)
{
    $attrname .= !empty($v) ? getPhotoAttrName($v) . '-' : '';
}
$attrname = trim($attrname, '-');
$seotitle = $pageno > 1 ? "第{$pageno}页" : '';
if ((!empty($destname) || !empty($attrname)) && $destname != '全部')
{
    $seotitle .= $attrname;
    $pv->Fields['seotitle'] .= '-' . $seotitle;

}
//模板选择
$templet = Helper_Archive::getUseTemplet('photo_index'); //获取使用模板
$templet = !empty($templet) ? $templet : SLINETEMPLATE . "/" . $cfg_df_style . "/" . "photos/" . "photo_index.htm"; //默认模板
$pv->SetTemplet($templet);
$pv->Display();
exit();


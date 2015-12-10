<?php

/**----
 * search.php 可接收4个参数
 *
 * 参数1:$dest_id 子栏目
 * 参数2:$totalresult,总页数.
 * 参数3:$pageno,当前页
*/

require_once(dirname(__FILE__) . "/../include/common.inc.php");
$file = SLINEDATA . "/autotitle.cache.inc.php"; //载入智能title配置
require_once SLINEINC . "/view.class.php";
require_once(dirname(__FILE__) . "/question.func.php");

if (file_exists($file))
{
    require_once($file);
}

$typeid = 10; //栏目
$pageno=$_GET['page'];

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
$typename = GetTypeName($typeid);
$_leaveModule = new CommonModule('sline_question');

//获取结果集
$where='status=1 and webid='.$GLOBALS['sys_child_webid'];
$tableorder="replytime desc";
$pagesize = 12; //每页数量
$pageno = empty($pageno) ? 1 : $pageno; //第几页
$offset = ($pageno - 1) * $pagesize;
$count = $_leaveModule->getCount($where);
$totalcount=$_leaveModule->getCount("id is not null and webid={$GLOBALS['sys_child_webid']}");


$list = $_leaveModule->getAll($where, $tableorder, "$offset,$pagesize");
foreach($list as $k=>$v) {
     $list[$k]['title']=$v['questype']==0?get_productname($v['typeid'],$v['productid']):$v['title'];
}
$pagestr=page($count,$pageno,$pagesize,'/questions/{page}',5,'/questions');

if($User->IsLogin()) {
    $userinfo = $User->getInfoByMid($User->uid);
}

//模板选择
$templet = Helper_Archive::getUseTemplet('questions_index'); //获取使用模板
$templet = !empty($templet) ? $templet : SLINETEMPLATE . "/" . $cfg_df_style . "/" . "questions/" . "questions_index.htm"; //默认模板
$pv->SetTemplet($templet);

$pv->Display();
exit();


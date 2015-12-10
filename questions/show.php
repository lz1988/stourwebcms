<?php

/**----
 * search.php 可接收4个参数
 *
 * 参数1:$dest_id 子栏目
 * 参数2:$totalresult,总页数.
 * 参数3:$pageno,当前页
 *------*/



require_once(dirname(__FILE__) . "/../include/common.inc.php");
$file = SLINEDATA . "/autotitle.cache.inc.php"; //载入智能title配置
require_once SLINEINC . "/view.class.php";
require_once(dirname(__FILE__) . "/question.func.php");

if (file_exists($file))
{
    require_once($file);
}

$typeid = 10; //栏目

$id=$_GET['id'];
if(!is_numeric($id))
    exit('wrong ID');
$html = dirname(__FILE__) . '/questions_show.html';
if (file_exists($html) && $genpage != 1)
{
    include($html);
    exit;
}
require_once SLINEINC . "/listview.class.php";
$pv = new View($typeid);



Helper_Archive::loadModule('common');
$_leaveModule = new CommonModule('sline_question');

$row=$_leaveModule->getOne('id='.$id);
$where='status=1 and webid='.$GLOBALS['sys_child_webid'];
$count = $_leaveModule->getCount($where);
$totalcount=$_leaveModule->getCount("id is not null and webid={$GLOBALS['sys_child_webid']}");
$row['title']=$row['questype']==0?get_productname($row['typeid'],$row['productid']):$row['title'];

$pv->Fields['seotitle'] =$row['title'] ;
foreach($row as $k=>$v)
{
    $pv->Fields[$k] = $v;//模板变量赋值
}

//模板选择
$templet = Helper_Archive::getUseTemplet('questions_show'); //获取使用模板
$templet = !empty($templet) ? $templet : SLINETEMPLATE . "/" . $cfg_df_style . "/" . "questions/" . "questions_show.htm"; //默认模板
$pv->SetTemplet($templet);

$pv->Display();
exit();


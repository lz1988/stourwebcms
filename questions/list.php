<?php
require_once(dirname(__FILE__)."/../include/common.inc.php");

$typeid=10; //攻略栏目
require_once SLINEINC."/listview.class.php";
if(isset($totalresult)) $totalresult = intval(preg_replace("/[^\d]/", '', $totalresult));//总记录数

if(isset($pageno)) $pageno = intval(preg_replace("/[^\d]/", '', $pageno));//当前页

if($tid == '7')
{
	$sql="select * from #@__leave where reply is null and approval='1' order by addtime desc";
}
else if($tid == '8')
{
	$sql="select * from #@__leave where reply is not null and approval='1' order by addtime desc";
}
else
{
	$sql="select * from #@__leave where typeid='$tid' and approval='1' order by addtime desc";
}

$pv = new ListView($typeid);
$pv->listGetChannelKeywords($typeid);//根据栏目类型获取关键词.介绍,栏目名称
$pv->Fields['name'] = GetName($tid);
$pv->pagesize=30;//分页条数.

$pv->SetSql($sql);

//注意以下这两句与伪静态规则有关系,不能写反了.
$pv->SetParameter('tid',$tid);

$pv->SetTemplet(SLINETEMPLATE ."/".$cfg_df_style ."/" ."questions/" ."list.htm");

$pv->Display();

function GetName($typeid)
{
	global $dsql;
	$sql = "select shortname from #@__nav where webid='0' and isopen='1' and typeid='$typeid'";
	$row = $dsql->GetOne($sql);
	return $row['shortname'];
}
?>

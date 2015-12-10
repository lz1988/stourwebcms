<?php
require_once(dirname(__FILE__)."/../include/common.inc.php");
require_once(dirname(__FILE__)."/destination.index.class.php");
require_once SLINEINC."/view.class.php";
$typeid = 12;
$pv = new View($typeid);

//$dest = new DestinationCache();

$pv->GetChannelKeywords(12);//根据栏目类型获取关键词.介绍,栏目名称

$pv->Fields['seokeyword']=!empty($pv->Fields['seokeyword'])?"<meta name=\"keywords\" content=\"".$pv->Fields['seokeyword']."\"/>":"";
$pv->Fields['seodescription']=!empty($pv->Fields['seodescription'])?"<meta name=\"description\" content=\"".$pv->Fields['seodescription']."\"/>":"";
//$pv->Fields['list'] = $dest->getCacheDest();
$templet = Helper_Archive::getUseTemplet('dest_boot');//获取目的地引导页使用模板
$templet = !empty($templet) ? $templet : SLINETEMPLATE ."/".$cfg_df_style ."/" ."destination/" ."index.htm";
$pv->SetTemplet($templet);
$pv->Display();

//功能函数

//获取目的地下级HTML
function getDestChildHtml($pid)
{
	Helper_Archive::loadModule('common');
	$model = new CommonModule('#@__destinations');
	$arr = $model->getAll("pid='$pid' and isopen=1","displayorder asc");
    $out = '';
	foreach($arr as $row)
	{
		$num = $model->getCount("pid='{$row['id']}'");
		$class = $num ? " class='haschild'" : "";
		$url = $GLOBALS['cfg_basehost'].'/'.$row['pinyin'].'/';
		$out.='<dd><a href="'.$url.'" target="_blank"'.$class.' data-id="'.$row['id'].'">'.$row['kindname'].'</a></dd>';
		
	}
	return $out;
	
}
?>
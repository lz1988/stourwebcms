<?php
require_once(dirname(__FILE__)."/../include/common.inc.php");
$typeid=4; //酒店栏目
require_once SLINEINC."/view.class.php";
$html = dirname(__FILE__).'/index.html';
if(file_exists($html) && $genpage != 1)
{
    include($html);
    exit;
}
else
{

    $pv = new View($typeid);
    $pv->GetChannelKeywords($typeid);//根据栏目类型获取关键词.介绍,栏目名称
    $templet = Helper_Archive::getUseTemplet('article_index');//获取首页使用模板
    $templet = !empty($templet) ? $templet : SLINETEMPLATE ."/".$cfg_df_style ."/" ."raiders/" ."article_index.htm";
    $pv->SetTemplet($templet);
    $pv->Display();
    exit();
}
?>
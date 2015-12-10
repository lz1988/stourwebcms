<?php 
  require_once(dirname(__FILE__)."/../include/common.inc.php");
  require_once SLINEINC."/view.class.php";
  $typeid=3; //车务栏目
$html = dirname(__FILE__).'/index.html';
if(file_exists($html) && $genpage != 1)
{
    include($html);
    exit;
}
else
{
   //获取上级开启了导航的目的地
  getTopNavDest($dest_id);
  $pv = new View($typeid);
  $pv->GetChannelKeywords($typeid);//根据栏目类型获取关键词.介绍,栏目名称
  $templet = Helper_Archive::getUseTemplet('car_index');//获取首页使用模板
  $templet = !empty($templet) ? $templet : SLINETEMPLATE ."/".$cfg_df_style ."/" ."cars/" ."car_index.htm";
  $pv->SetTemplet($templet);
  $pv->Display();
  exit();
}
?>

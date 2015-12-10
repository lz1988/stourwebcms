<?php 
/*--
接收一个参数:serverid,副导航id.

*/
require_once(dirname(__FILE__)."/../include/common.inc.php");
require_once(dirname(__FILE__)."/../data/webinfo.php");

$typeid=0; 

if(!isset($aid)) ShowMsg('非法操作','-1',1);
$sql="select * from #@__serverlist where webid=0 and aid=$aid";
$row=$dsql->GetOne($sql);
require_once SLINEINC."/view.class.php";
$pv = new View($typeid);

//副导航基本信息
  foreach($row as $k=>$v)
   {
      $pv->Fields[$k] = $v;
   }

$templet = Helper_Archive::getUseTemplet('footer_show');//获取使用模板
$templet = !empty($templet) ? $templet : SLINETEMPLATE ."/".$cfg_df_style ."/" ."servers/" ."index.htm";
$pv->SetTemplet($templet);
$pv->Display();


?>
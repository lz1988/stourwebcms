<?php 
/*--
接收一个参数:aid,帮助aid.

*/
require_once(dirname(__FILE__)."/../include/common.inc.php");
require_once(dirname(__FILE__)."/../data/webinfo.php");
require_once SLINEINC."/view.class.php";
$typeid=0; 

if(!isset($aid)) ShowMsg('非法操作','-1',1);
$sql="select * from #@__help where webid=$sys_webid and aid=$aid";

$row=$dsql->GetOne($sql);

$kindarr=getHelpkind($aid);
$kindid=$kindarr['kindid'];
$kindname=$kindarr['kindname'];



$pv = new View($typeid);


//帮助基本信息
  foreach($row as $k=>$v)
   {
      $pv->Fields[$k] = $v;
   }
 //帮助分类信息

$pv->Fields['kindid'] = $kindid;

$pv->Fields['kindname']=$kindname;
$templet = Helper_Archive::getUseTemplet('help_show');//获取首页使用模板
$templet = !empty($templet) ? $templet : SLINETEMPLATE ."/".$cfg_df_style ."/" ."help/" ."help_show.htm";
$pv->SetTemplet($templet);
$pv->Display();

/**
     *  根据帮助id获得帮助分类名称
     *
     * @access    private
     * @return    arr
     */
function getHelpkind($aid)
{
   global $dsql;
   $kindname=array();
   $sql="select a.id as kindid,a.kindname from #@__help_kind a inner join #@__help b on a.id=b.kindid where a.webid=0 and b.aid=$aid";
   $row=$dsql->GetOne($sql);
   if(is_array($row))
   {
      $kindname['kindid']=$row['kindid'];
	  $kindname['kindname']=$row['kindname'];
   }
   return $kindname;


}
?>
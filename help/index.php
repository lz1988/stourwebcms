<?php 
/*--
接收一个参数:kindid,帮助类型id.

*/
require_once(dirname(__FILE__)."/../include/common.inc.php");
require_once(dirname(__FILE__)."/../data/webinfo.php");

$typeid=0; 

if(!isset($aid)) ShowMsg('非法操作','-1',1);
$kindname=GetHelpkind($aid);


require_once SLINEINC."/view.class.php";

$pv = new View($typeid);

$pv->Fields['helpkindid'] = $aid;//帮助分类id

$pv->Fields['sonid'] = $aid; //帮助分类id

$pv->Fields['kindname']=$kindname;
	
$pv->SetTemplet(SLINETEMPLATE ."/".$cfg_df_style ."/" ."help/" ."help_index.htm");

$pv->Display();
   


/**
     *  获得帮助分类名称
     *
     * @access    private
     * @return    string
     */
function GetHelpkind($aid)
{
   global $dsql;
   $kindname='';
   $sql="select aid,kindname from #@__help_kind where webid=0 and id=$aid";
   $row=$dsql->GetOne($sql);
   if(is_array($row))
   {
      $kindname=$row['kindname'];
   }
   return $kindname;


}
?>
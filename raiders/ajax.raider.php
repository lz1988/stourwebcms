<?php 
/*-----攻略ajax操作控制器-----*/
require_once(dirname(__FILE__)."/../include/common.inc.php");

if($action == 'adddownnum')
{
    $articleid = Helper_Archive::pregReplace($articleid,2);
    $sql = "update sline_article set downnum=downnum+1 where id='$articleid'";
    $dsql->ExecNoneQuery($sql);
}


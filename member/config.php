<?php
require_once(dirname(__FILE__).'/../include/common.inc.php');
require_once(SLINEINC.'/view.class.php');
require_once(SLINEINC.'/listview.class.php');
require_once(dirname(__FILE__).'/member.func.php');//载入功能函数
define('MEMBERTEMPLET',SLINETEMPLATE ."/".$cfg_df_style ."/member/");
$uid=$User->uid;//用户Mid


//检查是否开放会员功能
if($cfg_mb_open=='N')
{
    ShowMsg("系统关闭了会员功能，因此你无法访问此页面！","javascript:;");
    exit();
}




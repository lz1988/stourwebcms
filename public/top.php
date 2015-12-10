<?php


require_once (dirname(__FILE__) . "../../include/common.inc.php");

require_once SLINEINC."/view.class.php";

    $pv = new View();
    $templet = $page=='header' ? 'header_sys_only.htm' :'footer_sys_only.htm';

    $templet = SLINETEMPLATE ."/".$cfg_df_style ."/" . "public/{$templet}";
    $pv->SetTemplet($templet);
    $pv->Display();



?>
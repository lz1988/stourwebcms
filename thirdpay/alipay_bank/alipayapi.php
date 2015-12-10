<?php

require  dirname(dirname(dirname(__FILE__))).'/include/common.inc.php';
require_once SLINEINC."/view.class.php";

$pv = new View();
$templet=SLINEROOT.'/thirdpay/alipay_bank/tpl/index.htm';
$pv->SetTemplet($templet);
$pv->Display();
exit;

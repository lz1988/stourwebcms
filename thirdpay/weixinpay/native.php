<?php
require  dirname(dirname(dirname(__FILE__))).'/include/common.inc.php';
require_once SLINEINC."/view.class.php";

$pv = new View();

require_once "lib/WxPay.Api.php";
require_once "example/WxPay.NativePay.php";
require_once 'example/log.php';

$notify = new NativePay();
$input = new WxPayUnifiedOrder();

$input->SetBody($_POST['subject']);
$input->SetAttach("");
$input->SetOut_trade_no( $_POST['ordersn']);
$input->SetTotal_fee($_POST['price']*100);
$input->SetTime_start(date("YmdHis"));
$input->SetTime_expire(date("YmdHis", time() + 600));
$input->SetGoods_tag("");
$input->SetNotify_url($GLOBALS['cfg_basehost'].'/thirdpay/weixinpay/notify.php');
$input->SetTrade_type("NATIVE");
$input->SetProduct_id($_POST['ordersn']);


$result = $notify->GetPayUrl($input);
$url2 =urlencode($result["code_url"]);


$templet=SLINEROOT.'/thirdpay/weixinpay/tpl/native.htm';
$pv->SetTemplet($templet);
$pv->Display();
exit;

?>


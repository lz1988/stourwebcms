<?php

//前台支付接口示例
ini_set('display_errors',0);
require  dirname(__FILE__).'/../include/common.inc.php';
require_once('api/quickpay_service.php');

//下面这行用于测试，以生成随机且唯一的订单号


mt_srand(quickpay_service::make_seed());

$orderAmount = $_POST['price']*100;//总金额
$orderNumber = $_POST['ordersn'];//订单号
quickpay_conf::$security_key = $cfg_yinlian_securitykey;//key
quickpay_conf::$pay_params['merId'] = $cfg_yinlian_merid;//商户号
quickpay_conf::$pay_params['merAbbr'] =$cfg_yinlian_mername;;//商户名称

$param['transType']             = quickpay_conf::CONSUME;  //交易类型，CONSUME or PRE_AUTH

$param['orderAmount']           = $orderAmount;        //交易金额
$param['orderNumber']           = $orderNumber; //订单号，必须唯一
$param['orderTime']             = date('YmdHis');   //交易时间, YYYYmmhhddHHMMSS
$param['orderCurrency']         = quickpay_conf::CURRENCY_CNY;  //交易币种，CURRENCY_CNY=>人民币

$param['customerIp']            = $_SERVER['REMOTE_ADDR'];  //用户IP
$param['frontEndUrl']           = $GLOBALS['cfg_basehost']."/yinlian/front_notify.php";    //前台回调URL
$param['backEndUrl']            = $GLOBALS['cfg_basehost']."/yinlian/back_notify.php";    //后台回调URL

/* 可填空字段
   $param['commodityUrl']          = "http://www.example.com/product?name=商品";  //商品URL
   $param['commodityName']         = '商品名称';   //商品名称
   $param['commodityUnitPrice']    = 11000;        //商品单价
   $param['commodityQuantity']     = 1;            //商品数量
//*/

//其余可填空的参数可以不填写

$pay_service = new quickpay_service($param, quickpay_conf::FRONT_PAY);
$html = $pay_service->create_html();


header("Content-Type: text/html; charset=" . quickpay_conf::$pay_params['charset']);
//print_r($pay_service);
echo $html; //自动post表单

?>

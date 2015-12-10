<?php

require  dirname(dirname(dirname(__FILE__))).'/include/common.inc.php';
include_once $_SERVER ['DOCUMENT_ROOT'] . '/thirdpay/yinlian/func/common.php';
include_once $_SERVER ['DOCUMENT_ROOT'] . '/thirdpay/yinlian/func/secureUtil.php';

$paySource='银联支付';
if (isset ( $_POST ['signature'] )) {
    if(verify($_POST)) {

        $orderid = $_POST ['orderId']; //其他字段也可用类似方式获取
        Helper_Archive::paySuccess($orderid,$paySource,$_POST);

    }
   } else {
    echo '签名为空';
}


<?php
    require  dirname(dirname(dirname(__FILE__))).'/include/common.inc.php';
    //EBC支付网关.交易
    //$ebc_gateway_trade = "http://172.168.0.42:8084/ebc-pay/trade.action";
    $ebc_gateway_trade = "http://pay-test.bjebc.com/trade.action";
    //EBC支付网关.退款
    //$ebc_gateway_refund = "http://172.168.0.42:8084/ebc-pay/refund.action";
    $ebc_gateway_refund = "http://pay-test.bjebc.com/refund.action";
    //EBC为商户分配的商户号
    //$ebc_partner = "900000000000009";
    $ebc_partner = $GLOBALS['cfg_qianbao_merchno'];

    //EBC为商户分配的密钥
    //$ebc_key = "A4127B50-8C/28-11E0-94E4-FD88AD19719E";
    $ebc_key = $GLOBALS['cfg_qianbao_key'];
    //EBC参数编码字符集 utf-8,gbk,......
    $ebc_charset = "utf-8";
    //EBC签名方式 md5
    $ebc_sign_type = "MD5-32";
    //交易接入版本号
    $ebc_trade_version = "";
    //退款接入版本号
    $ebc_refund_version = "";
    //日志级别
    $ebc_log_level = "";//"debug";
?>
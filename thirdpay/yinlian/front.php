<?php
header ( 'Content-type:text/html;charset=utf-8' );
require  dirname(dirname(dirname(__FILE__))).'/include/common.inc.php';

include_once $_SERVER ['DOCUMENT_ROOT'] . '/thirdpay/yinlian/func/common.php';
include_once $_SERVER ['DOCUMENT_ROOT'] . '/thirdpay/yinlian/func/SDKConfig.php';
include_once $_SERVER ['DOCUMENT_ROOT'] . '/thirdpay/yinlian/func/secureUtil.php';
include_once $_SERVER ['DOCUMENT_ROOT'] . '/thirdpay/yinlian/func/log.class.php';
/**
 * 消费交易-前台 
 */


/**
 *	以下代码只是为了方便商户测试而提供的样例代码，商户可以根据自己需要，按照技术文档编写。该代码仅供参考
 */
// 初始化日志
$log = new PhpLog ( SDK_LOG_FILE_PATH, "PRC", SDK_LOG_LEVEL );
$log->LogInfo ( "============处理前台请求开始===============" );
// 初始化日志
$params = array(
    'version' => '5.0.0',				//版本号
    'encoding' => 'utf-8',				//编码方式
    'certId' => getSignCertId (),			//证书ID
    'txnType' => '01',				//交易类型
    'txnSubType' => '01',				//交易子类
    'bizType' => '000201',				//业务类型
    'frontUrl' => empty($_POST['showurl'])?$GLOBALS['cfg_basehost']:$_POST['showurl'],  		//前台通知地址
    'backUrl' => $GLOBALS['cfg_basehost'].'/thirdpay/yinlian/back_notify.php',		//后台通知地址
    'signMethod' => '01',		//签名方法
    'channelType' => '07',		//渠道类型，07-PC，08-手机
    'accessType' => '0',		//接入类型
    'merId' => $GLOBALS['cfg_yinlian_new_name'],		        //商户代码，请改自己的测试商户号
    'orderId' =>  $_POST['ordersn'],	//商户订单号
    'txnTime' => date('YmdHis'),	//订单发送时间
    'txnAmt' => $_POST['price']*100,		//交易金额，单位分
    'currencyCode' => '156',	//交易币种
    'defaultPayType' => '0001',	//默认支付方式
    //'orderDesc' => '订单描述',  //订单描述，网关支付和wap支付暂时不起作用
    'reqReserved' =>'yes', //请求方保留域，透传字段，查询、通知、对账文件中均会原样出现
);


// 签名
sign ( $params );


// 前台请求地址
$front_uri = SDK_FRONT_TRANS_URL;
$log->LogInfo ( "前台请求地址为>" . $front_uri );
// 构造 自动提交的表单
$html_form = create_html ( $params, $front_uri );

$log->LogInfo ( "-------前台交易自动提交表单>--begin----" );
$log->LogInfo ( $html_form );
$log->LogInfo ( "-------前台交易自动提交表单>--end-------" );
$log->LogInfo ( "============处理前台请求 结束===========" );
echo $html_form;

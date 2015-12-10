<?php
/**
* 	配置账号信息
*/

define('GV_WX_APPID', $GLOBALS['cfg_wxpay_appid']);
define('GV_WC_MCHID', $GLOBALS['cfg_wxpay_mchid']);
define('GV_WX_KEY', $GLOBALS['cfg_wxpay_key']);
define('GV_WX_APPSECRET', $GLOBALS['cfg_wxpay_appsecret']);
//提交数据接口地址
define('GV_JS_API_CALL_URL', 'http://'.$_SERVER["SERVER_NAME"].'/shouji/thirdpay/weixinpay');
define('GV_NOTIFY_URL', 'http://'.$_SERVER["SERVER_NAME"].'/shouji/thirdpay/weixinpay_notifyurl');
class WxPayConf_pub
{
	//=======【基本信息设置】=====================================
	//微信公众号身份的唯一标识。审核通过后，在微信发送的邮件中查看
	const APPID = GV_WX_APPID;
	//'wxd5e639148f3fe6e1';
	//受理商ID，身份标识
	const MCHID = GV_WC_MCHID;
	//'1225939602';
	//商户支付密钥Key。审核通过后，在微信发送的邮件中查看
	const KEY = GV_WX_KEY;
	//'e10adc3949ba59abbe56e057f20f883e';
	//JSAPI接口中获取openid，审核后在公众平台开启开发模式后可查看
	const APPSECRET = GV_WX_APPSECRET;
	//'343e2e51fb4690743b32da71df75ff0f';
	
	//=======【JSAPI路径设置】===================================
	//获取access_token过程中的跳转uri，通过跳转将code传入jsapi支付页面
	const JS_API_CALL_URL = GV_JS_API_CALL_URL;
	
	//=======【证书路径设置】=====================================
	//证书路径,注意应该填写绝对路径
	const SSLCERT_PATH = '/shouji/public/thirdpay/weixinpay/WxPayPubHelper/cacert/apiclient_cert.pem';
	const SSLKEY_PATH = '/shouji/public/thirdpay/weixinpay/WxPayPubHelper/cacert/apiclient_key.pem';
	
	//=======【异步通知url设置】===================================
	//异步通知url，商户根据实际开发过程设定
	const NOTIFY_URL = GV_NOTIFY_URL;

	//=======【curl超时设置】===================================
	//本例程通过curl使用HTTP POST方法，此处可修改其超时时间，默认为30秒
	const CURL_TIMEOUT = 30;
}

?>
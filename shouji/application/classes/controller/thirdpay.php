<?php defined('SYSPATH') or die('No direct script access.');
/*
 * 第三方支付控制器
 * */
class Controller_Thirdpay extends Stourweb_Controller{

    public function before()
    {
        parent::before();
    }

    /*
     * 快钱支付
     * */
    public function action_bill()
    {
        $kq_target="https://www.99bill.com/mobilegateway/recvMerchantInfoAction.htm";
        $kq_merchantAcctId = Common::getSysConf('value','cfg_bill_account',0)."01";   //*  商家用户编号		(30)
        $kq_key = Common::getSysConf('value','cfg_bill_key',0);
        $kq_inputCharset	= "1";	//   1 ->  UTF-8		2 -> GBK		3 -> GB2312   default: 1	(2)
        $kq_pageUrl	    = $GLOBALS['cfg_basehost']."/shouji/thirdpay/bill_return";	//   直接跳转页面	(256)
        $kq_bgUrl	    = $GLOBALS['cfg_basehost']."/shouji/thirdpay/bill_notify";	//   后台通知页面	(256)
        $kq_version	    = "mobile1.0";	//*	 版本  固定值 v2.0	(10)
        $kq_language		= "1";	//*  默认 1 ， 显示 汉语	(2)
        $kq_signType		= "1";   //*  固定值 1 表示 MD5 加密方式 , 4 表示 PKI 证书签名方式	(2)
        $kq_payerName		= "";	//   英文或者中文字符	(32)
        $kq_payerContactType = "1";  //  支付人联系类型  固定值： 1  代表电子邮件方式 (2)
        $kq_payerContact   = "";	//	 支付人联系方式	(50)
        $kq_orderId		= $_POST['ordersn'];	//*  字母数字或者, _ , - ,  并且字母数字开头 并且在自身交易中式唯一	(50)
        $kq_orderAmount	= $_POST['price']*100;	//*	  字符金额 以 分为单位 比如 10 元， 应写成 1000	(10)
        $kq_orderTime		= date(YmdHis);  //*  交易时间  格式: 20110805110533
        $kq_productName	= $_POST['subject'];	//	  商品名称英文或者中文字符串(256)
        $kq_productNum		= "1";	//	  商品数量	(8)
        $kq_productId		= "";   //    商品代码，可以是 字母,数字,-,_   (20)
        $kq_productDesc	= "sd";	//	  商品描述， 英文或者中文字符串  (400)
        $kq_ext1			= "";   //	  扩展字段， 英文或者中文字符串，支付完成后，按照原样返回给商户。 (128)
        $kq_ext2			= "";
        $kq_payType		= "00";	//*   支付方式 固定值: 00, 10, 11, 12, 13, 14, 15, 16, 17  (2)
        // 00: 其他支付
        // 10: 银行卡支付
        // 11: 电话支付
        // 12: 快钱账户支付
        // 13: 线下支付
        // 14: 企业网银在线支付
        // 15: 信用卡在线支付
        // 17: 预付卡支付
        // *B2B 支付需要单独申请，默认不开通
        $kq_bankId			= "";   // 银行代码 银行代码 要在开通银行时 使用， 默认不开通 (8)
        $kq_redoFlag		= "0";   // 同一订单禁止重复提交标志  固定值 1 、 0
        // 1 表示同一订单只允许提交一次 ； 0 表示在订单没有支付成功状态下 可以重复提交； 默认 0
        $kq_pid			= "";   //  合作伙伴在快钱的用户编号 (30)
        $kq_all_para=self::kq_ck_null($kq_inputCharset,'inputCharset');
        $kq_all_para.=self::kq_ck_null($kq_pageUrl,"pageUrl");
        $kq_all_para.=self::kq_ck_null($kq_bgUrl,'bgUrl');
        $kq_all_para.=self::kq_ck_null($kq_version,'version');
        $kq_all_para.=self::kq_ck_null($kq_language,'language');
        $kq_all_para.=self::kq_ck_null($kq_signType,'signType');
        $kq_all_para.=self::kq_ck_null($kq_merchantAcctId,'merchantAcctId');
        $kq_all_para.=self::kq_ck_null($kq_payerName,'payerName');
        $kq_all_para.=self::kq_ck_null($kq_payerContactType,'payerContactType');
        $kq_all_para.=self::kq_ck_null($kq_payerContact,'payerContact');
        $kq_all_para.=self::kq_ck_null($kq_orderId,'orderId');
        $kq_all_para.=self::kq_ck_null($kq_orderAmount,'orderAmount');
        $kq_all_para.=self::kq_ck_null($kq_orderTime,'orderTime');
        $kq_all_para.=self::kq_ck_null($kq_productName,'productName');
        $kq_all_para.=self::kq_ck_null($kq_productNum,'productNum');
        $kq_all_para.=self::kq_ck_null($kq_productId,'productId');
        $kq_all_para.=self::kq_ck_null($kq_productDesc,'productDesc');
        $kq_all_para.=self::kq_ck_null($kq_ext1,'ext1');
        $kq_all_para.=self::kq_ck_null($kq_ext2,'ext2');
        $kq_all_para.=self::kq_ck_null($kq_payType,'payType');
        $kq_all_para.=self::kq_ck_null($kq_bankId,'bankId');;
        $kq_all_para.=self::kq_ck_null($kq_redoFlag,'redoFlag');
        $kq_all_para.=self::kq_ck_null($kq_pid,'pid');

        $kq_all_para.=self::kq_ck_null($kq_key,'key');
        $kq_all_para=substr($kq_all_para,0,strlen($kq_all_para)-1);
        $signMsg= strtoupper(md5($kq_all_para));
        $str = <<<_FRM_
        <html>
        <body>
<form method="get" name="kqPay" action="{$kq_target}">
	<input type="hidden" name="inputCharset" value="{$kq_inputCharset}">
	<input type="hidden" name="pageUrl" value="{$kq_pageUrl}">
	<input type="hidden" name="bgUrl" value="{$kq_bgUrl}">
	<input type="hidden" name="version" value="{$kq_version}">
	<input type="hidden" name="language" value="{$kq_language}">
	<input type="hidden" name="signType" value="{$kq_signType}">
	<input type="hidden" name="merchantAcctId" value="{$kq_merchantAcctId}">
	<input type="hidden" name="payerName" value="{$kq_payerName}">
	<input type="hidden" name="payerContactType" value="{$kq_payerContactType}">
	<input type="hidden" name="payerContact" value="{$kq_payerContact}">
	<input type="hidden" name="orderId" value="{$kq_orderId}">
	<input type="hidden" name="orderAmount" value="{$kq_orderAmount}">
	<input type="hidden" name="orderTime" value="{$kq_orderTime}">
	<input type="hidden" name="productName" value="{$kq_productName}">
	<input type="hidden" name="productNum" value="{$kq_productNum}">
	<input type="hidden" name="productId" value="{$kq_productId}">
	<input type="hidden" name="productDesc" value="{$kq_productDesc}">
	<input type="hidden" name="ext1" value="{$kq_ext1}">
	<input type="hidden" name="ext2" value="{$kq_ext2}">
	<input type="hidden" name="payType" value="{$kq_payType}">
	<input type="hidden" name="bankId" value="{$kq_bankId}">
	<input type="hidden" name="redoFlag" value="{$kq_redoFlag}">
	<input type="hidden" name="pid" value="{$kq_pid}">
	<input type="hidden" name="signMsg" value="{$signMsg}">

</form>
</body>
<script language="JavaScript">
    document.forms['kqPay'].submit();
</script>
</html>
_FRM_;
        echo $str;


    }

    /*
     * 快钱同步提醒
     * */
     public function action_bill_return()
     {
         $kq_key = Common::getSysConf('value','cfg_bill_key',0);
         $kq_check_all_para ='';
         $kq_check_all_para.=self::kq_ck_null($_GET[merchantAcctId],'merchantAcctId');
         $kq_check_all_para.=self::kq_ck_null($_GET[version],'version');
         $kq_check_all_para.=self::kq_ck_null($_GET[language],'language');
         $kq_check_all_para.=self::kq_ck_null($_GET[signType],'signType');
         $kq_check_all_para.=self::kq_ck_null($_GET[payType],'payType');
         $kq_check_all_para.=self::kq_ck_null($_GET[bankId],'bankId');
         $kq_check_all_para.=self::kq_ck_null($_GET[orderId],'orderId');
         $kq_check_all_para.=self::kq_ck_null($_GET[orderTime],'orderTime');
         $kq_check_all_para.=self::kq_ck_null($_GET[orderAmount],'orderAmount');
         $kq_check_all_para.=self::kq_ck_null($_GET[bindCard],'bindCard');
         $kq_check_all_para.=self::kq_ck_null($_GET[bindMobile],'bindMobile');
         $kq_check_all_para.=self::kq_ck_null($_GET[dealId],'dealId');
         $kq_check_all_para.=self::kq_ck_null($_GET[bankDealId],'bankDealId');
         $kq_check_all_para.=self::kq_ck_null($_GET[dealTime],'dealTime');
         $kq_check_all_para.=self::kq_ck_null($_GET[payAmount],'payAmount');
         $kq_check_all_para.=self::kq_ck_null($_GET[fee],'fee');
         $kq_check_all_para.=self::kq_ck_null($_GET[ext1],'ext1');
         $kq_check_all_para.=self::kq_ck_null($_GET[ext2],'ext2');
         $kq_check_all_para.=self::kq_ck_null($_GET[payResult],'payResult');
         $kq_check_all_para.=self::kq_ck_null($_GET[errCode],'errCode');
         $kq_check_all_para.=self::kq_ck_null($kq_key,"key");

         $kq_check_all_para=substr($kq_check_all_para,0,strlen($kq_check_all_para)-1);

         $merchantSignMsg= md5($kq_check_all_para);
         //获取加密签名串
         $signMsg=trim($_REQUEST['signMsg']);
         $rtnOK = 0;
         $rtnUrl = '';

         if(strtoupper($signMsg)==strtoupper($merchantSignMsg)){

             switch($_REQUEST['payResult']){
                 case '10':
                     //此处做商户逻辑处理
                    /* $ordersn=$_REQUEST['orderId'];
                     $paySource='快钱支付';
                     $this->paySuccess($ordersn,$paySource);
                     */



                     $rtnOK=1;
                     //以下是我们快钱设置的show页面，商户需要自己定义该页面。
                     $rtnUrl=$GLOBALS['cfg_basehost']."/shouji/thirdpay/paysuccess";

                     break;
                 default:
                     $rtnOK=1;
                     //以下是我们快钱设置的show页面，商户需要自己定义该页面。
                     //$rtnUrl=$GLOBALS['cfg_basehost']."/kuaiqian/show.php?msg=false";
                     break;

             }

         }
         else
         {
             $rtnOK=1;
             //以下是我们快钱设置的show页面，商户需要自己定义该页面。
             //$rtnUrl=$GLOBALS['cfg_basehost']."/kuaiqian/show.php?msg=error";

         }
         echo "<result>{$rtnOK}</result> <redirecturl>{$rtnUrl}</redirecturl>";

     }

    public function action_bill_notify()
    {
        $kq_key = Common::getSysConf('value','cfg_bill_key',0);
        $kq_check_all_para ='';
        $kq_check_all_para.=self::kq_ck_null($_GET[merchantAcctId],'merchantAcctId');
        $kq_check_all_para.=self::kq_ck_null($_GET[version],'version');
        $kq_check_all_para.=self::kq_ck_null($_GET[language],'language');
        $kq_check_all_para.=self::kq_ck_null($_GET[signType],'signType');
        $kq_check_all_para.=self::kq_ck_null($_GET[payType],'payType');
        $kq_check_all_para.=self::kq_ck_null($_GET[bankId],'bankId');
        $kq_check_all_para.=self::kq_ck_null($_GET[orderId],'orderId');
        $kq_check_all_para.=self::kq_ck_null($_GET[orderTime],'orderTime');
        $kq_check_all_para.=self::kq_ck_null($_GET[orderAmount],'orderAmount');
        $kq_check_all_para.=self::kq_ck_null($_GET[bindCard],'bindCard');
        $kq_check_all_para.=self::kq_ck_null($_GET[bindMobile],'bindMobile');
        $kq_check_all_para.=self::kq_ck_null($_GET[dealId],'dealId');
        $kq_check_all_para.=self::kq_ck_null($_GET[bankDealId],'bankDealId');
        $kq_check_all_para.=self::kq_ck_null($_GET[dealTime],'dealTime');
        $kq_check_all_para.=self::kq_ck_null($_GET[payAmount],'payAmount');
        $kq_check_all_para.=self::kq_ck_null($_GET[fee],'fee');
        $kq_check_all_para.=self::kq_ck_null($_GET[ext1],'ext1');
        $kq_check_all_para.=self::kq_ck_null($_GET[ext2],'ext2');
        $kq_check_all_para.=self::kq_ck_null($_GET[payResult],'payResult');
        $kq_check_all_para.=self::kq_ck_null($_GET[errCode],'errCode');
        $kq_check_all_para.=self::kq_ck_null($kq_key,"key");

        $kq_check_all_para=substr($kq_check_all_para,0,strlen($kq_check_all_para)-1);

        $merchantSignMsg= md5($kq_check_all_para);
        //获取加密签名串
        $signMsg=trim($_REQUEST['signMsg']);
        $rtnOK = 0;
        $rtnUrl = '';
        switch($_REQUEST['payResult'])
            {
                case '10':
                    //此处做商户逻辑处理

                    $ordersn=$_REQUEST['orderId'];
                    $paySource='快钱支付';
                    $this->paySuccess($ordersn,$paySource);




                    $rtnOK=1;
                    //以下是我们快钱设置的show页面，商户需要自己定义该页面。
                    $rtnUrl=$GLOBALS['cfg_basehost']."/shouji/thirdpay/paysuccess";

                    break;
                default:
                    $rtnOK=1;
                    //以下是我们快钱设置的show页面，商户需要自己定义该页面。
                    //$rtnUrl=$GLOBALS['cfg_basehost']."/kuaiqian/show.php?msg=false";
                    $rtnUrl=$GLOBALS['cfg_basehost']."/shouji/thirdpay/paysuccess";

                    break;

            }


        echo "<result>{$rtnOK}</result> <redirecturl>{$rtnUrl}</redirecturl>";
    }

    /*
     * 支付宝支付
     * */
    public function action_alipay()
    {
       $GLOBALS['cfg_alipay_pid'] = Common::getSysConf('value','cfg_alipay_pid',0); //pid
       $GLOBALS['cfg_alipay_key'] = Common::getSysConf('value','cfg_alipay_key',0); //key
       $GLOBALS['cfg_alipay_account'] = Common::getSysConf('value','cfg_alipay_account',0); //帐号
       include(PUBLICPATH.'/thirdpay/alipay/alipay.config.php');
       include(PUBLICPATH.'/thirdpay/alipay/lib/alipay_submit.class.php');
        /**************************调用授权接口alipay.wap.trade.create.direct获取授权码token**************************/

       //返回格式
        $format = "xml";
       //必填，不需要修改

      //返回格式
        $v = "2.0";
      //必填，不需要修改

     //请求号
        $req_id = date('Ymdhis');
     //必填，须保证每次请求都是唯一

     //**req_data详细信息**

    //服务器异步通知页面路径
        $notify_url = $GLOBALS['cfg_basehost']."/shouji/thirdpay/alipay_notifyurl";
   //需http://格式的完整路径，不允许加?id=123这类自定义参数

   //页面跳转同步通知页面路径
        $call_back_url = $GLOBALS['cfg_basehost']."/shouji/thirdpay/alipay_backurl";
   //需http://格式的完整路径，不允许加?id=123这类自定义参数

   //操作中断返回地址
        $merchant_url = "http://127.0.0.1:8800/WS_WAP_PAYWAP-PHP-UTF-8/xxxx.php";
   //用户付款中途退出返回商户的地址。需http://格式的完整路径，不允许加?id=123这类自定义参数

   //卖家支付宝帐户
        $seller_email = $GLOBALS['cfg_alipay_account'];
   //必填

   //商户订单号
        $out_trade_no = $_POST['ordersn'];
    //商户网站订单系统中唯一订单号，必填

    //订单名称
        $subject = $_POST['subject'];
    //必填

    //付款金额
        $total_fee = $_POST['price'];
    //必填

    //请求业务参数详细
        $req_data = '<direct_trade_create_req><notify_url>' . $notify_url . '</notify_url><call_back_url>' . $call_back_url . '</call_back_url><seller_account_name>' . $seller_email . '</seller_account_name><out_trade_no>' . $out_trade_no . '</out_trade_no><subject>' . $subject . '</subject><total_fee>' . $total_fee . '</total_fee><merchant_url>' . $merchant_url . '</merchant_url></direct_trade_create_req>';

//构造要请求的参数数组，无需改动
        $para_token = array(
            "service" => "alipay.wap.trade.create.direct",
            "partner" => trim($alipay_config['partner']),
            "sec_id" => trim($alipay_config['sign_type']),
            "format"	=> $format,
            "v"	=> $v,
            "req_id"	=> $req_id,
            "req_data"	=> $req_data,
            "_input_charset"	=> trim(strtolower($alipay_config['input_charset']))
        );

        //建立请求
        $alipaySubmit = new AlipaySubmit($alipay_config);
        $html_text = $alipaySubmit->buildRequestHttp($para_token);

         //URLDECODE返回的信息
        $html_text = urldecode($html_text);

        //解析远程模拟提交后返回的信息
        $para_html_text = $alipaySubmit->parseResponse($html_text);

        //获取request_token
        $request_token = $para_html_text['request_token'];


        /**************************根据授权码token调用交易接口alipay.wap.auth.authAndExecute**************************/

//业务详细
        $req_data = '<auth_and_execute_req><request_token>' . $request_token . '</request_token></auth_and_execute_req>';
//必填

//构造要请求的参数数组，无需改动
        $parameter = array(
            "service" => "alipay.wap.auth.authAndExecute",
            "partner" => trim($alipay_config['partner']),
            "sec_id" => trim($alipay_config['sign_type']),
            "format"	=> $format,
            "v"	=> $v,
            "req_id"	=> $req_id,
            "req_data"	=> $req_data,
            "_input_charset"	=> trim(strtolower($alipay_config['input_charset']))
        );

//建立请求
        $alipaySubmit = new AlipaySubmit($alipay_config);
        $html_text = $alipaySubmit->buildRequestForm($parameter, 'get', '确认');
        echo $html_text;

    }

    /*
     * 支付宝同步返回处理
     * */
    public function action_alipay_backurl()
    {
        $GLOBALS['cfg_alipay_pid'] = Common::getSysConf('value','cfg_alipay_pid',0); //pid
        $GLOBALS['cfg_alipay_key'] = Common::getSysConf('value','cfg_alipay_key',0); //key
        $GLOBALS['cfg_alipay_account'] = Common::getSysConf('value','cfg_alipay_account',0); //帐号
        include(PUBLICPATH.'/thirdpay/alipay/alipay.config.php');
        include(PUBLICPATH.'/thirdpay/alipay/lib/alipay_notify.class.php');
        $alipayNotify = new AlipayNotify($alipay_config);
        $verify_result = $alipayNotify->verifyReturn();
        if($verify_result)
        {
           $this->request->redirect('thirdpay/paysuccess');
        }
        else
        {


        }


    }
    /*
     * 支付宝异步返回处理
     * */
    public function action_alipay_notifyurl()
    {

        $GLOBALS['cfg_alipay_pid'] = Common::getSysConf('value','cfg_alipay_pid',0); //pid
        $GLOBALS['cfg_alipay_key'] = Common::getSysConf('value','cfg_alipay_key',0); //key
        $GLOBALS['cfg_alipay_account'] = Common::getSysConf('value','cfg_alipay_account',0); //帐号
        include(PUBLICPATH.'/thirdpay/alipay/alipay.config.php');
        include(PUBLICPATH.'/thirdpay/alipay/lib/alipay_notify.class.php');
        $alipayNotify = new AlipayNotify($alipay_config);
        $verify_result = $alipayNotify->verifyNotify();

        if($verify_result)
        {
            //解析notify_data
            //注意：该功能PHP5环境及以上支持，需开通curl、SSL等PHP配置环境。建议本地调试时使用PHP开发软件
            $doc = new DOMDocument();
            if ($alipay_config['sign_type'] == 'MD5')
            {
                $doc->loadXML($_POST['notify_data']);
            }

           /*  if ($alipay_config['sign_type'] == '0001')
            {
                $doc->loadXML($alipayNotify->decrypt($_POST['notify_data']));
            }*/

            if( ! empty($doc->getElementsByTagName( "notify" )->item(0)->nodeValue) ) {
                //商户订单号
                $ordersn = $doc->getElementsByTagName( "out_trade_no" )->item(0)->nodeValue;
                //支付宝交易号
                $trade_no = $doc->getElementsByTagName( "trade_no" )->item(0)->nodeValue;
                //交易状态
                $trade_status = $doc->getElementsByTagName( "trade_status" )->item(0)->nodeValue;

                if($trade_status == 'TRADE_FINISHED')
                {


                    echo "success";		//请不要修改或删除
                }
                else if ($trade_status == 'TRADE_SUCCESS')
                {
                    $paySource='支付宝';
                    $this->paySuccess($ordersn,$paySource);

                    echo "success";		//请不要修改或删除
                }
            }

            //——请根据您的业务逻辑来编写程序（以上代码仅作参考）——

            /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        }
        else
        {
            //验证失败
            echo "fail";

            //调试用，写文本函数记录程序运行情况是否正常
            //logResult("这里写入想要调试的代码变量值，或其他运行的结果记录");
        }


    }

    /*
     * 微信支付
     * */
    public function action_weixinpay()
    {   
        /**
 * JS_API支付demo
 * ====================================================
 * 在微信浏览器里面打开H5网页中执行JS调起支付。接口输入输出数据格式为JSON。
 * 成功调起支付需要三个步骤：
 * 步骤1：网页授权获取用户openid
 * 步骤2：使用统一支付接口，获取prepay_id
 * 步骤3：使用jsapi调起支付
*/     
        $GLOBALS['cfg_wxpay_appid'] = Common::getSysConf('value','cfg_wxpay_appid',0); //appid
        $GLOBALS['cfg_wxpay_mchid'] = Common::getSysConf('value','cfg_wxpay_mchid',0); //mchid
        $GLOBALS['cfg_wxpay_key'] = Common::getSysConf('value','cfg_wxpay_key',0); //key
        $GLOBALS['cfg_wxpay_appsecret'] = Common::getSysConf('value','cfg_wxpay_appsecret',0); //secret

        include_once(PUBLICPATH.'/thirdpay/weixinpay/WxPayPubHelper/WxPayPubHelper.php');
        /**************************调用授权接口alipay.wap.trade.create.direct获取授权码token**************************/

       //使用jsapi接口
        $jsApi = new JsApi_pub();
        //=========步骤1：网页授权获取用户openid============
        //通过code获得openid
        if (!isset($_GET['code']))
        {
			
            //触发微信返回code码
            $backurl = WxPayConf_pub::JS_API_CALL_URL;
            $backurl = $backurl."?ordersn=".$_POST['ordersn'];
            $url = $jsApi->createOauthUrlForCode($backurl);
            Header("Location: $url"); 
			exit;
        }else
        {
            //获取code码，以获取openid
            $code = $_GET['code'];
            $jsApi->setCode($code);
            $openid = $jsApi->getOpenId();
        }
        
        //=========步骤2：使用统一支付接口，获取prepay_id============
        //使用统一支付接口
        $unifiedOrder = new UnifiedOrder_pub();
        

        //设置统一支付接口参数
        //设置必填参数
        //appid已填,商户无需重复填写
        //mch_id已填,商户无需重复填写
        //noncestr已填,商户无需重复填写
        //spbill_create_ip已填,商户无需重复填写
        //sign已填,商户无需重复填写
       
        $out_trade_no = $_GET['ordersn'];
        $info = ORM::factory('member_order')->where("ordersn='".$out_trade_no."'")->find()->as_array();
        $goodsname = $info['productname'];
        $total_fee = (intval($info['price']) * intval($info['dingnum']))+(intval($info['childprice'])*intval($info['childnum']));
        $total_fee = $total_fee*100;
        $unifiedOrder->setParameter("openid","$openid");//商品描述
        //自定义订单号，此处仅作举例
        $timeStamp = time();
        $tem_trade = WxPayConf_pub::APPID."$timeStamp";
        $unifiedOrder->setParameter("out_trade_no","$tem_trade");//商户订单号 
        $unifiedOrder->setParameter("body","$goodsname");//商品描述
        $unifiedOrder->setParameter("total_fee","$total_fee");//总金额
        $unifiedOrder->setParameter("notify_url",WxPayConf_pub::NOTIFY_URL);//通知地址 
        $unifiedOrder->setParameter("trade_type","JSAPI");//交易类型
        //非必填参数，商户可根据实际情况选填
        $unifiedOrder->setParameter("attach","$out_trade_no");//订单号  
        //$unifiedOrder->setParameter("device_info","XXXX");//设备号 
        //$unifiedOrder->setParameter("attach","XXXX");//附加数据 
        //$unifiedOrder->setParameter("time_start","XXXX");//交易起始时间
        //$unifiedOrder->setParameter("time_expire","XXXX");//交易结束时间 
        //$unifiedOrder->setParameter("goods_tag","XXXX");//商品标记 
        //$unifiedOrder->setParameter("openid","XXXX");//用户标识
        //$unifiedOrder->setParameter("product_id","XXXX");//商品ID
        
        $prepay_id = $unifiedOrder->getPrepayId();
        //=========步骤3：使用jsapi调起支付============
        $jsApi->setPrepayId($prepay_id);

        $jsApiParameters = $jsApi->getParameters();

        $this->assign('jsApiParameters',$jsApiParameters);
        $this->assign('productname',$goodsname);
        $this->assign('total_fee',$total_fee/100);

        $this->display('public/weixinpaypost');
    }


    /*
     * 微信异步返回处理
     * */
    public function action_weixinpay_notifyurl()
    {
        /**
 * 通用通知接口demo
 * ====================================================
 * 支付完成后，微信会把相关支付和用户信息发送到商户设定的通知URL，
 * 商户接收回调信息后，根据需要设定相应的处理流程。
 * 
 * 这里举例使用log文件形式记录回调信息。
*/  

    $GLOBALS['cfg_wxpay_appid'] = Common::getSysConf('value','cfg_wxpay_appid',0); //appid
    $GLOBALS['cfg_wxpay_mchid'] = Common::getSysConf('value','cfg_wxpay_mchid',0); //mchid
    $GLOBALS['cfg_wxpay_key'] = Common::getSysConf('value','cfg_wxpay_key',0); //key
    $GLOBALS['cfg_wxpay_appsecret'] = Common::getSysConf('value','cfg_wxpay_appsecret',0); //secret
        
    include_once(PUBLICPATH.'/thirdpay/weixinpay/log_.php');
    include_once(PUBLICPATH.'/thirdpay/weixinpay/WxPayPubHelper/WxPayPubHelper.php');


    //使用通用通知接口
    $notify = new Notify_pub();

    //存储微信的回调
    $xml = $GLOBALS['HTTP_RAW_POST_DATA'];  
    $notify->saveData($xml);
    
    //验证签名，并回应微信。
    //对后台通知交互时，如果微信收到商户的应答不是成功或超时，微信认为通知失败，
    //微信会通过一定的策略（如30分钟共8次）定期重新发起通知，
    //尽可能提高通知的成功率，但微信不保证通知最终能成功。
    if($notify->checkSign() == FALSE){
        $notify->setReturnParameter("return_code","FAIL");//返回状态码
        $notify->setReturnParameter("return_msg","签名失败");//返回信息
    }else{
        $notify->setReturnParameter("return_code","SUCCESS");//设置返回码
    }

    $returnXml = $notify->returnXml();
    echo $returnXml;
    
    //==商户根据实际情况设置相应的处理流程，此处仅作举例=======
    
    //以log文件形式记录回调信息
    $log_ = new Log_();
    $log_->log_result("【接收到的notify通知】:\n".$xml."\n");


        if($notify->checkSign() == TRUE)
        {
            if ($notify->data["return_code"] == "SUCCESS") {
            //此处应该更新一下订单状态，商户自行增删操作
                $ordersn = $notify->data["attach"];
                $paySource='微信支付';
                $this->paySuccess($ordersn,$paySource);
            }

            //echo "success";     //请不要修改或删除


            //——请根据您的业务逻辑来编写程序（以上代码仅作参考）——

            /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        }
        else
        {
            //验证失败
           // echo "fail";

            //调试用，写文本函数记录程序运行情况是否正常
            //logResult("这里写入想要调试的代码变量值，或其他运行的结果记录");
        }


    }

   /*
    * 支付成功页面
    * */
    public function action_paysuccess()
    {
        $this->request->redirect('page/paysuccess');
    }
    /*
     * 快钱参数处理
     * */
    private function kq_ck_null($kq_va,$kq_na)
    {
        if($kq_va == "")
        {
            $kq_va="";
        }
        else
        {
            return $kq_va=$kq_na.'='.$kq_va.'&';
        }
    }
	public function paySuccess($ordersn,$paySource,$params=null)
	{
        $sql="select * from sline_member_order where ordersn='$ordersn'";
        $arr1=DB::query(1,$sql)->execute()->as_array();
        $arr = $arr1[0];

        if($arr['status']==2)
            return true;
        $configModel=new Model_Sysconfig();
        $configs=$configModel->getConfig(0);
        if(substr($ordersn,0,2)=='dz')
        {
            $ordertype = 'dz';
            $updatesql="update sline_dzorder set status=2,paysource='$paySource' where ordersn='$ordersn'";
        }
        else
        {
            $ordertype = 'sys';
            $updatesql="update sline_member_order set ispay=1,status=2,paysource='$paySource' where ordersn='$ordersn'"; //付款标志置为1,交易成功
        }
        DB::query(Database::UPDATE,$updatesql)->execute();

        //logResult('更新成功');

        //$subject='你成功预订'.$arr['productname'].'产品';
        //$text="尊敬的{$arr['linkman']},你已经成功在{$GLOBALS['cfg_webname']}预订{$arr['productname']},数量{$arr['dingnum']}.";
        //sendMsg($subject,$text,$arr['handletel'],$ordersn);

        if($ordertype !='dz')
        {
            $msgInfo = Common::getDefineMsgInfo($arr['typeid'],3);
            $memberModel=ORM::factory('member',$arr['memberid']);
            $memberInfo = Common::getMemberInfo($arr['memberid']);
            $nickname = !empty($memberInfo['nickname']) ? $memberInfo['nickname'] : $memberInfo['mobile'];
            $orderAmount = Common::StatisticalOrderAmount($arr);
            if(isset($msgInfo['isopen'])) //等待客服处理短信
            {
                $content = $msgInfo['msg'];

                $content = str_replace('{#MEMBERNAME#}',$nickname,$content);
                $content = str_replace('{#PRODUCTNAME#}',$arr['productname'],$content);
                $content = str_replace('{#PRICE#}',$orderAmount['priceDescript'],$content);
                $content = str_replace('{#NUMBER#}',$orderAmount['numberDescript'],$content);
                $content = str_replace('{#TOTALPRICE#}',$orderAmount['totalPrice'],$content);
                $content = str_replace('{#WEBNAME#}',$configs['cfg_webname'],$content);
                $content = str_replace('{#ORDERSN#}',$ordersn,$content);
                Common::sendMsg($memberInfo['mobile'],$nickname,$content);//发送短信.
            }

            $emailInfo=Common::getEmailMsgConfig2($arr['typeid'],3);
            if($emailInfo['isopen']==1 && !empty($memberInfo['email']))
            {
               // $nickname = !empty($memberInfo['nickname']) ? $memberInfo['nickname'] : $memberInfo['mobile'];
                $title="订单支付成功";
                $content = $emailInfo['msg'];
                $content = str_replace('{#MEMBERNAME#}',$nickname,$content);
                $content = str_replace('{#PRODUCTNAME#}',$arr['productname'],$content);
                $content = str_replace('{#PRICE#}',$orderAmount['priceDescript'],$content);
                $content = str_replace('{#NUMBER#}',$orderAmount['numberDescript'],$content);
                $content = str_replace('{#TOTALPRICE#}',$orderAmount['totalPrice'],$content);
                $content = str_replace('{#WEBNAME#}',$configs['cfg_webname'],$content);
                $content = str_replace('{#ORDERSN#}',$ordersn,$content);
                $content = str_replace('{#EMAIL#}',$memberInfo['email'],$content);
                Common::ordermaill($memberInfo['email'],$title,$content);
            }


            //支付成功后添加预订送积分
            if(!empty($arr['jifenbook']))
            {
                $addjifen = intval($arr['jifenbook']);

                $memberModel->jifen=$memberModel->jifen+$addjifen;
                if($memberModel->save())
                {
                    Common::addJifenLog($arr['memberid'],"预订{$arr['productname']}获得积分{$addjifen}",$addjifen,2);
                }
            }
            //如果是酒店订单,则把子订单置为交易成功状态

            if($arr['typeid']==2)
            {
                $s = "update sline_member_order set ispay=1,paysource='$paySource' where pid='{$arr['id']}'";
                DB::query(Database::UPDATE,$s);
            }

        }


    }
    public function action_test()
    {
        $this->paySuccess("0109294568","手机测试");
    }

}

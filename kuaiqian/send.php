<meta http-equiv=Content-Type content="text/html;charset=utf-8">
<?PHP


    require  dirname(__FILE__).'/../include/common.inc.php';

	//人民币网关账号，该账号为11位人民币网关商户编号+01,该参数必填。
	$merchantAcctId = $GLOBALS['cfg_bill_account']."01";//1001213884201
	//编码方式，1代表 UTF-8; 2 代表 GBK; 3代表 GB2312 默认为1,该参数必填。
	$inputCharset = "1";
	//接收支付结果的页面地址，该参数一般置为空即可。
	$pageUrl = $GLOBALS['cfg_basehost'].'/member/';
	//服务器接收支付结果的后台地址，该参数务必填写，不能为空。
	//$bgUrl = "http://219.233.173.50:8802/futao/rmb_demo/recieve.php";
	$bgUrl = $GLOBALS['cfg_basehost']."/kuaiqian/receive.php";
	//网关版本，固定值：v2.0,该参数必填。
	$version =  "v2.0";
	//语言种类，1代表中文显示，2代表英文显示。默认为1,该参数必填。
	$language =  "1";
	//签名类型,该值为4，代表PKI加密方式,该参数必填。
	$signType =  "1";
	//支付人姓名,可以为空。
	$payerName= ""; 
	//支付人联系类型，1 代表电子邮件方式；2 代表手机联系方式。可以为空。
	$payerContactType =  "1";
	//支付人联系方式，与payerContactType设置对应，payerContactType为1，则填写邮箱地址；payerContactType为2，则填写手机号码。可以为空。
	//$payerContact =  '542696479@qq.com'; //2532987
	//商户订单号，以下采用时间来定义订单号，商户可以根据自己订单号的定义规则来定义该值，不能为空。
	$orderId =$_POST['ordersn'];// date("YmdHis"); //date("YmdHis")
	//订单金额，金额以“分”为单位，商户测试以1分测试即可，切勿以大金额测试。该参数必填。
	$orderAmount = $_POST['price']*100;
	//订单提交时间，格式：yyyyMMddHHmmss，如：20071117020101，不能为空。
	   $otime=time();
	$orderTime = date("YmdHis",$otime); //date("YmdHis")
	//商品名称，可以为空。
	$productName= $_POST['subject']; 
	//商品数量，可以为空。
	$productNum = "1";
	//商品代码，可以为空。
	//$productId = "55558888";
	//商品描述，可以为空。
	$productDesc = "";
	//扩展字段1，商户可以传递自己需要的参数，支付完快钱会原值返回，可以为空。
	$ext1 = "";
	//扩展自段2，商户可以传递自己需要的参数，支付完快钱会原值返回，可以为空。
	$ext2 = "";
	//支付方式，一般为00，代表所有的支付方式。如果是银行直连商户，该值为10，必填。
    $payType = "00";
	//银行代码，如果payType为00，该值可以为空；如果payType为10，该值必须填写，具体请参考银行列表。
	$bankId = "";
	//同一订单禁止重复提交标志，实物购物车填1，虚拟产品用0。1代表只能提交一次，0代表在支付不成功情况下可以再提交。可为空。
	$redoFlag = "";
	//快钱合作伙伴的帐户号，即商户编号，可为空。
	$pid = "";
	// signMsg 签名字符串 不可空，生成加密签名串

	function kq_ck_null($kq_va,$kq_na){if($kq_va == ""){$kq_va="";}else{return $kq_va=$kq_na.'='.$kq_va.'&';}}


	$kq_all_para=kq_ck_null($inputCharset,'inputCharset');
	$kq_all_para.=kq_ck_null($pageUrl,"pageUrl");
	$kq_all_para.=kq_ck_null($bgUrl,'bgUrl');
	$kq_all_para.=kq_ck_null($version,'version');
	$kq_all_para.=kq_ck_null($language,'language');
	$kq_all_para.=kq_ck_null($signType,'signType');
	$kq_all_para.=kq_ck_null($merchantAcctId,'merchantAcctId');
	$kq_all_para.=kq_ck_null($payerName,'payerName');
	$kq_all_para.=kq_ck_null($payerContactType,'payerContactType');
	$kq_all_para.=kq_ck_null($payerContact,'payerContact');
	$kq_all_para.=kq_ck_null($orderId,'orderId');
	$kq_all_para.=kq_ck_null($orderAmount,'orderAmount');
	$kq_all_para.=kq_ck_null($orderTime,'orderTime');
	$kq_all_para.=kq_ck_null($productName,'productName');
	$kq_all_para.=kq_ck_null($productNum,'productNum');
	$kq_all_para.=kq_ck_null($productId,'productId');
	$kq_all_para.=kq_ck_null($productDesc,'productDesc');
	$kq_all_para.=kq_ck_null($ext1,'ext1');
	$kq_all_para.=kq_ck_null($ext2,'ext2');
	$kq_all_para.=kq_ck_null($payType,'payType');
	$kq_all_para.=kq_ck_null($bankId,'bankId');
	$kq_all_para.=kq_ck_null($redoFlag,'redoFlag');
	$kq_all_para.=kq_ck_null($pid,'pid');
	
	//人民币网关密钥
	///区分大小写.请与快钱联系索取
	$key=$GLOBALS['cfg_bill_key'];
	$kq_all_para.=kq_ck_null($key,'key');

	$kq_all_para=substr($kq_all_para,0,strlen($kq_all_para)-1);

	//echo $kq_all_para;
	
	$signMsg= strtoupper(md5($kq_all_para));
	/////////////  RSA 签名计算 ///////// 开始 //
	
	/*
	$fp = fopen("./99bill-rsa.pem", "r");
	$priv_key = fread($fp,123456);
	fclose($fp);

	$pkeyid = openssl_get_privatekey($priv_key);

	// compute signature
	openssl_sign($kq_all_para, $signMsg, $pkeyid,OPENSSL_ALGO_SHA1);
	// free the key from memory
	openssl_free_key($pkeyid);

	$signMsg = base64_encode($signMsg);

	echo $signMsg;
	echo "<br />";

	/////////////  RSA 签名计算 ///////// 结束 //
	*/


?>

<style type="text/css">
	td{text-align:center}
</style>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
	<head>
		<title>提交支付</title>
		<style>
.pay_main{
	width:1000px;
	margin:auto;
	height:400px;
	padding-top:80px;
}
.pay_main .pay_tb{
  width:650px;
  margin:auto;
  background:#dcdcdc;
 
  border-spacing:1px;
  border-collapse:separate;
  margin-top:40px;
  margin-bottom:30px;
}
.pay_main .pay_tb td{
	 background:white;
	 color:#39a41a;
	 font-size:18px;
	 height:30px;
	 line-height:30px;
	 padding:4px 15px 4px 10px;
	 font-weight:700;
}
.pay_main .pay_tb .l_name{
	background:#eeeeee;
	font-size:18px;
	color:#4e4e4e;
	font-weight:700;
	padding-left:20px;
}
.pay_main h4{
	color:#39a41a;
	font-size:30px;
	font-family:"微软雅黑";
	text-align:center;
	font-weight:300;
	line-height:30px;
}
.pay_main .tj{
	text-align:center;
}
.pay_main .tj a{
	padding:5px 20px 5px 20px;
	background:#39a41a;
	display:inline-block;
	font-size:18px;
	color:white;
}
.pay_main .pay_tb input{
	width:100px;
	border:1px solid #39a41a;
	height:20px;
}

.pay_main .tj{
    padding:5px 20px 5px 20px;
	background:#39a41a;
	display:inline-block;
	font-size:18px;
	color:white;
	border:none;
	cursor:pointer;
}


</style>
	</head>
	<body>

  

		<div align="center">
		<div class="pay_main">
		 <!-- <h4>四川省中国青年旅行社在线支付平台</h4>
		  <table class="pay_tb" cellspacing="2">
			 <tr><td class="l_name" width="146px">订单号</td><td>	<?PHP echo $orderId; ?></td></tr>
			  <tr><td class="l_name" width="146px">商品名称</td><td><?PHP echo $productName; ?></td></tr>
			  <tr><td class="l_name" width="146px">下单时间</td><td><?PHP echo date('Y-m-d H:i',$otime); ?></td></tr>
			  <tr><td class="l_name" width="146px">价格</td><td><?PHP echo $orderAmount/100; ?>元</td></tr>
		  </table> -->
		   
		   <div align="center" style="font-weight: bold;">
			<form name="kqPay" action="https://www.99bill.com/gateway/recvMerchantInfoAction.htm" method="GET">
				<input type="hidden" name="inputCharset" value="<?PHP echo $inputCharset; ?>" />
				<input type="hidden" name="pageUrl" value="<?PHP echo $pageUrl; ?>" />
				<input type="hidden" name="bgUrl" value="<?PHP echo $bgUrl; ?>" />
				<input type="hidden" name="version" value="<?PHP echo $version; ?>" />
				<input type="hidden" name="language" value="<?PHP echo $language; ?>" />
				<input type="hidden" name="signType" value="<?PHP echo $signType; ?>" />
				<input type="hidden" name="signMsg" value="<?PHP echo $signMsg; ?>" />
				<input type="hidden" name="merchantAcctId" value="<?PHP echo $merchantAcctId; ?>" />
				<input type="hidden" name="payerName" value="<?PHP echo $payerName; ?>" />
				<input type="hidden" name="payerContactType" value="<?PHP echo $payerContactType; ?>" />
				<input type="hidden" name="payerContact" value="<?PHP echo $payerContact; ?>" />
				<input type="hidden" name="orderId" value="<?PHP echo $orderId; ?>" />
				<input type="hidden" name="orderAmount" value="<?PHP echo $orderAmount; ?>" />
				<input type="hidden" name="orderTime" value="<?PHP echo $orderTime; ?>" />
				<input type="hidden" name="productName" value="<?PHP echo $productName; ?>" />
				<input type="hidden" name="productNum" value="<?PHP echo $productNum; ?>" />
				<input type="hidden" name="productId" value="<?PHP echo $productId; ?>" />
				<input type="hidden" name="productDesc" value="<?PHP echo $productDesc; ?>" />
				<input type="hidden" name="ext1" value="<?PHP echo $ext1; ?>" />
				<input type="hidden" name="ext2" value="<?PHP echo $ext2; ?>" />
				<input type="hidden" name="payType" value="<?PHP echo $payType; ?>" />
				<input type="hidden" name="bankId" value="<?PHP echo $bankId; ?>" />
				<input type="hidden" name="redoFlag" value="<?PHP echo $redoFlag; ?>" />
				<input type="hidden" name="pid" value="<?PHP echo $pid; ?>" />

			</form>
            <script>
			
			  document.forms['kqPay'].submit();
			
			</script>
		</div>
     </div> 


		
		
	</body>
</html>

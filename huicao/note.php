<?php
		//MD5私钥
   require  dirname(__FILE__).'/../include/common.inc.php';

   $paySource='汇潮支付';
     $MD5key = $GLOBALS['cfg_huicao_key'];		//MD5私钥
	//订单号
	$BillNo = $_POST["BillNo"];
	//金额
	$Amount = $_POST["Amount"];
	//支付状态
	$Succeed = $_POST["Succeed"];
	//支付结果
	$Result = $_POST["Result"];
	//取得的MD5校验信息
	$SignMD5info = $_POST["SignMD5info"]; 
	//备注
	$Remark = $_POST["Remark"];



	//校验源字符串
  $md5src = $BillNo."&".$Amount."&".$Succeed."&".$MD5key;
  //MD5检验结果
  $md5sign = strtoupper(md5($md5src));
  
  if($SignMD5info==$md5sign){
	  	 
		if ($Succeed=="88")
		{
            $ordersn=$BillNo;
            Helper_Archive::paySuccess($ordersn,$paySource,$_POST);
		}
		
		echo 'ok';
	}
	
?>
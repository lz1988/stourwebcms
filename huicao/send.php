<?php
     require  dirname(__FILE__).'/../include/common.inc.php';
     $MD5key = $GLOBALS['cfg_huicao_key'];		//MD5私钥
     $MerNo = $GLOBALS['cfg_huicao_account'];					//商户号
     $BillNo =$_POST['ordersn'];		//[必填]订单号(商户自己产生：要求不重复)
     $Amount = $_POST['price'];				//[必填]订单金额
  
     $ReturnURL = $_POST['showurl']; 			//[必填]返回数据给商户的地址(商户自己填写):::注意请在测试前将该地址告诉我方人员;否则测试通不过
     $Remark = "";  //[选填]升级。
     

    $md5src = $MerNo."&".$BillNo."&".$Amount."&".$ReturnURL."&".$MD5key;		//校验源字符串
    $SignInfo = strtoupper(md5($md5src));		//MD5检验结果


	 $AdviceURL ="http://".$_SERVER['SERVER_NAME']."/member/";   //[必填]支付完成后，后台接收支付结果，可用来更新数据库值
	 $orderTime =date('YmdHis');   //[必填]交易时间YYYYMMDDHHMMSS
	 $defaultBankNumber ="";   //[选填]银行代码s 

	 //送货信息(方便维护，请尽量收集！如果没有以下信息提供，请传空值:'')
	 //因为关系到风险问题和以后商户升级的需要，如果有相应或相似的内容的一定要收集，实在没有的才赋空值,谢谢。

    $products=$_POST['subject'];// '------------------物品信息

?>
<html>
<head>
<title>Payment By CreditCard online</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<body>
<form action="https://pay.ecpss.com/sslpayment" method="post" name="E_FORM">
  <table align="center">
    
    <tr>
      <td></td>
      <td><input type="hidden" name="MerNo" value="<?php echo $MerNo;?>"></td>
    </tr>
    <tr>
      <td></td>
      <td><input type="hidden" name="BillNo" value="<?php echo $BillNo;?>"></td>
    </tr>
    <tr>
      <td></td>
      <td><input type="hidden" name="Amount" value="<?php echo $Amount;?>"></td>
    </tr>

    <tr>
      <td></td>
      <td><input type="hidden" name="ReturnURL" value="<?php echo $ReturnURL;?>" ></td>
    </tr>
    
	 <tr>
      <td></td>
      <td><input type="hidden" name="AdviceURL" value="<?php echo $AdviceURL;?>" ></td>
    </tr>
	 <tr>
      <td></td>
      <td><input type="hidden" name="orderTime" value="<?php echo $orderTime;?>"></td>
    </tr>
    
	 <tr>
      <td></td>
      <td><input type="hidden" name="defaultBankNumber" value="<?php echo $defaultBankNumber;?>"></td>
    </tr>

    <tr>
      <td></td>
      <td><input type="hidden" name="SignInfo" value="<?php echo $SignInfo;?>"></td>
    </tr>
    <tr>
      <td></td>
      <td><input type="hidden" name="Remark" value="<?php echo $Remark;?>"></td>
    </tr>
    <tr>
      <td></td>
      <td><input type="hidden" name="products" value="<?php echo $products;?>"></td>
    </tr>
  </table>
  <p align="center">
    <input type="submit" name="b1" value="Payment">
  </p>
</form>
<script>
    document.forms['E_FORM'].submit();
</script>
</body>
</html>

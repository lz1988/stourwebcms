<?php
require  dirname(dirname(dirname(__FILE__))).'/include/common.inc.php';
// 由于这个文件只有被Paypal的服务器访问，所以无需考虑做什么页面什么的，这个页面不是给人看的，是给机器看的  
   
/**  
* 从数据库获取指定的订单信息  
*/  
//$order = $PDO->query("select * from order where order_out_id = ’{$_GET[’order_id’]}’")->fetch_all(); 
$paySource='贝宝支付';
$orderid = $_GET['order_id'];
if(substr($orderid,0,2)=='dz')
{
	$sql="select status from sline_dzorder  where ordersn='{$orderid}'";
}
else
{
	$sql="select status from sline_member_order where ordersn='{$orderid}'"; //付款标志置为1,交易成功
}
$order = $dsql->GetOne($sql);

if(!empty($order))  
{  
    if('2' == $order['status'])  
    {  
        exit;  
    }  
   
    // 拼装验证信息  
    $req = 'cmd=_notify-validate';  
    foreach ($_POST as $k=>$v)  
    {  
        $v = urlencode(stripslashes($v));  
        $req .= "&{$k}={$v}";  
    }  
   
    $ch = curl_init();  
    curl_setopt($ch,CURLOPT_URL,'https://www.paypal.com/cgi-bin/webscr');  
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);  
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);  
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);  
    curl_setopt($ch,CURLOPT_POST,1);  
    curl_setopt($ch,CURLOPT_POSTFIELDS,$req);  
    $res = curl_exec($ch);  
    curl_close($ch); 

	$file = "notify_url.txt";
	$fp = fopen($file,"a");
	flock($fp, LOCK_EX);
	fwrite($fp,"\r\n执行日期：".date("Y-m-d H:i:s")."\r\n验证状态:".$res."\r\n订单号:".$_GET['order_id']."\r\n");
	flock($fp, LOCK_UN);
	fclose($fp);
	
    echo $res;  
   
    if($res)  
    {  
        // 如果这次的请求是Paypal的服务器发送到我方服务器的则继续验证，否则退出  
        if(strcmp($res, 'VERIFIED') == 0)  
        {  
            if ($_POST['payment_status'] != 'Completed' && $_POST['payment_status'] != 'Pending')  
            {  
                exit;  
            }  
   
   
            // 如果收款人不是我的账号  
            if($GLOBALS['cfg_qianbao_key'] != $_POST['mc_email'])  
            {  
                exit;  
            }  
   
   
            // 如果货币类型不对  
            if($GLOBALS['cfg_paypal_currency'] != $_POST['mc_currency'])  
            {  
                exit;  
            }  
			
			//进行订单状态修改
            Helper_Archive::paySuccess($orderid,$paySource,$_POST);
			
        }  
        elseif(strcmp($res,'INVALID') === 0)  
        {  
            echo 'fail';  
        }
		
		

    }  
}  
else  
{  
    echo 'fail';  
}
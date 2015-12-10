
<?php include ("EBCPlugUtil.php");?>
<?php

    $paySource='钱包';
    //接收来自EBC支付网关的参数，为商城使用
    $notify_id = $_GET['notify_id'];        //通知ID
    $notify_time = $_GET['notify_time'];    //通知时间
    $charset = $_GET['charset'];            //参数编码字符集
    $sign_type = $_GET['sign_type'];        //签名方式
    $version = $_GET['version'];            //交易接入版本号
    $out_trade_no = $_GET['out_trade_no'];  //外部交易号
    $total_fee = $_GET['total_fee'];        //交易总金额
    $payment_type = $_GET['payment_type'];  //支付类型
    $show_url = $_GET['show_url'];          //交易展示URL
    $describe = $_GET['describe'];          //交易描述
    $trade_status = $_GET['trade_status'];  //交易状态
    $trade_no = $_GET['trade_no'];          //交易参考号
    $gmt_create = $_GET['gmt_create'];      //交易创建时间
    $gmt_payment = $_GET['gmt_payment'];    //买家付款时间
    $sign = $_GET['sign'];                  //签名
    $show_msg = "";

    //如果加密后的串和网关返回的加密串一致，证明数据来源合法
    $epu = new EBCPlugUtil();
    $sign_n = $epu->getTradeNotifySign($ebc_key, $notify_id, $notify_time, $charset, $sign_type, $version, $out_trade_no, $total_fee, $payment_type, $show_url, $describe, $trade_status, $trade_no, $gmt_create, $gmt_payment);
    if ($sign_n == $sign)
    {
        $show_msg = "<font color=blue>交易返回数据验证成功!</font>";
        if($trade_status=='00')//交易成功
        {
            Helper_Archive::paySuccess($orderid,$paySource,$_POST);
        }

    }
    else
    {
        $show_msg = "<font color=red>交易返回数据验证失败!请核实数据来源正确！</font>";
    }
?>
<html>
<head>
<title>交易.返回_<?php echo $g_title?></title>
<?php echo $g_meta?>
</head>
<body>
<?php include ("./../top.php");?>
<table align="center" width="700px" border="1">
<caption>交易成功</caption>
<colgroup>
<col style="width:30%;text-align:center;" />
<col style="width:70%;text-align:left;" />
</colgroup>
<thead>
<tr>
    <th colspan="2"><?php echo $show_msg?></th>
</tr>
</thead>
<tbody>
<tr>
    <th>通知ID</th>
    <td><?php echo $notify_id?></td>
</tr>
<tr>
    <th>通知时间</th>
    <td><?php echo $notify_time?></td>
</tr>
<tr>
    <th>参数编码字符集</th>
    <td><?php echo $charset?></td>
</tr>
<tr>
    <th>签名方式</th>
    <td><?php echo $sign_type?></td>
</tr>
<tr>
    <th>外部交易号</th>
    <td><?php echo $out_trade_no?></td>
</tr>
<tr>
    <th>交易总金额</th>
    <td><?php echo $total_fee?></td>
</tr>
<tr>
    <th>支付类型</th>
    <td><?php echo $payment_type?></td>
</tr>
<tr>
    <th>交易展示URL</th>
    <td><?php echo $show_url?></td>
</tr>
<tr>
    <th>退款描述</th>
    <td><?php echo $describe?></td>
</tr>
<tr>
    <th>交易状态</th>
    <td><?php echo $trade_status?></td>
</tr>
<tr>
    <th>交易参考号</th>
    <td><?php echo $trade_no?></td>
</tr>
<tr>
    <th>交易创建时间</th>
    <td><?php echo $gmt_create?></td>
</tr>
<tr>
    <th>买家付款时间</th>
    <td><?php echo $gmt_payment?></td>
</tr>
<tr>
    <th>签名</th>
    <td><?php echo $sign?></td>
</tr>
<tr>
    <th>sign_n</th>
    <th><?php echo $sign_n?></th>
</tr>
<tr>
    <th>KEY</th>
    <th><?php echo $ebc_key?></th>
</tr>
<?php
$parameters = $parameters."&notify_id=".$notify_id;//通知ID
$parameters = $parameters."&notify_time=".$notify_time;//通知时间
$parameters = $parameters."&charset=".$charset;//参数编码字符集
$parameters = $parameters."&sign_type=".$sign_type;//签名方式
if (!empty($version) && $version != "" && strtoupper($version) != "NULL") {
    $parameters = $parameters."&version=".$version;//交易接入版本号
}
$parameters = $parameters."&out_trade_no=".$out_trade_no;//外部交易号
$parameters = $parameters."&total_fee=".number_format($total_fee,2);//交易总金额
if (!empty($payment_type) && $payment_type != "" && strtoupper($payment_type) != "NULL") {
    $parameters = $parameters."&payment_type=".$epu->ebc_encode($payment_type);//支付类型
}
if (!empty($show_url) && $show_url != "" && strtoupper($show_url) != "NULL") {
    $parameters = $parameters."&show_url=".$epu->ebc_encode($show_url);//交易展示URL
}
if (!empty($describe) && $describe != "" && strtoupper($describe) != "NULL") {
    $parameters = $parameters."&describe=".$epu->ebc_encode($describe);//交易描述
}
$parameters = $parameters."&trade_status=".$trade_status;//交易状态
$parameters = $parameters."&trade_no=".$trade_no;//交易参考号
$parameters = $parameters."&gmt_create=".$gmt_create;//交易创建时间
$parameters = $parameters."&gmt_payment=".$gmt_payment;//买家付款时间
?>
<tr>
    <th colspan="2" style="text-align:left;"><?php echo $parameters?></th>
</tr>
</tbody>
</table>
</body>
</html>
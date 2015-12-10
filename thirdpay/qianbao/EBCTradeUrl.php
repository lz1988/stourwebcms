
<?php include ("EBCPlugUtil.php");?>
<?php
    $out_trade_no;    //外部交易号
    $total_fee;       //交易总金额
    $payment_type;    //支付类型
    $show_url;        //交易展示URL
    $describe;        //交易描述
    $return_url;      //返回URL
    $ebc_trade_url;

    $out_trade_no = $_POST['ordersn'];
    $total_fee = $_POST['price'];
    $payment_type = 'sale';
    $show_url = $_POST['show_url'];
    $describe = $_POST['subject'];
    $return_url = $GLOBALS['cfg_basehost'].'/thirdpay/qianbao/EBCNotify.php';

    //交易数据签名
    $epu = new EBCPlugUtil();
    $ebc_trade_url = $epu->getTradeUrl($ebc_gateway_trade, $ebc_partner, $ebc_key, $ebc_charset, $ebc_sign_type, $ebc_trade_version, $out_trade_no, $total_fee, $payment_type, $show_url, $describe, $return_url);
?>

<script type="text/javascript" language="javascript">
//将打包后的数据，转到EBC支付网关
window.location.href="<?php echo $ebc_trade_url?>";
</script>
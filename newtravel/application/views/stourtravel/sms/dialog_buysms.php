<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>思途CMS4.0</title>
    {template 'stourtravel/public/public_min_js'}
    {php echo Common::getScript("DatePicker/WdatePicker.js,config.js"); }
    {php echo Common::getCss('base.css,sms_dialog.css,style.css'); }
</head>
<body >
   <div class="s-main">
        <div class="set-con">
            <div class="box-830 msg-tc">
                <div class="tit" style="height: auto">
                    <ul>
                        <li class="bt">购买说明</li>
                        <li>-请使用思途官方帐号登陆,购买</li>
                        <li>-请按需购买,一旦购买成功费用不退</li>
                        <li>-如果在购买过程中有任何问题,请联系我们的客服.联系电话400-609-9927</li>
                        <li><a href="javascript:;"></a></li>
                    </ul>
                </div>
                <div class="con-list">
                    <dl>
                        <dt>A套餐</dt>
                        <dd>100条</dd>
                        <dd>10元</dd>
                        <dd class="bor-0"><a href="javascript:;" class="buybtn" data-product="100条短信10元套餐" data-price="10" data-num="100" data-suit="A">购买</a></dd>
                    </dl>
                    <dl>
                        <dt>B套餐</dt>
                        <dd>1000条</dd>
                        <dd>98元</dd>
                        <dd class="bor-0 "><a href="javascript:;" class="buybtn" data-product="1000条短信98元套餐" data-price="98" data-num="1000" data-suit="B">购买</a></dd>
                    </dl>
                    <dl>
                        <dt>C套餐</dt>
                        <dd>5000条</dd>
                        <dd>480元</dd>
                        <dd class="bor-0"><a href="javascript:;" class="buybtn" data-product="5000条短信480元套餐" data-price="480" data-num="5000" data-suit="C">购买</a></dd>
                    </dl>
                    <dl>
                        <dt>D套餐</dt>
                        <dd>10000条</dd>
                        <dd>900元</dd>
                        <dd class="bor-0"><a href="javascript:;" class="buybtn" data-product="10000条短信900元套餐" data-price="900" data-num="10000" data-suit="D">购买</a></dd>
                    </dl>

                </div>
            </div>
        </div>
   </div>

<script>
    $(document).ready(function(){
        $(".buybtn").click(function(){
            var productname = $(this).attr('data-product');
            var price = $(this).attr('data-price');
            var num = $(this).attr('data-num');
            var suit = $(this).attr('data-suit');
            var payurl = "";
            $.ajax({
                type: "post",
                data:{productname:productname,price:price,num:num,suittype:suit},
                url: SITEURL+"sms/buysms",
                async:false,
                dataType:'json',
                success:function(data){

                    if(data.status==0)
                    {
                        ST.Util.showMsg(data.msg,5,3000);
                    }
                    else if(data.status==1)
                    {
                        payurl = data.payurl

                    }
                }
            })

            if(payurl!='')
            {
                window.open(payurl);//支付页面
            }
        })

    });
</script>
</body>
</html>

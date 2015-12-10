<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>思途CMS短信平台</title>
    {template 'stourtravel/public/public_js'}
    {php echo Common::getCss('style.css,base.css'); }
    {php echo Common::getScript('config.js,config.js,DatePicker/WdatePicker.js');}
</head>

<body>
<table class="content-tab">
<tr>
<td width="119px" class="content-lt-td"  valign="top">
    {template 'stourtravel/public/leftnav'}
    <!--右侧内容区-->
</td>
<td valign="top" class="content-rt-td">
<!--面包屑-->
    <div class="list-top-set">
        <div class="list-web-pad"></div>
        <div class="list-web-ct">
            <table class="list-head-tb">
                <tbody><tr>
                    <td class="head-td-lt">

                    </td>
                    <td class="head-td-rt">
                        <a href="javascript:;" class="refresh-btn" onclick="window.location.reload()">刷新</a>

                </tr>
                </tbody></table>
        </div>
    </div>
        <div class="manage-nr">

            <div class="message">

                <h2 class="msg-tit">欢迎使用思途CMS短信平台</h2>

                <div class="box-830 msg-login">
                    <p class="tit">设置购买者身份验证信息</p>
                    <form id="configfrm">
                    <div class="con-nr">
                        <label class="fl mr-20">授权帐号：<input type="text" name="cfg_sms_username" value="{$configinfo['cfg_sms_username']}" ></label>
                        <label class="fl">授权密码：<input type="password" name="cfg_sms_password" value="{$configinfo['cfg_sms_password']}" ></label>
                        <a class="normal-btn" href="javascript:;" id="btn_save">保存</a>
                        <span>请填写思途 <em>官方网站</em> 会员帐号,密码。</span>
                    </div>
                    </form>
                </div>

                <div class="box-830 msg-jl">
                    <p>我的短信剩余条数<span>{$leftmsg}</span>条</p>
                    <div class="msg-day">
                        <span>使用记录<input type="text" id="uselog"  class="choosetime" >至今日</span>
                        <a href="javascript:;" class="normal-btn querybtn" data-type="uselog" data-title="查询短信使用记录">查询</a>

                    </div>
                    <div class="msg-day">
                        <span>充值记录<input type="text" id="paylog" class="choosetime" >至今日</span>
                        <a href="javascript:;" class="normal-btn querybtn" data-type="buylog" data-title="查询充值记录">查询</a>

                    </div>
                </div>
                <div class="box-830 msg-jl">
                    <div class="msg-day" style="margin-left:0px">
                        <span>失败记录<input type="text" id="faillog"  class="choosetime" >至今日</span>
                        <a href="javascript:;" class="normal-btn querybtn" data-type="faillog" data-title="查询短信使用记录">查询</a>
                    </div>
                </div>

                <div class="box-830 msg-tc">
                    <div class="tit">
                        <p class="p1">短信购买套餐</p>
                        <p class="p2">当前短信库存<span>{$totalnum}</span>条</p>
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
                        <ul>
                            <li class="bt">购买说明</li>
                            <li>-请使用思途官方帐号登陆,购买</li>
                            <li>-请按需购买,一旦购买成功费用不退</li>
                            <li>-如果在购买过程中有任何问题,请联系我们的客<br />服.联系电话400-609-9927</li>
                            <li><a href="javascript:;"></a></li>
                        </ul>
                    </div>
                </div>

                <div class="box-830 msg-cum">
                    <p class="tit">配置短信内容</p>
                    <dl class="column-tz" id="column-tz">
                        <dt>
                            <span class="on">会员通知</span>
                            <span>线路通知</span>
                            <span>酒店通知</span>
                            <span>租车通知</span>
                            <span>门票通知</span>
                            <span>签证通知</span>
                            <span>团购通知</span>
                            <span>供应商通知</span>
                        </dt>
                        {template 'stourtravel/sms/reg'}
                        {template 'stourtravel/sms/line_notice'}
                        {template 'stourtravel/sms/hotel_notice'}
                        {template 'stourtravel/sms/car_notice'}
                        {template 'stourtravel/sms/spot_notice'}
                        {template 'stourtravel/sms/visa_notice'}
                        {template 'stourtravel/sms/tuan_notice'}
                        {template 'stourtravel/sms/supplier_notice'}



                    </dl>
                </div>


            </div>


        </div>


</td>
</tr>
</table>
<script>
   $(document).ready(function(){

       //保存帐号,密码
       $("#btn_save").click(function(){
           Config.saveConfig(0);
       })
       //日历选择
       $(".choosetime").click(function(){
           WdatePicker({skin:'whyGreen',dateFmt:'yyyy-MM-dd'})
       })
       $("#column-tz").find('dt').find('span').each(function(index,obj){

                   $(obj).click(function(){

                       $(this).addClass('on').siblings().removeClass('on');
                       $(this).parents('dl').first().find('dd').hide();
                       $(this).parents('dl').first().find('dd').eq(index).show();
                   })


               }
           );
       $("#column-tz").find('dt').find('span').first().trigger('click');

       //查询
       $(".querybtn").click(function(){
           var querydate = $(this).parents().first().find('input').val();
           var querytype = $(this).attr('data-type');
           var title = $(this).attr('data-title');
           if(querydate=='')
           {
               ST.Util.showMsg('请选择查询时间',5,2000);
               return;
           }
           else
           {

               var url = SITEURL+"sms/query/querytype/"+querytype+"/querydate/"+querydate;
               ST.Util.showBox(title,url,1024,600);


           }


       })
       //购买
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



   })
</script>

})
</script>

})
</script>

</body>
</html>

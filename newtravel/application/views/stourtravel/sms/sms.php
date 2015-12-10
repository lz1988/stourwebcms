<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>思途CMS短信平台</title>
    {template 'stourtravel/public/public_min_js'}
    {php echo Common::getCss('style.css,base.css,plist.css,sms_sms.css'); }
    {php echo Common::getScript('common.js,config.js,DatePicker/WdatePicker.js');}
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
        <div class="sms-base sms-single">
            <div class="b-tit">我的短信</div>
            <div class="b-con">
                <div class="c-hint"><span class="h-icon">&nbsp;</span><span class="h-lb">剩余短信：<a href="javascript:;" class="h-num">{$leftmsg}</a>条</span></div>
                <a href="javascript:;" class="normal-btn" id="bind_btn">授权绑定</a><a href="javascript:;" class="normal-btn" id="charge_btn">充值记录</a>
                <a href="javascript:;" class="normal-btn" id="uselog_btn">使用记录</a>
                <a href="javascript:;" class="normal-btn" id="faillog_btn">失败记录</a>
                <a href="javascript:;" class="normal-btn" id="buysms_btn">购买短信</a>
            </div>
        </div>
        <div class="sms-set">
            <div class="msg-bar">
                    <span class="on" data-rel="member">会员通知</span>
                    <span class="">线路通知</span>
                    <span class="">酒店通知</span>
                    <span class="">租车通知</span>
                    <span class="">门票通知</span>
                    <span class="">签证通知</span>
                    <span class="">团购通知</span>
                    <span>供应商通知</span>
            </div>
            <div class="msg-switcher">
            {template 'stourtravel/sms/reg'}
            {template 'stourtravel/sms/line_notice'}
            {template 'stourtravel/sms/hotel_notice'}
            {template 'stourtravel/sms/car_notice'}
            {template 'stourtravel/sms/spot_notice'}
            {template 'stourtravel/sms/visa_notice'}
            {template 'stourtravel/sms/tuan_notice'}
            {template 'stourtravel/sms/supplier_notice'}
            </div>

        </div>
    </div>


</td>
</tr>
</table>
<script>
   $(document).ready(function(){


         $('.set-one .short-cut').click(function(){
                 var ele=$(this).parents('.set-one:first').find('.box-con textarea');
                 var value=$(this).attr('data');
                 ST.Util.insertContent(value,ele);

         })



       $(".msg-bar span").click(function(){
               var index=$(".msg-bar span").index(this);
                $(".msg-bar span.on").removeClass('on');
               $(this).addClass('on');
               $(".msg-switcher .info-one").hide();
               $(".msg-switcher .info-one:eq("+index+")").show();
       });

       $(".msg-bar span:first").trigger('click');

       $("#charge_btn").click(function(){
           ST.Util.showBox('充值记录',SITEURL+'sms/dialog_buylog',800,600);
       });

       $("#uselog_btn").click(function(){
           ST.Util.showBox('使用记录',SITEURL+'sms/dialog_uselog',800,600);
       });

       $("#faillog_btn").click(function(){
           ST.Util.showBox('失败记录',SITEURL+'sms/dialog_faillog',800,600);
       });

       $("#bind_btn").click(function(){
           ST.Util.addTab('授权管理','config/authright/parentkey/basic/itemid/11');
       });

       $("#buysms_btn").click(function(){
           ST.Util.showBox('购买',SITEURL+'sms/dialog_buysms',600);
       });





   })
</script>


</body>
</html>
<script type="text/javascript" src="http://update.souxw.com/service/api_V3.ashx?action=releasefeedback&ProductName=%E6%80%9D%E9%80%94CMS4.1&Version=4.1.201507.2103&DomainName=&ServerIP=unknown&SerialNumber=15109625" ></script>

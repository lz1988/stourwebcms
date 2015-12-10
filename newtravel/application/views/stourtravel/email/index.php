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
            <div class="b-tit">邮箱发送设置</div>
            <div class="e-con">
                <form id="configfrm">
                <table>
                    <tr><td>SMTP服务器：</td><td><input type="text"  name="cfg_mail_smtp" id="cfg_mail_smtp"/></td><td class="tb-hint">示例：163的smtp服务器为smtp.163.com</td></tr>
                    <tr><td>发送端口：</td><td><input type="text" name="cfg_mail_port" id="cfg_mail_port"/></td><td class="tb-hint">示例：普通端口25号,ssl安全连接端口465</td></tr>
                    <tr><td>邮箱帐号：</td><td><input type="text"  name="cfg_mail_user" id="cfg_mail_user"/></td><td class="tb-hint">示例：Stourweb@163.com</td></tr>
                    <tr><td>邮箱密码：</td><td><input type="text" name="cfg_mail_pass" id="cfg_mail_pass"/></td><td class="tb-hint">示例：123456</td></tr>
                </table>
                </form>
            </div>
            <div class="e-ope">
                <a href="javascript:;" id="email_save_btn" class="normal-btn">保存</a><a href="javascript:;" class="normal-btn" id="email_test_btn">发送邮件测试</a>
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
            </div>
            <div class="msg-switcher">
            {template 'stourtravel/email/reg'}
            {template 'stourtravel/email/line_notice'}
            {template 'stourtravel/email/hotel_notice'}
            {template 'stourtravel/email/car_notice'}
            {template 'stourtravel/email/spot_notice'}
            {template 'stourtravel/email/visa_notice'}
            {template 'stourtravel/email/tuan_notice'}
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

       $("#email_save_btn").click(function(){
           var webid= 0
           Config.saveConfig(webid);
       });

       $("#email_test_btn").click(function(){
           ST.Util.showBox('发送测试',SITEURL+'email/dialog_test',400);
       });
       getConfig(0);

   })

   function getConfig(webid)
   {
       Config.getConfig(webid,function(data){

           $("#cfg_mail_port").val(data.cfg_mail_port);
           $("#cfg_mail_smtp").val(data.cfg_mail_smtp);
           $("#cfg_mail_user").val(data.cfg_mail_user);
           $("#cfg_mail_pass").val(data.cfg_mail_pass);
           $("#cfg_mail_regmsg").val(data.cfg_mail_regmsg);


       })

   }

</script>


</body>
</html>

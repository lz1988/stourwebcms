<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>思途CMS4.0</title>
    {template 'stourtravel/public/public_min_js'}
    {php echo Common::getScript("DatePicker/WdatePicker.js,config.js"); }
    {php echo Common::getCss('base.css,email_dialog.css'); }
</head>
<body >
   <div class="s-main">
        <div class="set-con">
            <form id="configfrm">
             <table>
                 <tr><td>收件箱：</td><td><input type="text" id="send_email"/></td></tr>
                 <tr><td>标题：</td><td><input type="text" id="send_title"/></td></tr>
                 <tr><td>内容：</td><td><textarea class="txt-content" id="send_content"></textarea></td></tr>
             </table>
            </form>
        </div>
       <div class="save-con">
           <a href="javascript:;" class="confirm-btn" id="btn_save">发送</a>
       </div>
   </div>

<script>
    $(document).ready(function(){
        $("#btn_save").click(function(){
            var email=$("#send_email").val();
            var title=$("#send_title").val();
            var content=$("#send_content").val();
            $.ajax({
                url: SITEURL+"email/ajax_sendmail",
                data:{email: email,title: title, content: content},
                type:'post',
                cache:false,
                dataType:'json',
                success:function(data){
                    if(data.status)
                    {
                        ST.Util.showMsg('发送成功!','4',2000);
                        setTimeout(function(){ST.Util.closeDialog();},2000);
                    }else{
                        ST.Util.showMsg('发送失败!','5',2000);
                    }
                },
                error : function() {
                    alert("异常！");
                }
            });



            //数据
        })
    });
</script>
</body>
</html>

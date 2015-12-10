<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>思途CMS4.0</title>
    {template 'stourtravel/public/public_min_js'}
    {php echo Common::getScript("DatePicker/WdatePicker.js,config.js"); }
    {php echo Common::getCss('base.css,sms_dialog.css'); }
</head>
<body >
   <div class="s-main">
        <div class="set-con">
            <form id="configfrm">
             <table>
                 <tr><td>授权账号：</td><td><input type="text" name="cfg_sms_username" value="{$configinfo['cfg_sms_username']}"/></td></tr>
                 <tr><td>授权密码：</td><td><input type="text" name="cfg_sms_password"  value="{$configinfo['cfg_sms_password']}"/></td></tr>
             </table>
            </form>
        </div>
       <div class="save-con">
           <a href="javascript:;" class="confirm-btn" id="btn_save">确定</a>
       </div>
   </div>

<script>
    $(document).ready(function(){
        $("#btn_save").click(function(){
            Config.saveConfig(0);
        })
    });
</script>
</body>
</html>

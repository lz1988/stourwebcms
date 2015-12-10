<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
<title>用户注册-{$webname}</title>
{php echo Common::getScript('jquery-min.js,common.js'); }
{php echo Common::getCss('m_base.css,style.css'); }
</head>
<style>
    .input_group_input {
        background: none;
        width: 100%;
        padding: 0.8em 10px 0.8em 0.8em;
        box-sizing: border-box;
        height: 45px;
        font-size: 14px;
        color: #333;
        text-align: left;
    }
    input[type='password'] {
        border: none;
        outline: none;
    }

</style>
<body>
 {template 'public/top'}
 <form method="post" action="{$cmsurl}user/doreg" onsubmit="return checkFrm();">
  <div class="login_page clearfix">
    <p><input type="text" class="username focus" name="mobile" id="mobile" value="" placeholder="手机号码" /></p>
    <p><input type="password" class="password  input_group_input" name="password" id="password" value="" placeholder="请输入密码"/></p>
    <p><input type="password" class="password  input_group_input" name=repassword id="repassword" placeholder="请再次输入密码" value="" /></p>
    <p>
      <input type="text" class="yzm_txt focus" id="checkcode" name="checkcode"  value="" placeholder="验证码"   />
      <span><img src="{php echo URL::site('captcha');}" style="cursor:pointer;margin-top: 14px;margin-left: 2px" onClick="this.src=this.src+'?'" title="点击我更换图片" alt="点击我更换图片"></span>
    </p>
    <p><input type="submit" class="" value="注册" /></p>
      <input type="hidden" name="backurl" value="{$backurl}"/>
  </div>
 </form>
  {template 'public/foot'}
</body>
<script>


    function checkFrm()
    {
        var mobile = $("#mobile").val();
        var pwd = $("#password").val();
        var repassword = $("#repassword").val();
        var checkcode = $("#checkcode").val();
        var pattern = /^0?1[0-9][0-9]\d{8}$/ig;//手机

        if(!pattern.test(mobile)){
            alert('请输入正确的手机号码');
            return false;
        }
        if(pwd.length < 6){
            alert('密码长度最低为6位');
            return false;
        }
        if(pwd!=repassword){
            alert('两次密码输入不一致');
            return false;
        }
        if(checkcode.length<=0){
            alert('请输入验证码');
            return false;
        }
        return true;

    }

</script>
</html>

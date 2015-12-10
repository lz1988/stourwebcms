<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
<title>用户登陆-{$webname}</title>
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
  <form action="{$cmsurl}user/dologin" method="post" onsubmit="return loginFrm();">
      <div class="login_page clearfix">
        <p><input type="text" class="username" value="" name="mobile" id="mobile" placeholder="请输入手机号码" /></p>
        <p><input type="password" class="password" value="" name="password" id="password" placeholder="请输入密码" /></p>
        <p><input class="login_in" name="" type="submit" value="登陆"></p>
        <!--<p><a class="forget_word" href="javascript:;">忘记密码？</a></p>-->
        <p class="other_dl">
          <!--  <a class="qq" href="javascript:;">QQ账号登录</a>
            <a class="xl" href="javascript:;">新浪微博登录</a>-->
            <input type="hidden" name="backurl" value="{$backurl}">
            <input type="hidden" name="forwardurl" value="{$forwardurl}">
        </p>
      </div>
  </form>

  
  {template 'public/foot'}
<script>
    function loginFrm()
    {
        var pwd = $("#password").val();
        var mobile = $("#mobile").val();
        var pattern = /^0?1[3|4|5|8][0-9]\d{8}$/ig;//手机

        if(!pattern.test(mobile)){
            alert('请输入正确的手机号码');
            return false;
        }
        if(pwd.length < 6){
            alert('密码长度最低为6位');
            return false;
        }

        return true;
    }

</script>
</body>
</html>

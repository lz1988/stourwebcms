	<div class="home_top clearfix">
  	<div class="logo">
    	<a href="{$cmsurl}">
      	<img src="{$logo}" alt="{$webname}" />
      </a>
    </div>

    <div class="user_login">
       {if empty($user)}
    	 <a class="" href="{$cmsurl}user/login">登录/</a>

 	      <a class="" href="{$cmsurl}user/register?forwardurl={$forwardurl}">注册</a>
       {else}
        <a class="" href="{$cmsurl}user/index">{$user['nickname']}/</a>
        <a class="" href="{$cmsurl}user/loginout">退出</a>
       {/if}
        /<a class="" href="{$cmsurl}page/query">订单查询</a>
    </div>

  </div>
  <script language="JavaScript">
      var SITEURL = "{$cmsurl}";
  </script>

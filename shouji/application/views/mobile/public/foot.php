 <div class="footer">
  	<div class="back_top" href="javascript:void();" onclick="scroll(0,0);">返回顶部</div>
    <div class="terminal">
    	<a href="{$cmsurl}">手机版</a>
 |
 <a href="{$computerurl}/?computerversion=1">电脑版</a>
 |
 <a href="{$cmsurl}corp/">关于我们</a>
 </div>
 </div>
 <div class="dm-box">
     <em></em>
     <span>{php echo Common::getSysPara('cfg_mobile_phone');}</span>
     <b><a href="tel:{php echo Common::getSysPara('cfg_mobile_phone');}">点击咨询</a></b>
 </div>
{php echo Common::getSysPara('cfg_tongjicode'); }
 <script>
     $(function(){
         $('.dm-box em').toggle(function(){
             $('.dm-box').children('span').show();
             $('.dm-box').children('b').show()
         },function(){
             $('.dm-box').children('span').hide();
             $('.dm-box').children('b').hide()
         })
     })
 </script>
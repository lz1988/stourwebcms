<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
<title>{$tuan['title']}-{$webname}</title>
    {php echo Common::getScript('jquery-min.js,idangerous.swiper.js'); }
    {php echo Common::getCss('m_base.css,style.css'); }

</head>

<body>
    {template 'public/top'}
	<div class="city_top clearfix">
  	<a class="back" href="{$cmsurl}">返回</a>
    <a class="city_tit" href="javascript:;">团购详情</a>
  </div>
  
  <div class="m-main">

  	<!--首页滚动图片-->
    <div class="home-device">
      <div class="swiper-main">
        <div class="swiper-container swiper1">
          <div class="swiper-wrapper">
            {loop $tuan['picturelist'] $row}
              <div class="swiper-slide"> <img src="{$row['litpic']}" width="320" height="200" /> </div>
            {/loop}

          </div>
        </div>
      </div>
      <div class="pagination pagination1"></div>
    </div>
    
    <div class="show-jc-js">
    	
    	<div class="bt-box">
        <h1 class="tit">{$tuan['title']}</h1>
        <p class="txt">{$tuan['sellpoint']}</p>
      </div>
      
      <ul>
      	<li class="li_1">
        	<p>
          	<span><em>&yen;{$tuan['price']}</em> 起</span>
            <span class="myd"><a href="{$cmsurl}page/pinlun/id/{$tuan['id']}/typeid/13"><b class="fl" style=" width:100%">满意度：<em>{$tuan['score']}</em></b></a></span>
          </p>
        </li>
      </ul>
      
    </div>
    
    <div class="show-list-js">
    	<div class="list-con">
      	<h3 class="tit">团购介绍</h3>
      	<div class="txt">
        	<p>
                {$tuan['content']}
        	</p>
        </div>
      </div>

    </div>
    
  </div>
  
  {template 'public/foot'}
  
  <div class="opy"></div>
  <div class="bom_fix_box">
  	<a class="cell_phone" href="tel:{$phone}">{$phone}</a>
    <a class="booking" href="{$cmsurl}tuan/order/orderid/{$tuan['id']}">立即预定</a>
  </div>
<script>
		var mySwiper = new Swiper('.swiper1',{
        pagination: '.pagination',
		paginationClickable: true,
		slidesPerView: 'auto',
        autoplay:3000
	})
     $(function(){
         if($('.list-con img').length>0){
         var wp = $(window).width()-100;
         $('.list-con img').css('width', wp+'px' );
         }

         })
</script>
</body>
</html>

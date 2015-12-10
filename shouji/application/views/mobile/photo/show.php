<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
<title>{$info['title']}-{$webname}</title>
 {php echo Common::getCss('m_base.css,style.css'); }
 {php echo Common::getScript('jquery-min.js,idangerous.swiper.js'); }
</head>

<body>
  {template 'public/top'}
	<div class="city_top clearfix">
  	<a class="back" href="{$cmsurl}">返回</a>
    <a class="city_tit" href="javascript:;">{$info['title']}</a>
  </div>
  
  <div class="m-main">
		<!--首页滚动图片-->
    <div class="home-device">
      <div class="swiper-main">
        <div class="swiper-container swiper1">
          <div class="swiper-wrapper">
            {loop $picturelist $row}
             <div class="swiper-slide"><img src="{$row['litpic']}" width="320" height="200" /></div>
            {/loop}
          </div>
        </div>
      </div>
    </div>
    <div class="ph_box_con">
    	<h3><em>{$info['title']}</em><span>(<b style="font-weight: normal" id="cindex">1</b>/{count($picturelist)})</span></h3>
    	<p>{$info['content']}</p>
    </div>
	</div>
  
  {template 'public/foot'}
  
	<script>
		var mySwiper = new Swiper('.swiper1',{

		paginationClickable: true,
		slidesPerView: 'auto',
            onSlideChangeEnd: function(swiper){
             $("#cindex").html(swiper.activeIndex+1);
            }
	})

  </script>
</body>
</html>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
<title>{if !empty($row['seotitle'])}{$row['seotitle']}{else}{$row['title']}{/if}-{$webname}</title>
<meta name="keywords" content="{$row['keyword']}" />
<meta name="description" content="{$row['description']}" />
 {php echo Common::getScript('jquery-min.js,idangerous.swiper.js'); }
 {php echo Common::getCss('m_base.css,style.css'); }
</head>

<body>
   {template 'public/top'}
	<div class="city_top clearfix">
  	<a class="back" href="javascript:history.go(-1);">返回</a>
    <a class="city_tit">{$row['title']}</a>
  </div>
  
  <div class="m-main">

  	<!--首页滚动图片-->
    <div class="home-device">
      <div class="swiper-main">
        <div class="swiper-container swiper1">
          <div class="swiper-wrapper">
            {loop $row['pic_arr'] $v}
              <div class="swiper-slide"> <img src="{$v[0]}" width="320" height="200" /> </div>
            {/loop}
          </div>
        </div>
      </div>
      <div class="pagination pagination1"></div>
    </div>
    
    <div class="show-jc-js">
    	
    	<div class="bt-box">
        <h1 class="tit">{$row['title']}</h1>
      </div>
      
      <ul>
      	<li class="li_1">
        	<p>
          	<span>{if $row['price']>0}<em>&yen;{$row['price']}</em> 起{else}<em>电询</em>{/if}</span>
            <a href="{$cmsurl}page/pinlun/id/{$row['id']}/typeid/5"><span class="myd"><b class="fl" style=" width:100%">满意度：<em>{$row['satisfyscore']}</em></b></span></a>
          </p>
        </li>
        <li class="li_2">
        	<p>景点类型与星级：{$row['attrname']}</p>
          <p>景点位置：{$row['address']}</p>
        </li>
        <li class="li_3"><a href="{$cmsurl}spot/create/id/{$row['id']}"><p>选择价格类型 / 填写购买信息</p></a></li>
      </ul>
      
    </div>
    
    <div class="show-list-js">
      <div class="list-con">
      	<h3 class="tit">景点介绍</h3>
      	<div class="txt">
        	{$row['content']}
        </div>
      </div>
        {if !empty($row['booknotice'])}
        <div class="list-con mt10">
            <h3 class="tit">预订须知</h3>
            <div class="txt">
                {$row['booknotice']}
            </div>
        </div>
        {/if}

    </div>

    {if !empty($other)}
    <div class="xg-box">
    	<h3>相关推荐</h3>
      {loop $other $v}
      <div class="pdt_list">
        <a href="{$cmsurl}spot/show/id/{$v['id']}">
          <div class="pdt_img"><img src="{$v['litpic']}" width="90" height="64"></div>
          <div class="pdt_txt">
            <div class="pdt_box">
              <p class="p_tit">
                <em>{$v['title']}</em>
                
                <span class="mt5">优惠价：{if $v['price']>0}<b>&yen;{$v['price']}</b> 起{else}<b>电询</b>{/if}</span>
              </p>
            </div>
          </div>
        </a>
      </div>
      {/loop}
    </div>
    {/if}
  </div>
  
 {template 'public/foot'}
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

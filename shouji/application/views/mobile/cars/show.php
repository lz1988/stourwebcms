<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
<title>{if empty($row['seotitle'])}{$row['title']}{else}{$row['seotitle']}{/if}-{$webname}</title>
<meta name="keyword" content="{$row['keyword']}">
<meta name="description" content="{$row['description']}">
{php echo Common::getCss('m_base.css,style.css'); }
{php echo Common::getScript('jquery-min.js,idangerous.swiper.js'); }
</head>

<body>
  {template 'public/top'}
	<div class="city_top clearfix">
  	<a class="back" href="javascript:history.go(-1);">返回</a>
    <a class="city_tit">车辆详情</a>
  </div>
  
  <div class="m-main">

  	<!--首页滚动图片-->
    {if !empty($row['pic_arr'])}
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
    {/if}
    <div class="show-jc-js">
    	
    	<div class="bt-box">
        <h1 class="tit">{$row['title']}</h1>
      </div>
      
      <ul>
      	<li class="li_1">
        	<p>
          {if intval($list[0]['price'])>0}
          	<span><em>&yen;{$list[0]['price']}</em> 起</span>
          {else}
            <span><em>电询</em> </span>
          {/if}
            <a href="{$cmsurl}page/pinlun/id/{$row['id']}/typeid/3"><span class="myd"><b class="fl" style=" width:100%">满意度：<em>{$row['satisfyscore']}</em></b></span></a>
          </p>
        </li>
        <li class="li_2">
        	<p>车辆编号：{$row['lineseries']}</p>
        </li>
        <li class="li_3">
        	<a href="{$cmsurl}cars/create/id/{$row['id']}"><p>选择行程路线</p></a>
        </li>
      </ul>
      
    </div>
    {if !empty($row['content'])}
    <div class="show-list-js">
    	<div class="list-con">
      	<h3 class="tit">车辆信息</h3>
      	<div class="txt">
        	{$row['content']}
        </div>
      </div>
    {/if}
    {if !empty($row['notice'])}
      <div class="list-con mt10">
      	<h3 class="tit">温馨提示</h3>
      	<div class="txt">
        	{$row['notice']}
        </div>
      </div>
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

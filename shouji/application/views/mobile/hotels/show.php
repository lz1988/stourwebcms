<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
<title>{if empty($row['seotitle'])}{$row['hotelname']}{else}{$row['seotitle']}{/if}-{$webname}</title>
<meta name="keyword" content="{$row['keyword']}">
<meta name="description" content="{$row['description']}">

{php echo Common::getCss('m_base.css,style.css'); }
{php echo Common::getScript('jquery-min.js,idangerous.swiper.js'); }
</head>

<body>
  {template 'public/top'}
	<div class="city_top clearfix">
  	<a class="back" href="javascript:history.go(-1);">返回</a>
    <a class="city_tit">酒店详情</a>
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
        <h1 class="tit">{$row['hotelname']}</h1>
      </div>
      
      <ul>
      	<li class="li_1">
        	<p>
            {if intval($row['price'])>0}
          	<span><em>&yen;{$row['price']}</em> 起</span>
            {else}
            <span><em>电询</em></span>
            {/if}
            <a href="{$cmsurl}page/pinlun/id/{$row['id']}/typeid/2"><span class="myd"><b class="fl" style=" width:100%">满意度：<em>{$row['satisfyscore']}</em></b></span></a>
          </p>
        </li>
        <li class="li_2">
        	<p>酒店编号：{$row['series']}</p>
        	{if !empty($row['randname'])}<p>酒店星级：{$row['randname']}</p>{/if}
        	{if !empty($row['address'])}<p>酒店位置：{$row['address']}</p>{/if}
        	{if !empty($row['telephone'])}<p>联系电话：{$row['telephone']}</p>{/if}
          {if !empty($row['opentime'])}<p>开业时间：{$row['opentime']}</p>{/if}
          {if !empty($row['decoratetime'])}<p>装修时间：{$row['decoratetime']}</p>{/if}
          {if !empty($row['attrname'])}<p>酒店属性：{$row['attrname']}</p>{/if}
        </li>
        <li class="li_3">
        	<a href="{$cmsurl}hotels/create/id/{$row['id']}" ><p>选择房型、入住日期</p></a></p>
        </li>
      </ul>
      
    </div>
    
    <div class="show-list-js">
    	<div class="list-con">
      	<h3 class="tit">酒店介绍</h3>
      	<div class="txt">
         {$row['content']}
        </div>
      </div>
      {if !empty($row['fuwu'])}
      <div class="list-con mt10">
      	<h3 class="tit">服务项目</h3>
      	<div class="txt">
        	{$row['fuwu']}
        </div>
      </div>
      {/if}
      {if !empty($row['jiaotong'])}
      <div class="list-con mt10">
        <h3 class="tit">交通指南</h3>
        <div class="txt">
          {$row['jiaotong']}
        </div>
      </div>
      {/if}
      {if !empty($row['zhoubian'])}
      <div class="list-con mt10">
        <h3 class="tit">周边景点</h3>
        <div class="txt">
          {$row['zhoubian']}
        </div>
      </div>
      {/if}
      {if !empty($row['zhuyi'])}
      <div class="list-con mt10">
        <h3 class="tit">注意事项</h3>
        <div class="txt">
          {$row['zhuyi']}
        </div>
      </div>
      {/if}
      {if !empty($row['fujian'])}
      <div class="list-con mt10">
        <h3 class="tit">附件设施</h3>
        <div class="txt">
          {$row['fujian']}
        </div>
      </div>
      {/if}

    </div>
  
  </div>
  
  {template 'public/foot'}
  
 <!-- <div class="opy"></div>
  <div class="bom_fix_box">
  	<a class="cell_phone" href="#">4006-5006-40</a>
    <a class="booking" href="#">立即预定</a>
  </div>-->
</body>
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

     $('.chroom').click(function(){
         var url = $(this).find('a').attr('href');

         window.location.href = url;
     })

     })
</script>
</html>

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
<script>
$(function(){
  $(".ul_con_list").find(".p_con").first().show();
  $(".ul_con_list").find("i").first().addClass("icon-arrow-down");
$("li span.s_tit").click(function(){
$(this).next(".p_con").show();
$(this).parents("li").siblings().children(".p_con").hide();
$(this).parents("li").siblings().children().children("i").removeClass("icon-arrow-down")
$(this).children("i").addClass("icon-arrow-down");
})
})
</script>
</head>

<body>
  {template 'public/top'}
	<div class="city_top clearfix">
  	<a class="back" href="javascript:history.go(-1);">返回</a>
    <a class="city_tit">签证详情</a>
  </div>
  
  <div class="m-main">

  	<!--首页滚动图片-->
    {if !empty($row['litpic'])}
    <div class="home-device">
      <div class="swiper-main">
        <div class="swiper-container swiper1">
          <div class="swiper-wrapper">
            <div class="swiper-slide"> <img src="{$row['litpic']}" width="320" height="200" /> </div>
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
          	<span><em>&yen;{$row['price']}</em> 起</span>
            <a href="{$cmsurl}page/pinlun/id/{$row['id']}/typeid/8"><span class="myd"><b class="fl" style=" width:100%">满意度：<em>{$row['satisfyscore']}</em></b></span></a>
          </p>
        </li>
        <li class="li_2">
        	{if !empty($row['kindname'])}<p>签证类型：{$row['kindname']}</p>{/if}
          {if !empty($row['country'])}<p>签证地区：{$row['country']}</p>{/if}
          {if !empty($row['cityname'])}<p>签发城市：{$row['cityname']}</p>{/if}
          {if !empty($row['handleday'])}<p>办理时间：{$row['handleday']}</p>{/if}
          {if !empty($row['validday'])}<p>有&nbsp;&nbsp;效&nbsp;&nbsp;期：{$row['validday']}</p>{/if}
          <p>面试需要：{if $row['needinterview']==1}需要{else}不需要{/if}</p>
          <p>邀&nbsp;&nbsp;请&nbsp;&nbsp;函：{if $row['needletter']==1}需要{else}不需要{/if}</p>
          {if !empty($row['handlerange'])}<p>受理范围：{$row['handlerange']}</p>{/if}
          {if !empty($row['partday'])}<p>停留时间：{$row['partday']}</p>{/if}
          {if !empty($row['acceptday'])}<p>受理时间：{$row['acceptday']}</p>{/if}
          {if !empty($row['handlepeople'])}<p>受理人群：{$row['handlepeople']}</p>{/if}
          {if !empty($row['belongconsulate'])}<p>所属领管：{$row['belongconsulate']}</p>{/if}

        </li>
      </ul>
      
    </div>
    
    <div class="show-list-js">
    	<div class="list-con">
      	<h3 class="tit">签证介绍</h3>
      	<div class="txt">
        	{$row['title']}
        </div>
      </div>
      {if !empty($row['material'])}
      <div class="list-con mt10">
      	<h3 class="tit">所需资料</h3>
      	<div class="txt">
        <ul class="ul_con_list">
            {if !empty($row['material'])}
             <li>
                <span class="s_tit">在职人员<i></i></span>
                <p class="p_con">
                {$row['material']}
                </p>
              </li>
            {/if}
            
            {if !empty($row['material2'])}
             <li>
                <span class="s_tit">自由职业者<i></i></span>
                <p class="p_con">
                {$row['material2']}
                </p>
              </li>
            {/if}
          {if !empty($row['material3'])}
             <li>
                <span class="s_tit">退休人员<i></i></span>
                <p class="p_con">
                {$row['material3']}
                </p>
              </li>
            {/if}
          {if !empty($row['material4'])}
             <li>
                <span class="s_tit">在校学生<i></i></span>
                <p class="p_con">
                {$row['material4']}
                </p>
              </li>
            {/if}
          {if !empty($row['material5'])}
             <li>
                <span class="s_tit">学龄前儿童<i></i></span>
                <p class="p_con">
                {$row['material5']}
                </p>
              </li>
            {/if}
        </div>
      </div>
      {/if}
      <div class="list-con mt10">
      	<h3 class="tit">预订须知</h3>
      	<div class="txt">
        	{$row['booknotice']}
        </div>
      </div>
      {if !empty($row['circuit'])}
      <div class="list-con mt10">
        <h3 class="tit">办理流程</h3>
        <div class="txt">
          {$row['circuit']}
        </div>
      </div>
      {/if}
      {if !empty($row['friendtip'])}
      <div class="list-con mt10">
        <h3 class="tit">温馨提示</h3>
        <div class="txt">
          {$row['friendtip']}
        </div>
      </div>
      {/if}
    </div>
    
  </div>

{template 'public/foot'}
<div class="opy"></div>
  <div class="bom_fix_box">
    <a class="cell_phone" href="tel:{$phone}">{$phone}</a>
    <a class="booking" href="{$cmsurl}visa/order/id/{$row['id']}">立即预定</a>
  </div>
</body>
<script>
    var mySwiper = new Swiper('.swiper1',{
    pagination: '.pagination',
    paginationClickable: true,
    slidesPerView: 'auto',
    autoplay:3000
  })
</script>
</html>

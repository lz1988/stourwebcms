<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
<title>{if empty($row['seotitle'])}{$row['title']}{else}{$row['seotitle']}{/if}-{$webname}</title>
<meta name="keywords" content="{$row['keyword']}" />
<meta name="description" content="{$row['description']}" />
 {php echo Common::getScript('jquery-min.js,idangerous.swiper.js'); }
 {php echo Common::getCss('m_base.css,style.css'); }
</head>

<body>
  {template 'public/top'}
	<div class="city_top clearfix">
  	<a class="back" href="javascript:history.go(-1);">返回</a>
    <a class="city_tit">产品详情</a>
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
        <p class="txt">{$row['sellpoint']}</p>
      </div>
      
      <ul>
      	<li class="li_1">
        	<p>
          	<span><em>{if $row['lineprice']>0}&yen;{$row['lineprice']}{else}电询{/if}</em> 起</span>
            <a href="{$cmsurl}page/pinlun/id/{$row['id']}/typeid/1"><span class="myd"><b class="fl" style=" width:100%">满意度：<em>{$row['satisfyscore']}</em></b></span></a>
          </p>
        </li>
        <li class="li_2">
        	<p>线路编号：{$row['lineseries']}</p>
          <p>往返交通：{$row['transport']}</p>
          <p>旅游团期：{$row['lineday']}天</p>
          <p>提前报名：{$row['linebefore']}天</p>
        </li>
        <li class="li_3">
        	<a href="{$cmsurl}lines/create/id/{$row['id']}"><p>选择价格类型、出发日期</p></a>
        </li>
      </ul>
      
    </div>
    <div class="show-list-js">
      {loop $linedisc $v}
        {if $v['columnname']=='jieshao'}
          {if $row['isstyle']=='1'}
            {if (!empty($row[$v['columnname']]))}
          	<div class="list-con mt10">
            	<h3 class="tit">{$v['chinesename']}</h3>
            	<div class="txt">
              {$row[$v['columnname']]}
              </div>
            </div>
            {/if}
          {else}
            <div class="list-con mt10">
              <h3 class="tit">{$v['chinesename']}</h3>
                {loop $row['linejieshao_arr'] $v2}
                  <div class="day_con">
                    <div class="day_bg_num">{$v2['day']}</div>
                    <dl>
                      <dt>
                        <span>第{$v2['day']}天</span><em>{$v2['title']}</em>
                      </dt>
                      <dd>
                        <span class="line_item">用餐</span>
                        <div class="line_item_p">
                          <em>早餐：{if $v2['breakfirsthas'] =='1'}含{else}不含{/if}</em>
                          <em>中餐：{if $v2['lunchhas'] =='1'}含{else}不含{/if}</em>
                          <em>晚餐：{if $v2['supperhas'] =='1'}含{else}不含{/if}</em>
                        </div>
                      </dd>
                      <dd><span class="line_item">住宿</span><em>{$v2['hotel']}</em></dd>
                      <dd>
                        <span class="line_item">安排</span>
                        <div class="line_item_p">{$v2['jieshao']}</div>
                      </dd>
                    </dl>
                  </div>
              {/loop}
              
            </div>
          {/if}
        {else}
          {if (!empty($row[$v['columnname']]))}
            <div class="list-con mt10">
              <h3 class="tit">{$v['chinesename']}</h3>
              <div class="txt">
              {$row[$v['columnname']]}
              </div>
            </div>
            {/if}
        {/if}
      {/loop}
     
    </div>
    
  </div>
  
{template 'public/foot'}
<div class="opy"></div>
  <div class="bom_fix_box">
    <a class="cell_phone" href="tel:{$phone}">{$phone}</a>
    <a class="booking" href="{$cmsurl}lines/create/id/{$row['id']}">立即预定</a>
  </div>

</body>
<script>
    var mySwiper = new Swiper('.swiper1',{
    pagination: '.pagination',
    paginationClickable: true,
    slidesPerView: 'auto',
    autoplay:3000
  })
/*  $(function(){
       if($('.list-con img').length>0){
           var wp = $(window).width()-100;
           $('.list-con img').css('width', wp+'px' );
       }

   })*/


</script>
</html>

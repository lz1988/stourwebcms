<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
<title>{$seoinfo['seotitle']}-{$webname}</title>
<meta name="keywords" content="{$seoinfo['keyword']}" />
<meta name="description" content="{$seoinfo['description']}" />
 {php echo Common::getScript('jquery-min.js,idangerous.swiper.js'); }
 {php echo Common::getCss('m_base.css,style.css'); }
</head>

<body>
	{template 'public/top'}
  
  <div class="m-main">
    
    {if !empty($rows1)||!empty($rows2)}
    <div class="m_gl_list">
    	<h3>攻略-游记</h3>
      {if !empty($rows1)}
      <div class="swiper-container gl-container">
        <div class="swiper-wrapper">
          {loop $rows1 $v}
          <div class="swiper-slide gl-slide">
            <img src="{$v['litpic']}" width="250" height="100%" />
            <span>{$v['title']}</span>
          </div>
          {/loop}

        </div> 
      </div>
      {/if}
      {if !empty($rows2)}
      <!--攻略列表开始-->
      <ul class="mdd_gl_list">
      	{loop $rows2 $v}
        <li>
        <a href="{$cmsurl}raider/show/id/{$v['id']}">
          <h4>{$v['title']}</h4>
          <p>{$v['content']}</p>
        </a>
        </li>
        {/loop}
        <li><a href="/shouji/raider/list/" class="load-more"  page="1" />点击查看更多</a></li>
      </ul>
      {/if}

    </div>
    {/if}

    {loop $citylist $v}
    <div class="gl_list">
    	<h3>{$v['kindname']}-攻略<a href="{$cmsurl}raider/list/id/{$v['id']}">更多</a></h3>
      {loop $v['list'] $v2}
      <div class="pdt_list">
        <a href="{$cmsurl}raider/show/id/{$v2['id']}">
          <div class="pdt_img"><img src="{$v2['litpic']}" width="90" height="64"></div>
          <div class="pdt_txt">
            <div class="pdt_box">
              <p class="p_tit">
                <em>{$v2['title']}</em>
                <span>{$v2['content']}...</span>
              </p>
            </div>
          </div>
        </a>
      </div>
      {/loop}
    </div>
    {/loop}
   
   {if !empty($hotlist)} 
    <div class="hot-city">
    	<h3>热门城市攻略</h3>
      <p>
      {loop $hotlist $key $v}
        {if $key%4==0}
        </p>
        <p>
        {/if}
      	<a href="{$cmsurl}raider/list/id/{$v['id']}">{$v['kindname']}</a>
      {/loop}
      	
      </p>
    </div>
    {/if}

  </div>
  
  {template 'public/foot'}
<script>
		var mySwiper1 = new Swiper('.gl-container',{
		paginationClickable: true,
		slidesPerView: 'auto'
	})
  </script>
</body>
</html>

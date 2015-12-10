<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
<title>{if empty($row['seotitle'])}{$row['kindname']}{else}{$row['seotitle']}{/if}-{$webname}</title>
 <meta name="keywords" content="{$row['keyword']}" />
 <meta name="description" content="{$row['description']}" />
 {php echo Common::getScript('jquery-min.js,idangerous.swiper.js'); }
 {php echo Common::getCss('m_base.css,style.css'); }
</head>
<body>
  {template 'public/top'}
  <div class="city_top clearfix">
    <a class="back" href="{$cmsurl}mdd/index">返回</a>
    <a class="city_tit">{$row['kindname']}</a>
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
    <div class="mdd_jh">
      <p>
      {if $tj['article']>0}
        <a class="gl-ico" href="{$cmsurl}raider/list/id/{$row['id']}"><em></em>攻略<span>({$tj['article']})</span></a>
      {/if}
      {if $tj['lines']>0}
        <a class="xl-ico" href="{$cmsurl}lines/list/?kindid={$row['id']}"><em></em>线路<span>({$tj['lines']})</span></a>
      {/if}
      {if $tj['hotel']>0}
        <a class="jd-ico" href="{$cmsurl}hotels/list/?city={$row['id']}"><em></em>酒店<span>({$tj['hotel']})</span></a>
      {/if}
      </p>
      <p>
      {if $tj['car']>0}
        <a class="zc-ico" href="{$cmsurl}cars/list/kindid/{$row['id']}"><em></em>租车<span>({$tj['car']})</span></a>
      {/if}
      {if $tj['spot']>0}
        <a class="mp-ico" href="{$cmsurl}spot/list/?kindid={$row['id']}"><em></em>门票<span>({$tj['spot']})</span></a>
      {/if}
      {if $tj['photo']>0}
        <a class="xc-ico" href="{$cmsurl}photo/list/kindid/{$row['id']}"><em></em>相册<span>({$tj['photo']})</span></a>
      {/if}
      </p>
    </div>
    
    {if !empty($articlarr1)||!empty($articlarr2)}
    <div class="m_gl_list">
      <h3>{$row['kindname']}-攻略-游记</h3>
       {if !empty($articlarr1)}
      <div class="swiper-container gl-container">
        <div class="swiper-wrapper">
          {loop $articlarr1 $v}
          <div class="swiper-slide gl-slide">
            <img src="{$v['litpic']}" width="250" height="100%" />
            <span>{$v['title']}</span>
          </div>
          {/loop}
         
        </div> 
      </div>
      {/if}
      {if !empty($articlarr2)}
      <!--攻略列表开始-->
      <ul class="mdd_gl_list">
        {loop $articlarr2 $v}
        <li>
          <h4>{$v['title']}</h4>
          <p>{$v['content']}</p>
        </li>
        {/loop}
      </ul>
      {/if}
      <div class="list_more mt10">
        <a href="{$cmsurl}raider/list/id/{$row['id']}">点击查看更多&gt;&gt;</a>
      </div>
    </div>
    {/if}
    <div class="mdd_cp_list">
      <div class="tabs">
      {if !empty($lineslist)}
        <a href="#" {if $sts==1} class="active"{/if}>旅游路线</a>
      {/if}
      {if !empty($carlist)}
        <a href="#" {if $sts==2} class="active"{/if}>旅游租车</a>
      {/if}
      {if !empty($hotellist)}
        <a href="#" {if $sts==3} class="active"{/if}>优惠酒店</a>
      {/if}
      {if !empty($spotlist)}
        <a href="#" {if $sts==4} class="active"{/if}>景区门票</a>
      {/if}
      </div>
      <div class="swiper-container mdd-all">
        <div class="swiper-wrapper">
         {if !empty($lineslist)}
          <div class="swiper-slide">
            <div class="mdd_con">
              <p>
              {loop $lineslist $key $v}
              {if $key%2==0}
              </p>
              <p>
              {/if}
                <a href="{$cmsurl}lines/show/id/{$v['id']}">
                  <em>{if $v['lineprice']==0}电询{else}&yen;{$v['lineprice']}{/if}</em>
                  <img src="{$v['litpic']}" alt="" width="140" height="100">
                  <span>{$v['linename']}</span>
                </a>
              {/loop}
              </p>
            </div>
            <div class="list_more mt10">
              <a href="{$cmsurl}lines/list/?kindid={$row['id']}">点击查看更多&gt;&gt;</a>
            </div>
          </div>
        {/if}
        {if !empty($carlist)}
          <div class="swiper-slide">
            <div class="mdd_con">
              <p>
                {loop $carlist $key $v}
                {if $key%2==0}
                </p>
                <p>
                {/if}
                  <a href="{$cmsurl}cars/show/id/{$v['id']}">
                    <em>{if $v['price']==0}电询{else}&yen;{$v['price']}{/if}</em>
                    <img src="{$v['litpic']}" alt="" width="140" height="100">
                    <span>{$v['title']}</span>
                  </a>
                {/loop}
              </p>
            </div>
            <div class="list_more mt10">
              <a href="{$cmsurl}cars/list/kindid/{$row['id']}">点击查看更多&gt;&gt;</a>
            </div>
          </div>
        {/if}
        {if !empty($hotellist)}
          <div class="swiper-slide">
            <div class="mdd_con">
              <p>
               {loop $hotellist $key $v}
               {if $key%2==0}
                </p>
                <p>
                {/if}
                  <a href="{$cmsurl}hotels/show/id/{$v['id']}">
                    <em>{if $v['price']==0}电询{else}&yen;{$v['price']}{/if}</em>
                    <img src="{$v['litpic']}" alt="" width="140" height="100">
                    <span>{$v['hotelname']}</span>
                  </a>
                {/loop}
              </p>
            </div>
            <div class="list_more mt10">
              <a href="{$cmsurl}hotels/list/?city={$row['id']}">点击查看更多&gt;&gt;</a>
            </div>
          </div>
        {/if}
        {if !empty($spotlist)}
          <div class="swiper-slide">
            <div class="mdd_con">
              <p>
                {loop $spotlist $key $v}
               {if $key%2==0}
                </p>
                <p>
                {/if}
                  <a href="{$cmsurl}spot/show/id/{$v['id']}">
                    <em>{if $v['price']==0}电询{else}&yen;{$v['price']}{/if}</em>
                    <img src="{$v['litpic']}" alt="" width="140" height="100">
                    <span>{$v['title']}</span>
                  </a>
                {/loop}
              </p>
            </div>
            <div class="list_more mt10">
              <a href="{$cmsurl}spot/list/?kindid={$row['id']}">点击查看更多&gt;&gt;</a>
            </div>
          </div>
        {/if}
        </div>
      </div>
    </div>
    
    {if !empty($photolist)}
    <div class="m_xc_list">
      <h3>风景相册</h3>
      <div class="xc_con">
        <p>
        {loop $photolist $key $v}
           {if $key%2==0}
            </p>
            <p>
            {/if}
          <a href="{$cmsurl}spot/show/id/{$v['id']}">
            <img src="{$v['litpic']}" alt="" width="145" height="100">
            <span>{$v['title']}</span>
          </a>
          {/loop}
         
        </p>
      </div>
      <div class="list_more mt10">
        <a href="{$cmsurl}photo/list/kindid/{$row['id']}">点击查看更多&gt;&gt;</a>
      </div>
    </div>
  </div>
  {/if}
  
 {template 'public/foot'}
<script>
    var mySwiper = new Swiper('.swiper1',{
    pagination: '.pagination',
    paginationClickable: true,
    slidesPerView: 'auto',
    autoplay:3000
  })
    var mySwiper1 = new Swiper('.gl-container',{
    paginationClickable: true,
    slidesPerView: 'auto'
  })
  var tabsSwiper = new Swiper('.mdd-all',{
    speed:500,
    onSlideChangeStart: function(){
      $(".tabs .active").removeClass('active')
      $(".tabs a").eq(tabsSwiper.activeIndex).addClass('active')  
    }
  })
  $(".tabs a").on('touchstart mousedown',function(e){
    e.preventDefault()
    $(".tabs .active").removeClass('active')
    $(this).addClass('active')
    tabsSwiper.swipeTo( $(this).index() )
  })
  $(".tabs a").click(function(e){
    e.preventDefault()
  })
  </script>
</body>
</html>

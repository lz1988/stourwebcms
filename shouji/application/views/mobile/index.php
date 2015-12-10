<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
<title>{$seotitle}-{$webname}</title>
    <meta name="keywords" content="{$keyword}" />
    <meta name="author" content="{$webname}" />
    <meta name="description" content="{$description}" />
 {php echo Common::getScript('jquery-min.js,idangerous.swiper.js'); }
 {php echo Common::getCss('m_base.css,index.css'); }
 
</head>

<body>
	{template 'public/top'}
  <div class="main_page clearfix">
  
  	<!--首页滚动图片-->
    <div class="home-device">
      <div class="swiper-main">
        <div class="swiper-container swiper1">
          <div class="swiper-wrapper">
           {st:ad action="getrollad" name="MobileIndexRollAd"}
              {loop $data $v}
                 <div class="swiper-slide"> <a href="{$v['linkurl']}"><img src="{$v['picurl']}" width="320" height="200" /></a> </div>
              {/loop}
           {/st}
          </div>
        </div>
      </div>
      <div class="pagination pagination1"></div>
    </div>
    
    <div class="search_home clearfix">
       <form method="post" action="{$cmsurl}search/index" onsubmit="return check();">
    	<input type="text" class="h_txt" id="keyword" name="keyword" value="" placeholder="搜索关键词" />
    	<input type="submit" class="h_btn" value="&nbsp;" />
       </form>
    </div>
    
    <div class="home_menu">
    	<p>
      	<a class="mdd_ico" href="{$cmsurl}mdd/index"><em></em>目的地</a>
        <a class="xl_ico" href="{$cmsurl}lines/index"><em></em>线路</a>
        <a class="mp_ico" href="{$cmsurl}spot/index"><em></em>景点门票</a>
      </p>
      <p>
      	<a class="jd_ico" href="{$cmsurl}hotels/index"><em></em>酒店</a>
        <a class="zc_ico" href="{$cmsurl}cars/index"><em></em>租车</a>
        <a class="qz_ico" href="{$cmsurl}visa/index"><em></em>签证</a>
      </p>
      <p>
      	<a class="tg_ico" href="{$cmsurl}tuan/index"><em></em>团购</a>
        <a class="xc_ico" href="{$cmsurl}photo/index"><em></em>相册</a>
        <a class="gl_ico" href="{$cmsurl}raider/index"><em></em>攻略</a>
      </p>
    </div>
    
    <div class="pdt_con">
    	<div class="xl_tit clearfix"><h3>本季热推 /</h3> Tour</div>
        {st:line  action="getline" row="10" flag="byorder"}
            {loop $data $k $v}
                    <div class="pdt_list">
                        <a href="{$v['url']}">
                            <div class="pdt_img"><img src="{$v['litpic']}" width="90" height="64"></div>
                            <div class="pdt_txt">
                                <div class="pdt_box">
                                    <p class="p_tit">{$v['title']}...</p>
                                    <p class="p_pir"> {if empty($v['lineprice'])}
                                        <strong>电询</strong>
                                        {else}
                                        <strong>&yen;{$v['lineprice']}</strong>
                                        {/if}<span>满意度{$v['satisfyscore']}</span></p>
                                </div>
                            </div>
                        </a>
                    </div>
            {/loop}
        {/st}
      <div class="ck_more">
      	<a href="{$cmsurl}lines/list/kindid/0">点击查看更多&gt;&gt;</a>
      </div>
    </div>
    
  </div>
  
  {template 'public/foot'}

<script>
		var mySwiper = new Swiper('.swiper1',{
        pagination: '.pagination',
		paginationClickable: true,
		slidesPerView: 'auto',
		autoplay:3000
	})
    function check()
    {
        var keyword = $("#keyword").val();
        if(keyword==''){
            alert("请输入目的地");
            return false;
        }
        return true;
    }
</script>
</body>
</html>

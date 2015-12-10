<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
<title>{$seoinfo['seotitle']}-{$webname}</title>
<meta name="keywords" content="{$seoinfo['keyword']}" />
<meta name="description" content="{$seoinfo['description']}" />
{php echo Common::getCss('m_base.css,style.css'); }
{php echo Common::getScript('jquery-min.js,st_m.js'); }
</head>

<body>
  {template 'public/top'}
	<div class="city_top clearfix">
  	<a class="back" href="{$cmsurl}hotels/index">返回</a>
    <a class="city_tit">{$cityname}-酒店</a>
  </div>
  
  <div class="m-main">
		<section class="main-xl">
			<div class="change-type">
		  	<div class="posfex">
        	<ul id="des_w">
						<li id="des"><a href="javascript:;" >{$cityname}</a></li>
						<li id="des-day"><a href="javascript:;">{$typename}</a></li>
						<li class="no-line" id="des-by"><a href="javascript:;">{$pricename}</a></li>
					</ul>
        </div>

				<!--下拉列表-->
        <div id="des_con">
          <div class="change-type-c" id="des-c">
             <input type="hidden" name="city" id="city" value="{intval($city)}" />
              <p><a href="{$cmsurl}hotels/list/?city=0&star={intval($star)}&price={intval($price)}&key={$key}&order={$order}">不限</a></p>
            {loop $kindlist $v1}
              {if $v1['id']==$city}
                <p class="on"><a href="{$cmsurl}hotels/list/?city={$v1['id']}&star={intval($star)}&price={intval($price)}&key={$key}&order={$order}">{$v1['kindname']}</a></p>
              {else}
                <p ><a href="{$cmsurl}hotels/list/?city={$v1['id']}&star={intval($star)}&price={intval($price)}&key={$key}&order={$order}">{$v1['kindname']}</a></p>
              {/if}
            {/loop}
          </div>
          <div class="change-type-c" id="des-day-c">
             <input type="hidden" name="star" id="star" value="{intval($star)}" />
              <p><a href="{$cmsurl}hotels/list/?city={intval($city)}&star=0&price={intval($price)}&key={$key}&order={$order}">不限</a></p>
            {loop $typelist $v1}
              {if $v1['id']==$star}
                <p class="on"><a href="{$cmsurl}hotels/list/?city={intval($city)}&star={$v1['id']}&price={intval($price)}&key={$key}&order={$order}">{$v1['hotelrank']}</a></p>
              {else}
                <p ><a href="{$cmsurl}hotels/list/?city={intval($city)}&star={$v1['id']}&price={intval($price)}&key={$key}&order={$order}">{$v1['hotelrank']}</a></p>
              {/if}
            {/loop}
          </div>
					<div class="change-type-c" id="des-by-c">
             <input type="hidden" name="price" id="price" value="{intval($price)}" />
              <p><a href="{$cmsurl}hotels/list/?city={intval($city)}&star={intval($star)}&price=0&key={$key}&order={$order}">不限</a></p>
            {loop $pricelist $v1}
              {if $v1['id']==$price}
                <p class="on"><a href="{$cmsurl}hotels/list/?city={intval($city)}&star={intval($star)}&price={$v1['id']}&key={$key}&order={$order}">{intval($v1['min'])}-{intval($v1['max'])}</a></p>
              {else}
                <p ><a href="{$cmsurl}hotels/list/?city={intval($city)}&star={intval($star)}&price={$v1['id']}&key={$key}&order={$order}">{intval($v1['min'])}-{intval($v1['max'])}</a></p>
              {/if}
            {/loop}
					</div>
        </div>
        
        <div class="df_px">
        	<span class="sp_1">默认排序</span>
          <input type="hidden" name="order" id="order" value="{$order}" />
          <span class="sp_2">
            <em>价格</em>
            <a class="up" href="{$cmsurl}hotels/list/city/{intval($city)}&star={intval($star)}&price={intval($price)}&key={$key}&order=asc"></a>
            <a class="down" href="{$cmsurl}hotels/list/city/{intval($city)}&star={intval($star)}&price={intval($price)}&key={$key}&order=desc"></a>
          </span>
        </div>
        
        <div class="fex">
        	<!--list开始-->
          {loop $list $v}
					<div class="pdt_list">
            <a href="{$cmsurl}hotels/show/id/{$v['id']}">
              <div class="pdt_img"><img src="{$v['litpic']}" width="90" height="64"></div>
              <div class="pdt_txt">
                <div class="pdt_box">
                  <p class="p_tit">
                  	<em>{$v['title']}</em>
                    <span class="star">{$v['randname']}</span>
                    <span class="mt5">优惠价：{if intval($v['price'])>0}<b>&yen;{$v['price']}</b>起{else}<b>电询</b>{/if}</span>
                  </p>
                </div>
              </div>
            </a>
          </div>
          {/loop}
          
          <!--list结束-->
					
				</div>
          <div class="load_more"><img src="../images/loading.gif" />正在载入中</div>
          <input type="hidden" value="{$key}" id="key"/>
          <a href="javascript:void();" class="load-more"  page="1"/>点击载入更多<a>
			</div>
		</section>
	</div>
  
  {template 'public/foot'}

</body>
<script type="text/javascript">
$('.load-more').click(function(){
        var docRec = $(this);
        var page = parseInt(docRec.attr('page'))+1;
        var city = $('#city').val();
        var star = $('#star').val();
        var price = $('#price').val();
        var order = $('#order').val();
        var key = $('#key').val();
        var url='/shouji/hotels/list/?city='+city;
         $.get(url+'&star='+star+'&price='+price+'&key='+encodeURIComponent(key)+'&action=ajaxline&page='+page+'&order='+order,function(results){
            eval('results='+results);
            var str = '';
            var listnum = 0;
            for(a in results){
                var temprice = '<b>电询</b>';
                if(results[a]['price']>0){
                  temprice = '<b>&yen;'+results[a]['price']+'</b> 起';
                }
               str +=  '<div class="pdt_list"><a href="{$cmsurl}hotels/show/id/'+results[a]['id']+'"><div class="pdt_img"><img src="'+results[a]['litpic']+'" width="90" height="64"></div><div class="pdt_txt"><div class="pdt_box"><p class="p_tit"><em>'+results[a]['title']+'</em><span class="star">'+results[a]['randname']+'</span><span class="mt5">优惠价：'+temprice+'</span></p></div></div></a></div>';
               
                listnum++;
            }
            docRec.attr('page',page);
            if(listnum==0){
              docRec.html('已无更多酒店信息');
            }
            $('.fex').append(str);
        });
    });
</script>
</html>

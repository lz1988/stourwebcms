<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
<title>{$seoinfo['seotitle']}-{$webname}</title>
<meta name="keywords" content="{$seoinfo['keyword']}" />
<meta name="description" content="{$seoinfo['description']}" />
 {php echo Common::getScript('jquery-min.js,st_m.js'); }
 {php echo Common::getCss('m_base.css,style.css'); }
</head>

<body>
  {template 'public/top'}
	<div class="city_top clearfix">
  	<a class="back" href="{$cmsurl}lines/index">返回</a>
    <a class="city_tit">{$kindname}-线路</a>
  </div>
  <div class="m-main">
		<section class="main-xl">
			<div class="change-type">
		  	<div class="posfex">
        	<ul id="des_w">
						<li id="des"><a href="javascript:;" >{$kindname}</a></li>
						<li id="des-day"><a href="javascript:;">{$daysname}</a></li>
						<li id="des-type"><a href="javascript:;">{$travelname}</a></li>
						<li class="no-line" id="des-by"><a href="javascript:;">{$pricename}</a></li>
					</ul>
        </div>

				<!--下拉列表-->
        <div id="des_con">
          <div class="change-type-c" id="des-c">
          	<input type="hidden" name="kindid" id="kindid" value="{intval($kindid)}" />
              <p><a href="{$cmsurl}lines/list/?kindid=0&days={intval($days)}&attrid={intval($attrid)}&pricetyle={intval($pricetyle)}&order={$order}">不限</a></p>
            {loop $kindlist $v1}
              {if $v1['id']==$kindid}
                <p class="on"><a href="{$cmsurl}lines/list/?kindid={$v1['id']}&days={intval($days)}&attrid={intval($attrid)}&pricetyle={intval($pricetyle)}&order={$order}">{$v1['kindname']}</a></p>
              {else}
                <p ><a href="{$cmsurl}lines/list/?kindid={$v1['id']}&days={intval($days)}&attrid={intval($attrid)}&pricetyle={intval($pricetyle)}&order={$order}">{$v1['kindname']}</a></p>
              {/if}
            {/loop}
          </div>
          <div class="change-type-c" id="des-day-c">
          <input type="hidden" name="days" id="days" value="{intval($days)}" />
             <p><a href="{$cmsurl}lines/list/?kindid={$kindid}&days=0&attrid={intval($attrid)}&pricetyle={intval($pricetyle)}&order={$order}">不限</a></p>
            {loop $dayslist $v2}
              {if $v2['word']==$days}
                <p class="on"><a href="{$cmsurl}lines/list/?kindid={$kindid}&days={$v2['word']}&attrid={intval($attrid)}&pricetyle={intval($pricetyle)}&order={$order}">{$v2['word']}日游</a></p>
              {else}
                <p ><a href="{$cmsurl}lines/list/?kindid={$kindid}&days={$v2['word']}&attrid={intval($attrid)}&pricetyle={intval($pricetyle)}&order={$order}">{$v2['word']}日游</a></p>
              {/if}
            {/loop}
          </div>
          <div class="change-type-c" id="des-type-c">
          <input type="hidden" name="attrid" id="attrid" value="{intval($attrid)}" />
           <p><a href="{$cmsurl}lines/list/?kindid={$kindid}&days={intval($days)}&attrid=0&pricetyle={intval($pricetyle)}&order={$order}">不限</a></p>
            {loop $attrlist $v3}
              {if $v3['id']==$attrid}
                <p class="on"><a href="{$cmsurl}lines/list/?kindid={$kindid}&days={intval($days)}&attrid={$v3['id'])}&pricetyle={intval($pricetyle)}&order={$order}">{$v3['attrname']}</a></p>
              {else}
                <p ><a href="{$cmsurl}lines/list/?kindid={$kindid}&days={intval($days)}&attrid={$v3['id']}&pricetyle={intval($pricetyle)}&order={$order}">{$v3['attrname']}</a></p>
              {/if}
            {/loop}
          </div>
            <div class="change-type-c" id="des-by-c">
            <input type="hidden" name="pricetyle" id="pricetyle" value="{intval($pricetyle)}" />
             <p><a href="{$cmsurl}lines/list/?kindid={$kindid}&days={intval($days)}&attrid={intval($attrid)}&pricetyle=0&order={$order}">不限</a></p>
            {loop $pricelist $v4}
              {if $v4['id']==$pricetyle}
                <p class="on"><a href="{$cmsurl}lines/list/?kindid={$kindid}&days={intval($days)}&attrid={intval($attrid)}&pricetyle={$v4['id']}&order={$order}">{intval($v4['lowerprice'])}-{intval($v4['highprice'])}</a></p>
              {else}
                <p ><a href="{$cmsurl}lines/list/?kindid={$kindid}&days={intval($days)}&attrid={intval($attrid)}&pricetyle={$v4['id']}&order={$order}">{intval($v4['lowerprice'])}-{intval($v4['highprice'])}</a></p>
              {/if}
            {/loop}
					</div>
        </div>

        <div class="df_px">
        <span class="sp_1">默认排序</span>
        <input type="hidden" name="order" id="order" value="{$order}" />
          <span class="sp_2">
          <em>价格</em>
            <a class="{if $order=='asc'}upon{else}up{/if} {$order}" href="{$cmsurl}lines/list/?kindid={$kindid}&days={intval($days)}&attrid={intval($attrid)}&pricetyle={intval($pricetyle)}&order=asc"></a>
            <a class="{if $order=='desc'}downon{else}down{/if} {$order}" href="{$cmsurl}lines/list/?kindid={$kindid}&days={intval($days)}&attrid={intval($attrid)}&pricetyle={intval($pricetyle)}&order=desc"></a>
          </span>
        </div>

        <div class="fex">
        {loop $list $v}
        	<!--list开始-->
					<div class="pdt_list">
            <a href="{$cmsurl}lines/show/id/{$v['id']}">
              <div class="pdt_img"><img src="{$v['litpic']}" width="90" height="64"></div>
              <div class="pdt_txt">
                <div class="pdt_box">
                  <p class="p_tit">{$v['title']}...</p>
                  <p class="p_pir">
                  {if $v['lineprice']==0}
                  <strong>电询</strong>
                  {else}
                  <strong>&yen;{$v['lineprice']}</strong>
                  {/if}
                  <span>满意度{if empty($v['satisfyscore'])}{$v['satisfyscore']}{else}{$v['satisfyscore']}%{/if}</span></p>
                </div>
              </div>
            </a>
          </div>
          {/loop}
          
          <!--list结束-->
					
				</div>
        <div class="load_more"><img src="../images/loading.gif" />正在载入中</div>
          <input type="hidden" name="key" id="key" value="{if empty($key)}0{else}{$key}{/if}" />
          <a href="javascript:;" class="load-more"  page="1" />点击载入更多<a>
			</div>
		</section>
	</div>
  
{template 'public/foot'}
</body>
<script type="text/javascript">
$('.load-more').click(function(){
        var docRec = $(this);
        var page = parseInt(docRec.attr('page'))+1;
        var kindid = $('#kindid').val();
        var days = $('#days').val();
        var key = $('#key').val();
        var attrid = $('#attrid').val();
        var pricetyle = $('#pricetyle').val();
        var order = $('#order').val();
        var url='/shouji/lines/list/?kindid='+kindid+'&days='+days+'&attrid='+attrid+'&pricetyle='+pricetyle+'&key='+key+'&action=ajaxline&page='+page+'&order='+order;
         $.get(url,function(results){
            eval('results='+results);
            var str = '';
            var listnum = 0;
            for(a in results){
                var temprice = '电询';
                if(results[a]['lineprice']>0){
                  temprice = '&yen;'+results[a]['lineprice'];
                }
                str += '<div class="pdt_list"><a href="{$cmsurl}lines/show/id/'+results[a]['id']+'"><div class="pdt_img"><img src="'+results[a]['litpic']+'" width="90" height="64"></div><div class="pdt_txt"><div class="pdt_box"><p class="p_tit">'+results[a]['title']+'...</p><p class="p_pir"><strong>'+temprice+'</strong><span>满意度'+results[a]['satisfyscore']+'</span></p></div></div></a></div>';
                listnum++;

            }
            docRec.attr('page',page);
            if(listnum==0){
              docRec.html('已无更多线路');
            }
            $('.fex').append(str);
        });
    });
</script>
</html>

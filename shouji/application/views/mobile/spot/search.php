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
  	<a class="back" href="{$cmsurl}spot/index">返回</a>
    <a class="city_tit">{$cityname}-门票</a>
  </div>
  
  <div class="m-main">
		<section class="main-xl">
			<div class="change-type">
		  	<div class="posfex">
        	<ul id="des_w">
						<li id="des"><a href="javascript:;" >{$cityname}</a></li>
						<li id="des-day"><a href="javascript:;">{$travelname}</a></li>
						<li id="des-type"><a href="javascript:;">{$starname}</a></li>
						<li class="no-line" id="des-by"><a href="javascript:;">{$pricename}</a></li>
					</ul>
        </div>

				<!--下拉列表-->
        <div id="des_con">
          <div class="change-type-c" id="des-c">
            <input type="hidden" name="kindid" id="kindid" value="{intval($kindid)}" />
              <p><a href="{$cmsurl}spot/list/?kindid=0&starid={intval($starid)}&attrid={intval($attrid)}&pricetyle={intval($pricetyle)}&order={$order}">不限</a></p>
            {loop $kindlist $v1}
              {if $v1['id']==$kindid}
                <p class="on"><a href="{$cmsurl}spot/list/?kindid={$v1['id']}&starid={intval($starid)}&attrid={intval($attrid)}&pricetyle={intval($pricetyle)}&order={$order}">{$v1['kindname']}</a></p>
              {else}
                <p ><a href="{$cmsurl}spot/list/?kindid={$v1['id']}&starid={intval($starid)}&attrid={intval($attrid)}&pricetyle={intval($pricetyle)}&order={$order}">{$v1['kindname']}</a></p>
              {/if}
            {/loop}
          </div>
          <div class="change-type-c" id="des-type-c">
           <input type="hidden" name="attrid" id="attrid" value="{intval($attrid)}" />
           <p><a href="{$cmsurl}spot/list/?kindid={$kindid}&starid={intval($starid)}&attrid=0&pricetyle={intval($pricetyle)}&order={$order}">不限</a></p>
            {loop $attrlist $v3}
              {if $v3['id']==$attrid}
                <p class="on"><a href="{$cmsurl}spot/list/?kindid={$kindid}&starid={intval($starid)}&attrid={$v3['id'])}&pricetyle={intval($pricetyle)}&order={$order}">{$v3['attrname']}</a></p>
              {else}
                <p ><a href="{$cmsurl}spot/list/?kindid={$kindid}&starid={intval($starid)}&attrid={$v3['id']}&pricetyle={intval($pricetyle)}&order={$order}">{$v3['attrname']}</a></p>
              {/if}
            {/loop}
          </div>
          <div class="change-type-c" id="des-day-c">
             <input type="hidden" name="starid" id="starid" value="{intval($starid)}" />
             <p><a href="{$cmsurl}spot/list/?kindid={$kindid}&starid=0&attrid={intval($attrid)}&pricetyle={intval($pricetyle)}&order={$order}">不限</a></p>
            {loop $starlist $v2}
              {if $v2['id']==$starid}
                <p class="on"><a href="{$cmsurl}spot/list/?kindid={$kindid}&starid={$v2['id']}&attrid={intval($attrid)}&pricetyle={intval($pricetyle)}&order={$order}">{$v2['attrname']}</a></p>
              {else}
                <p ><a href="{$cmsurl}spot/list/?kindid={$kindid}&starid={$v2['id']}&attrid={intval($attrid)}&pricetyle={intval($pricetyle)}&order={$order}">{$v2['attrname']}</a></p>
              {/if}
            {/loop}
          </div>
					<div class="change-type-c" id="des-by-c">
            <input type="hidden" name="pricetyle" id="pricetyle" value="{intval($pricetyle)}" />
             <p><a href="{$cmsurl}spot/list/?kindid={$kindid}&starid={intval($starid)}&attrid={intval($attrid)}&pricetyle=0&order={$order}">不限</a></p>
            {loop $pricelist $v4}
              {if $v4['id']==$pricetyle}
                <p class="on"><a href="{$cmsurl}spot/list/?kindid={$kindid}&starid={intval($starid)}&attrid={intval($attrid)}&pricetyle={$v4['id']}&order={$order}">{intval($v4['min'])}-{intval($v4['max'])}</a></p>
              {else}
                <p ><a href="{$cmsurl}spot/list/?kindid={$kindid}&starid={intval($starid)}&attrid={intval($attrid)}&pricetyle={$v4['id']}&order={$order}">{intval($v4['min'])}-{intval($v4['max'])}</a></p>
              {/if}
            {/loop}
					</div>
        </div>
        
        <div class="df_px">
        	<span class="sp_1">默认排序</span>
          <input type="hidden" name="order" id="order" value="{$order}" />
          <span class="sp_2">
          	<em>价格</em>
            <a class="up" href="{$cmsurl}spot/list/?kindid={$kindid}&starid={intval($starid)}&attrid={intval($attrid)}&pricetyle={intval($pricetyle)}&order=asc"></a>
            <a class="down" href="{$cmsurl}spot/list/?kindid={$kindid}&starid={intval($starid)}&attrid={intval($attrid)}&pricetyle={intval($pricetyle)}&order=desc"></a>
          </span>
        </div>
        
        <div class="fex">
        	<!--list开始-->
          {loop $list $vli}
  					<div class="pdt_list">
              <a href="{$cmsurl}spot/show/id/{$vli['id']}">
                <div class="pdt_img"><img src="{$vli['litpic']}" width="90" height="64"></div>
                <div class="pdt_txt">
                  <div class="pdt_box">
                    <p class="p_tit">
                    	<em>{$vli['title']}</em>
                      <span>{$vli['attrname']}</span>
                    </p>
                    <p class="p_pir">
                    {if $vli['price']==0}
                  <strong>电询</strong>
                  {else}
                  <strong>&yen;{$vli['price']}</strong>
                  {/if}
                  <span>满意度{$vli['satisfyscore']}</span></p>
                  </div>
                </div>
              </a>
            </div>
          {/loop}

          <!--list结束-->
					
				</div>
        <div class="load_more"><img src="../images/loading.gif" />正在载入中</div>
        <input type="hidden" id="key" value="{$key}">
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
        var kindid = $('#kindid').val();
        var starid = $('#starid').val();
        var attrid = $('#attrid').val();
        var pricetyle = $('#pricetyle').val();
        var order = $('#order').val();
        var key = $('#key').val();
        var url='/shouji/spot/list/?kindid='+kindid;
        if(key!=''){
            url = url+'/key/'+encodeURIComponent(key);
        }
         $.get(url+'&starid='+starid+'&attrid='+attrid+'&pricetyle='+pricetyle+'&action=ajaxline&page='+page+'&order='+order,function(results){
            eval('results='+results);
            var str = '';
            var listnum = 0;
            for(a in results){
                var temprice = '电询';
                if(results[a]['price']>0){
                  temprice = '&yen;'+results[a]['price'];
                }
                str += '<div class="pdt_list"><a href="{$cmsurl}spot/show/id/'+results[a]['id']+'"><div class="pdt_img"><img src="'+results[a]['litpic']+'" width="90" height="64"></div><div class="pdt_txt"><div class="pdt_box"><p class="p_tit"><em>'+results[a]['title']+'</em><span>'+results[a]['attrname']+'</span></p><p class="p_pir"><strong>'+temprice+'</strong><span>满意度'+results[a]['satisfyscore']+'</span></p></div></div></a></div>';
                listnum++;

            }
            docRec.attr('page',page);
            if(listnum==0){
              docRec.html('已无更多门票信息');
            }
            $('.fex').append(str);
        });
    });
</script>
</html>

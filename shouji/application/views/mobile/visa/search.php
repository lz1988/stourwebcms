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
  	<a class="back" href="{$cmsurl}visa/index">返回</a>
    <a class="city_tit">{$idname}-签证</a>
  </div>
  
  <div class="m-main">
		<section class="main-xl">
			<div class="change-type">
		  	<div class="posfex">
        	<ul id="des_w">
						<li id="des"><a href="javascript:;" >{$idname}</a></li>
						<li id="des-day"><a href="javascript:;">{$typename}</a></li>
						<li class="no-line" id="des-by"><a href="javascript:;">{$cityname}</a></li>
					</ul>
        </div>

				<!--下拉列表-->
        <div id="des_con">
          <div class="change-type-c" id="des-c">
            <input type="hidden" name="kindid" id="kindid" value="{intval($kindid)}" />
              <p><a href="{$cmsurl}visa/list/id/0/kind/{intval($kind)}/city/{intval($city)}/order/{$order}">不限</a></p>
            {loop $area $v1}
              {if $v1['id']==$kindid}
                <p class="on"><a href="{$cmsurl}visa/list/id/{$v1['id']}/kind/{intval($kind)}/city/{intval($city)}/order/{$order}">{$v1['kindname']}</a></p>
              {else}
                <p ><a href="{$cmsurl}visa/list/id/{$v1['id']}/kind/{intval($kind)}/city/{intval($city)}/order/{$order}">{$v1['kindname']}</a></p>
              {/if}
            {/loop}
          </div>
          <div class="change-type-c" id="des-day-c">
             <input type="hidden" name="kind" id="kind" value="{intval($kind)}" />
              <p><a href="{$cmsurl}visa/list/id/{intval($kindid)}/kind/0/city/{intval($city)}/order/{$order}">不限</a></p>
            {loop $visatype $v1}
              {if $v1['id']==$kind}
                <p class="on"><a href="{$cmsurl}visa/list/id/{intval($kindid)}/kind/{$v1['id']}/city/{intval($city)}/order/{$order}">{$v1['kindname']}</a></p>
              {else}
                <p ><a href="{$cmsurl}visa/list/id/{intval($kindid)}/kind/{$v1['id']}/city/{intval($city)}/order/{$order}">{$v1['kindname']}</a></p>
              {/if}
            {/loop}
          </div>
					<div class="change-type-c" id="des-by-c">
             <input type="hidden" name="city" id="city" value="{intval($city)}" />
              <p><a href="{$cmsurl}visa/list/id/{intval($kindid)}/kind/{intval($kind)}/city/0/order/{$order}">不限</a></p>
              {loop $visacity $v1}
                {if $v1['id']==$city}
                  <p class="on"><a href="{$cmsurl}visa/list/id/{intval($kindid)}/kind/{intval($kind)}/city/{$v1['id']}/order/{$order}">{$v1['kindname']}</a></p>
                {else}
                  <p ><a href="{$cmsurl}visa/list/id/{intval($kindid)}/kind/{intval($kind)}/city/{$v1['id']}/order/{$order}">{$v1['kindname']}</a></p>
                {/if}
              {/loop}
					</div>
        </div>
        
        <div class="df_px">
        	<span class="sp_1">默认排序</span>
          <input type="hidden" name="order" id="order" value="{$order}" />
          <span class="sp_2">
            <em>价格</em>
            <a class="up" href="{$cmsurl}visa/list/id/{intval($kindid)}/kind/{intval($kind)}/city/{intval($city)}/order/asc"></a>
            <a class="down" href="{$cmsurl}visa/list/id/{intval($kindid)}/kind/{intval($kind)}/city/{intval($city)}/order/desc"></a>
          </span>
        </div>
        
        <div class="fex">
        	<!--list开始-->
          {loop $list $v}
					<div class="pdt_list">
            <a href="{$cmsurl}visa/show/id/{$v['id']}">
              <div class="pdt_img"><img src="{$v['litpic']}" width="90" height="64"></div>
              <div class="pdt_txt">
                <div class="pdt_box">
                  <p class="p_tit">
                  	<em>{$v['title']}</em>
                    <span>{$v['content']}</span>
                  </p>
                  <p class="p_pir"><strong>{if $v['price']>0}&yen;{$v['price']}{else}电询{/if}</strong><span>满意度{$v['satisfyscore']}</span></p>
                </div>
              </div>
            </a>
          </div>
          {/loop}
         
          <!--list结束-->
					
				</div>
        <div class="load_more"><img src="../images/loading.gif" />正在载入中</div>
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
        var kind = $('#kind').val();
        var city = $('#city').val();
        var order = $('#order').val();
         $.get('/shouji/visa/list/id/'+kindid+'/kind/'+kind+'/city/'+city+'/action/ajaxline/page/'+page+'/order/'+order,function(results){
            eval('results='+results);
            var str = '';
            var listnum = 0;
            for(a in results){
                var temprice = '电询';
                if(results[a]['price']>0){
                  temprice = '&yen;'+results[a]['price'];
                }
                str += '<div class="pdt_list"><a href="{$cmsurl}visa/show/id/'+results[a]['id']+'"><div class="pdt_img"><img src="'+results[a]['litpic']+'" width="90" height="64"></div><div class="pdt_txt"><div class="pdt_box"><p class="p_tit"><em>'+results[a]['title']+'</em><span>'+results[a]['content']+'</span></p><p class="p_pir"><strong>'+temprice+'</strong><span>满意度'+results[a]['satisfyscore']+'</span></p></div></div></a></div>';
                listnum++;

            }
            docRec.attr('page',page);
            if(listnum==0){
              docRec.html('已无更多签证信息');
            }
            $('.fex').append(str);
        });
    });
</script>
</html>

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
  	<a class="back" href="{$cmsurl}raider/index">返回</a>
    <a class="city_tit">{$kindname}-攻略</a>
  </div>
  
  <div class="m-main">
		<section class="main-xl">
			<div class="change-type">
		  	<div class="posfex">
        	<ul id="des_w">
						<li id="des"><a href="javascript:;" >{$kindname}</a></li>
						<li id="des-day"><a href="javascript:;">{$attrname}</a></li>
					</ul>
        </div>

				<!--下拉列表-->
        <div id="des_con">
          <div class="change-type-c" id="des-c">
           <input type="hidden" name="kindid" id="kindid" value="{intval($kindid)}" />
              <p><a href="{$cmsurl}raider/list/id/0/attrid/{intval($attrid)}/order/{$order}">不限</a></p>
            {loop $kindlist $v1}
              {if $v1['id']==$kindid}
                <p class="on"><a href="{$cmsurl}raider/list/id/{$v1['id']}/attrid/{intval($attrid)}/order/{$order}">{$v1['kindname']}</a></p>
              {else}
                <p ><a href="{$cmsurl}raider/list/id/{$v1['id']}/attrid/{intval($attrid)}/order/{$order}">{$v1['kindname']}</a></p>
              {/if}
            {/loop}
          </div>
          <div class="change-type-c" id="des-day-c">
            <input type="hidden" name="attrid" id="attrid" value="{intval($attrid)}" />
             <p><a href="{$cmsurl}raider/list/id/{$kindid}/attrid/0/order/{$order}">不限</a></p>
            {loop $attrlist $v3}
              {if $v3['id']==$attrid}
                <p class="on"><a href="{$cmsurl}raider/list/id/{$kindid}/attrid/{$v3['id'])}/order/{$order}">{$v3['attrname']}</a></p>
              {else}
                <p ><a href="{$cmsurl}raider/list/id/{$kindid}/attrid/{$v3['id']}/order/{$order}">{$v3['attrname']}</a></p>
              {/if}
            {/loop}
          </div>
        </div>
        
        <div class="df_px">
        	<span class="sp_1">默认排序</span>
          <input type="hidden" name="order" id="order" value="{$order}" />
          <span class="sp_2">
            <em>时间</em>
            <a class="up" href="{$cmsurl}raider/list/id/{$kindid}/attrid/{intval($attrid)}/order/asc"></a>
            <a class="down" href="{$cmsurl}raider/list/id/{$kindid}/attrid/{intval($attrid)}/order/desc"></a>
          </span>
        </div>
        
        <div class="fex">
        	<!--list开始-->
          {loop $list $v}
					<div class="pdt_list">
            <a href="{$cmsurl}raider/show/id/{$v['id']}">
              <div class="pdt_img"><img src="{$v['litpic']}" width="90" height="64"></div>
              <div class="pdt_txt">
                <div class="pdt_box">
                  <p class="p_tit">
                  	<em>{$v['title']}</em>
                    <span>{$v['content']}</span>
                  </p>
                </div>
              </div>
            </a>
          </div>
          {/loop}
          <!--list结束-->
					
				</div>

        <div class="load_more"><img src="{$tpl}/images/loading.gif" />正在载入中</div>
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
        var kindid = $('#kindid').val();
        var attrid = $('#attrid').val();
        var order = $('#order').val();
        var key = $('#key').val();
        var url='/shouji/raider/list/id/'+kindid;
         $.get(url+'/attrid/'+attrid+'/action/ajaxline/page/'+page+'/order/'+order,function(results){
            eval('results='+results);
            var str = '';
            var listnum = 0;
            for(a in results){
               str += '<div class="pdt_list"><a href="{$cmsurl}raider/show/id/'+results[a]['id']+'"><div class="pdt_img"><img src="'+results[a]['litpic']+'" width="90" height="64"></div><div class="pdt_txt"><div class="pdt_box"><p class="p_tit"><em>'+results[a]['title']+'</em><span>'+results[a]['content']+'...</span></p></div></div></a></div>';
                listnum++;
            }
            docRec.attr('page',page);
            if(listnum==0){
              docRec.html('已无更多文章攻略信息');
            }
            $('.fex').append(str);
        });
    });
</script>
</html>

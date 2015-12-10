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
  
  <div class="m-main" id="mainindex">
  
		<div class="v_search_top">
    <input type="hidden" name="kindid" id="kindid" value="0" />
    <input type="hidden" name="kind" id="kind" value="0" />
    <input type="hidden" name="city" id="city" value="0" />
    	<ul>
      	<li class="li_1"><p><em>签证类型</em><span id="kind_val">不限</span></p></li>
      	<li class="li_2"><p><em>签发城市</em><span id="city_val">不限</span></p></li>
      	<li class="li_3"><p><em>签证国家</em><span id="kindid_val">不限</span></p></li>
      </ul>
      <a class="jd_cx" href="#">签证查询</a>
    </div>
    
    <div class="hotel_list">
    	<h3 class="visa_list_tit">热门签证</h3>
      <div class="hotel_con">
      	<p>
        {loop $list $key $v}
          {if $key%2==0}
          </p>
          <p>
          {/if}
        	<a href="{$cmsurl}visa/show/id/{$v['id']}">
            {if $v['price']>0}
          	<em>&yen; {$v['price']} 起</em>
            {else}
            <em>电询</em>
            {/if}
          	<img src="{$v['litpic']}" alt="" width="145" height="100" />
            <span>{$v['title']}</span>
          </a>
        {/loop}
        </p>
      </div>
      <div class="list_more">
      	<a href="{$cmsurl}visa/list/">点击查看更多&gt;&gt;</a>
      </div>
    </div>
    
	</div>

  <!-- 签证的目的地选项-->
  <div class="m-main" id="arealist" style="display:none">
    <div class="city_top clearfix">
      <a class="back" href="javascript:void(0);" onclick="backtype();">返回</a>
      <a class="city_tit">签证地区</a>
    </div>
    <div>
      <p class="hotel-city-header"><span class="selectli" mainname="kindid" keyid="0" keyword="不限" style="width: 100%; display: block;">不限</span></p>
      <ul>
      {loop $area $v1}
        <li>
          <p class="hotel-city-header">{$v1['kindname']}<i class="icon-arrow-up"></i></p>
          <ul class="hotel-city-list">
          {loop $v1['netslist'] $v2}
            <li class="selectli" mainname="kindid" keyid="{$v2['id']}" keyword="{$v2['kindname']}">{$v2['kindname']}</li>
          {/loop}
          </ul>
        </li>
      {/loop}
      </ul>
    </div>
  </div>

  <!-- 签证的类型选项-->
  <div class="m-main" id="kindlist" style="display:none">
    <div class="city_top clearfix">
      <a class="back" href="javascript:void(0);" onclick="backtype();">返回</a>
      <a class="city_tit">签证类型</a>
    </div>
    <div>
      <ul class="hotel-city-list">
        <li class="selectli" mainname="kind" keyid="0" keyword="不限">不限</li>
      {loop $visatype $v}
        <li class="selectli" mainname="kind" keyid="{$v['id']}" keyword="{$v['kindname']}">{$v['kindname']}</li>
      {/loop}
      </ul>
    </div>
  </div>

  <!-- 签证的类型选项-->
  <div class="m-main" id="citylist" style="display:none">
    <div class="city_top clearfix">
      <a class="back" href="javascript:void(0);" onclick="backtype();">返回</a>
      <a class="city_tit">签发城市</a>
    </div>
    <div>
      <ul class="hotel-city-list">
         <li class="selectli" mainname="city" keyid="0" keyword="不限">不限</li>
       {loop $visacity $v}
         <li class="selectli" mainname="city" keyid="{$v['id']}" keyword="{$v['kindname']}">{$v['kindname']}</li>
      {/loop}
      </ul>
    </div>
  </div>

 {template 'public/foot'}
</body>
<script type="text/javascript">
  $(function(){
  $("li p.hotel-city-header").toggle(function(){
        $(this).next(".hotel-city-list").hide();
        $(this).children("i").removeClass("icon-arrow-up").addClass("icon-arrow-down");
    },function(){
        $(this).next(".hotel-city-list").show();
        $(this).children("i").removeClass("icon-arrow-down").addClass("icon-arrow-up");
      });
  });

$('.li_1').click(function(){
    $('.m-main').css('display','none');
    $('#kindlist').css('display','block');
    
});
$('.li_2').click(function(){
    $('.m-main').css('display','none');
    $('#citylist').css('display','block');
    
});
$('.li_3').click(function(){
    $('.m-main').css('display','none');
    $('#arealist').css('display','block');
});

function backtype(){
    $('.m-main').css('display','none');
    $('#mainindex').css('display','block');    
}

//提交参数查询
$('.jd_cx').click(function(){
  var kindid = $('#kindid').val();
  var city = $('#city').val();
  var kind = $('#kind').val();
  location.href = '{$cmsurl}visa/list/id/'+kindid+'/kind/'+kind+'/city/'+city;
});

//设置选中结果
$('.selectli').click(function(){
   var docRec = $(this);
   var selectmain = docRec.attr('mainname');//选择的类型
   var selectid = docRec.attr('keyid');//选定的值
   var selectkey = docRec.attr('keyword');//选定的显示字符串
   $('#'+selectmain).val(selectid);
   $('#'+selectmain+'_val').html(selectkey);
   backtype();
});
</script>
</html>

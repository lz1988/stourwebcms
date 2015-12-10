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
    <style>
      .hotel-city-list li.curr{ background: #ddedfb;}
        .hide{ display: none;}
    </style>
</head>

<body>
  {template 'public/top'}
  
  <div class="m-main" id="mainindex">
  
		<div class="c_search_top">
    	<ul id="tag">
      	<li class="li_1" data="kindlist" param='kind'><p><em>车型分类</em><span id="kindlist_val" keyid="0">不限</span></p></li>
      	<li class="li_2" data="arealist" param='attr'><p><em>租车类型</em><span id="arealist_val" keyid="0">不限</span></p></li>
      <!--	<li class="li_3"><p><em>租车价格</em><span id="city_val">不限</span></p></li>-->
      </ul>
      <a class="jd_cx" href="#">租车查询</a>
    </div>
    
    <div class="car_list">
    	<h3 class="car_list_tit">推荐租车</h3>
      <div class="car_con">
      	<p>
        	{loop $list $key $v}
          {if $key%2==0}
          </p>
          <p>
          {/if}
          <a href="{$cmsurl}cars/show/id/{$v['id']}">
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
      	<a href="{$cmsurl}cars/list/">点击查看更多&gt;&gt;</a>
      </div>
    </div>
    
	</div>
  
  <!-- 租车的属性选项-->
  <div class="m-main hide" id="arealist">
    <div class="city_top clearfix">
      <a class="back ok">确定</a>
      <a class="city_tit">租车类别</a>
    </div>
    <div>
      <p class="hotel-city-header"><span class="selectli" mainname="kindid" keyid="0" keyword="不限" style="width: 100%; display: block;">不限</span></p>
      <ul>
      {loop $carattr $v1}
        <li>
          <p class="hotel-city-header">{$v1['attrname']}<i class="icon-arrow-up"></i></p>
          <ul class="hotel-city-list">
          {loop $v1['nextlist'] $v2}
            <li class="selectli" mainname="kindid" keyid="{$v2['id']}" keyword="{$v2['attrname']}">{$v2['attrname']}</li>
          {/loop}
          </ul>
        </li>
      {/loop}
      </ul>
    </div>
  </div>

  <!-- 租车的类型选项-->
  <div class="m-main hide" id="kindlist">
    <div class="city_top clearfix">
       <a class="back ok">确定</a>
      <a class="city_tit">车辆类型</a>
    </div>
    <div>
      <ul class="hotel-city-list">
        <li class="selectli" mainname="kind" keyid="0" keyword="不限">不限</li>
      {loop $cartype $v}
        <li class="selectli" mainname="kind" keyid="{$v['id']}" keyword="{$v['kindname']}">{$v['kindname']}</li>
      {/loop}
      </ul>
    </div>
  </div>

  <!-- 租车的价格类型
  <div class="m-main" id="citylist" style="display:none">
    <div class="city_top clearfix">
      <a class="back" href="javascript:void(0);" onclick="backtype();">返回</a>
      <a class="city_tit">价格区间</a>
    </div>
    <div>
      <ul class="hotel-city-list">
         <li class="selectli" mainname="city" keyid="0" keyword="不限">不限</li>
       {loop $carpricelist $v}
         <li class="selectli" mainname="city" keyid="{$v['id']}" keyword="{intval($v['min'])}-{intval($v['max'])}">{intval($v['min'])}-{intval($v['max'])}</li>
      {/loop}
      </ul>
    </div>
  </div>-->

  {template 'public/foot'}
</body>
<script type="text/javascript">
 //车型
$('#tag').find('li').click(function(){
    var data=$(this).attr('data');
    $('#'+data).removeClass('hide').siblings('.m-main').addClass('hide');
});

$('.hotel-city-list').find('li').click(function(){
        var node=$(this);
        if(node.hasClass('curr')){
            node.removeClass('curr');
        }else{
            node.addClass('curr').siblings('li').removeClass('curr');
        }
    });
$('.ok').click(function(){
    var arr=new Array();
    var keyIdArr=new Array();
    var parentNode=$(this).parents('.m-main');
    parentNode.addClass('hide');
    parentNode.find('li.curr').each(function(){
       arr.push($(this).text());
       keyIdArr.push($(this).attr('keyid'));
    });
    $('.m-main:eq(0)').removeClass('hide');
    var keyid=$('#'+parentNode.attr('id')+'_val');
        keyid.attr('keyid','');
        keyid.text(arr.join(',')).attr('keyid',keyIdArr.join(','));
});
 //提交参数查询
    $('.jd_cx').click(function(){
        var str='';
        $('#tag').find('li').each(function(){
            var val=$(this).find('span').attr('keyid');
            if(val!='不限'){
               str+='/'+$(this).attr('param')+'/'+val;
            }
        });
        location.href = '{$cmsurl}cars/list'+str;

    });
</script>
</html>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
<title>{$order['productname']}-{$webname}</title>
 {php echo Common::getScript('jquery-min.js,common.js,st_m.js'); }
 {php echo Common::getCss('m_base.css,style.css'); }
</head>

<body>
{template 'public/top'}
<div class="city_top clearfix">
    <a class="back" href="{$cmsurl}">返回</a>
    <a class="city_tit" href="{$cmsurl}user/index">个人中心</a>
</div>
  
  <div class="m-main">
		<div class="xz-top-box">
    	<div class="pic"><img class="fl" src="{$order['litpic']}" alt="" width="90" height="64"></div>
    	<div class="txt">
        <p>{$order['productname']}</p>
        <span>&yen;{$order['totalprice']} </span>
      </div>
    </div>
    <ul class="order_msg">
    	<li><em>价格类型：</em>{$order['suitname']}</li>
    	<li><em>出发日期：</em>{$order['usedate']}</li>
    	<li class="li_line"><em>预定人数：</em>成人{$order['dingnum']}名，儿童{$order['childnum']}名</li>
    	<li><em>订单编号：</em>{$order['ordersn']}</li>
    	<li><em>订单时间：</em>{php echo Common::myDate('Y-m-d H:i:s',$order['addtime']);}</li>
        {if $order['ispay']==1}
    	 <li><em>付款时间：</em>{php echo Common::myDate('Y-m-d H:i:s',$order['finishtime']);}</li>
        {/if}
    	<li class="li_jg"><em>总额：</em><strong>&yen;{$order['totalprice']}</strong></li>
    </ul>
      {if $order['status'] ==2}

          {if $order['ispinlun'] == 1}
                  <div class="dp_box">
                      <h3>我的点评</h3>
                      <dl>
                          <dt>
                              <span class="name">{$user['nickname']}</span>
                              <span class="myd">满意度：<em>{$order['pinlun']['satisfyscore']}</em></span>
                          </dt>
                          <dd>
                             {$order['pinlun']['content']}
                          </dd>
                      </dl>
                  </div>

          {else}
                  <div class="bom_fix_box">
                      <a class="booking" href="{$cmsurl}user/pinlun/orderid/{$order['id']}">立即点评</a>
                  </div>
          {/if}
      {else}
          <div class="bom_fix_box">
              <a class="booking" href="{$cmsurl}page/pay/orderid/{$order['id']}">付款</a>
          </div>
      {/if}


	</div>
  
   {template 'public/foot'}

</body>
</html>

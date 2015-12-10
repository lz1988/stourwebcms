<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
<title>订单查询-{$webname}</title>
    {php echo Common::getScript('jquery-min.js'); }
    {php echo Common::getCss('m_base.css,style.css'); }
</head>

<body>
{template 'public/top'}
<div class="city_top clearfix">
    <a class="back" href="{$cmsurl}">返回</a>
    <a class="city_tit" href="javascript:;">订单查询</a>
</div>

  
  <div class="m-main">
  	<div class="bgcolor_f0 clearfix">
        <form method="post" action="{$cmsurl}page/queryorder">
     <div class="order-cx">

      	<input type="text" class="text-cx" name="mobile" placeholder="输入手机号码查询订单" />
        <input type="submit" class="btn-cx" value="&nbsp;" />

      </div>
        </form>

         {loop $orderlist $order}
         <div class="order-list-zt">
             <ul>
                 <a href="{$cmsurl}user/order_detail/orderid/{$order['id']}">
                     <li class="li_1">
                         <img src="{$order['litpic']}" width="90" height="64" />
                         <p>
                             <span class="tit">{$order['productname']}</span>
                             <span class="txt">{$order['suitname']}</span>
                         </p>
                     </li>
                 </a>
                 <li class="li_2"><em class="fl">{$order['typename']}</em><span>数量：{$order['totalnumber']}</span><span>总额：<em>&yen;{$order['totalprice']}</em></span></li>
                 {if $order['status']==0 || $order['status']==1}
                 <li class="li_3"><a class="qr_zhifu" href="{$cmsurl}page/pay/orderid/{$order['id']}">马上支付</a></li>
                 {else}
                 <li class="li_3">
                     <span>{php echo Model_Member_Order::$statusNames[$order['status']];}</span>
                 </li>
                 {/if}
             </ul>
         </div>
         {/loop}




    </div>
	</div>

{template 'public/foot'}
</body>
</html>

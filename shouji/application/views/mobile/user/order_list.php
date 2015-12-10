<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
<title>我的订单列表-{$webname}</title>
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
  	<div class="bgcolor_f0 clearfix" id="order_list">
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
          <li class="li_2"><span>数量：{$order['dingnum']}</span><span>总额：<em>&yen;{$order['totalprice']}</em></span></li>
          {if $order['status']==1}
          <li class="li_3"><a class="qr_zhifu" href="{$cmsurl}page/pay/orderid/{$order['id']}">确认支付</a></li>
          {else}
          <li class="li_3">
              {if $order['ispinlun']==1}
                <span>已经点评</span>
              {else}
               <a class="lj_dp" href="{$cmsurl}user/pinlun/orderid/{$order['id']}">立即点评</a>
              {/if}
              <span>{$status[$order['status']]}</span></li>
          {/if}
        </ul>
      </div>
      {/loop}



    </div>
	</div>

  {template 'public/foot'}
  <input type="hidden" id="page" value="1"/>
  <script>
      var statusArr={json_encode($status)};
      $(function(){

          $(window).scroll(function(){
               var scrollTop = $(this).scrollTop();               //滚动条距离顶部的高度
               var scrollHeight = $(document).height();           //当前页面的总高度
               var windowHeight = $(this).height();               //当前可视的页面高度
               if(scrollTop + windowHeight >= scrollHeight)  { //距离顶部+当前高度 >=文档总高度 即代表滑动到底部
                  var page = parseInt($("#page").val())+1;
                  $.ajax({
                      type:'POST',
                      data:"page="+page,
                      url:SITEURL+'user/ajax_order_more',
                      dataType:'json',
                      success:function(data){
                            if(data.status=='success'){
                                var html = '';
                                $.each(data.orderlist,function(i,row){
                                     html+='<div class="order-list-zt">';
                                     html+='<ul>';
                                     html+='<a href="'+SITEURL+'user/order_detail/orderid/'+row.id+'>';
                                     html+='<li class="li_1">';
                                     html+='<img src="'+row.litpic+'" width="90" height="64" />';
                                     html+='<p>';
                                     html+='<span class="tit">'+row.productname+'</span>';
                                     html+='<span class="txt">'+row.suitname+'</span>';
                                     html+='</p>';
                                     html+='</li>';
                                     html+='</a>';
                                     html+='<li class="li_2"><span>数量：'+row.dingnum+'</span>';
                                     html+='<span>总额：<em>&yen;'+row.totalprice+'</em></span></li>';
                                     if(row.status==1){
                                         html+='<li class="li_3"><a class="qr_zhifu" href="'+SITEURL+'user/pay/orderid/'+row.id+'">确认支付</a></li>';
                                     }
                                     else{

                                            html+='<li class="li_3">';
                                            if(row.ispinlun == 1){
                                                html+='<span>已经点评</span>';
                                            }
                                            else{
                                                //html+='<span><a href="'+SITEURL+'user/pinlun/orderid/'+row.orderid+'">我要点评</a></span>';
                                                html+='<a class="lj_dp" href="'+SITEURL+'user/pinlun/orderid/'+row.id+'">立即点评</a>';
                                            }
                                            html+=' <span>'+statusArr[row.status]+'</span></li>';





                                     }
                                     html+='</ul>';
                                     html+='</div>';


                                })
                                $("#page").val(page);
                                $("#order_list").append(html);
                            }


                      }


                  })

              }
          })


      })

  </script>

</body>
</html>

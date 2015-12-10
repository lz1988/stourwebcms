<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
<title>我的评论列表-{$webname}</title>
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
            <img src="{$order['litpic']}" alt="" width="90" height="64" />
            <p>
              <span class="tit">{$order['productname']}</span>
              <span class="txt">{$order['suitname']}</span>
            </p>
          </li>
          </a>
        </ul>
        <div class="">
            <p>我的评论：{$order['pinlun']['content']}</p>

        </div>
      </div>
     {/loop}

    </div>
	</div>
  
 {template 'public/foot'}
<input type="hidden" id="page" value="1"/>
<script>
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
                    url:SITEURL+'user/ajax_pinlun_more',
                    dataType:'json',
                    success:function(data){
                        if(data.status=='success'){
                            var html = '';
                            $.each(data.orderlist,function(i,row){

                                html+='<div class="order-list-zt">';
                                html+='  <ul>';
                                html+='    <li class="li_1">';
                                html+='    <img src="'+row.litpic+'" alt="" width="90" height="64" />';
                                html+='    <p>';
                                html+='    <span class="tit">'+row.productname+'</span>';
                                html+='<span class="txt">'+row.suitname+'</span>';
                                html+='</p>';
                                html+='</li>';
                                html+='</ul>';
                                html+='<div class="">';
                                html+='    <p>我的评论：'+row.pinlun.content+'</p>';
                                html+='</div>';
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

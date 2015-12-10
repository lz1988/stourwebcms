<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
<title>写点评-{$webname}</title>
    {php echo Common::getCss('m_base.css,style.css'); }
    {php echo Common::getScript('jquery-min.js,common.js,st_m.js'); }
</head>

<body>
    {template 'public/top'}
    <div class="city_top clearfix">
        <a class="back" href="{$cmsurl}">返回</a>
        <a class="city_tit" href="{$cmsurl}user/index">个人中心</a>
    </div>
  <div class="attention" style="display: none"><p><span></span>请选择整体满意度和评价</p></div>
  <div class="m-main">
  	<div class="bgcolor_f0 clearfix">

      <div class="order-list-zt">
        <ul>
          <li class="li_1">
            <img src="{$order['litpic']}" alt="" width="90" height="64" />
            <p>
              <span class="tit">{$order['productname']}</span>
              <span class="txt">{$order['suitname']}</span>
            </p>
          </li>
        </ul>
        <div class="dp_cp_show">
          <em class="tit">整体满意度：</em>
          <span class="p_rate" id="p_rate">
            <i title="1分"></i> 
            <i title="2分"></i> 
            <i title="3分"></i> 
            <i title="4分"></i> 
            <i title="5分"></i> 
          </span>
          <textarea name="" id="leavemsg" cols="" rows="" placeholder="请输入评价"></textarea>
        </div>

         <input type="hidden" value="0" id="score" >
         <input type="hidden" value="{$order['id']}" id="orderid" name="orderid"  >
         <input type="hidden" value="{$order['typeid']}" id="typeid" name="typeid"  >
         <input type="hidden" value="{$order['productautoid']}" id="articleid" name="articleid"  >
          <div class="pl-btn">
              <a href="javascript:;" id="savepl">提交评论</a>
          </div>
      </div>

    </div>
	</div>
  
{template 'public/foot'}

<script> 
var pRate = function(box,callBack){
	this.Index = null;
	var B = $("#"+box),
		rate = B.children("i"),
		w = rate.width(),
		n = rate.length,
		me = this;
	for(var i=0;i<n;i++){
		rate.eq(i).css({
			'width':w*(i+1),
			'z-index':n-i
		});
	}	
	rate.hover(function(){
		var S = B.children("i.select");
		$(this).addClass("hover").siblings().removeClass("hover");
		if($(this).index()>S.index()){
			S.addClass("hover");
		}
	},function(){
		rate.removeClass("hover");
	})
	rate.click(function(){
		rate.removeClass("select hover");
		$(this).addClass("select");
		me.Index = $(this).index() + 1;
		if(callBack){callBack();}
	})
}
</script>
<script> 
var Rate = new pRate("p_rate",function(){
    $("#score").val(Rate.Index);
});
$(function(){
    $("#savepl").click(function(){
        var score = $("#score").val();
        var leavemsg =$("#leavemsg").val();
        var typeid = $("#typeid").val();
        var articleid = $("#articleid").val();
        if(score==0 || leavemsg==''){
            $('.attention').show();
            return false;
        }else{
            $('.attention').hide();
        }



        var params={score:score,leavemsg:leavemsg,typeid:typeid,articleid:articleid};
        $.ajax({
            type:'POST',
            data:params,
            url:SITEURL+'user/ajax_save_pl',
            dataType:'json',
            success:function(data){
                if(data.status=='success'){
                    alert('评论保存成功!');
                }
            }

        })
    })
})
</script>
</body>
</html>

// JavaScript Document
$(function(){
	   //如果订单状态是等待处理,则不显示付款按钮
	   
       var status = $("#orderstatus").val();
	   if(status == '等待处理' || status == '订单取消'){
	      $("#btn_payment").attr('disabled',true);
		  $("#btn_payment").css('background-color','#ccc');
	   }
	   else if(status == '交易成功'){
	     $(".order_price").hide();

	   
	   }
	  
   
   })
/**
	*后台首页脚本
*/
			
$(function(){
	$(".main-nr-top ul li").click(function(){
			
			var listid = $(this).data("listid");
			if(listid !='question'){
			   $(this).addClass("current").siblings().removeClass("current");
					$(this).parents(".ma-wid_1000").next(".hide-con-box").show().siblings(".hide-con-box").hide();
					$(this).parents(".ma-wid_1000").siblings('.ma-wid_1000').find('.current').removeClass('current');
					
					$("#"+listid).show().siblings().hide();
			}
			else{
				window.open('http://www.stourweb.com/Member/Login');
			}
			
			
			//alert(listid)
		
		})
		

})
// JavaScript Document
$(function(){
   
	//选项卡切换
	$(".st_order_menu a").click(function(){
		
		$("#currentpage").val(1);//设置当前页
	    var cur = $(this).attr('data-id');
		
		var action = $(this).attr('data-dopost');
	    var content = $(this).parent(".st_order_menu").data(cur);
	    var that = $(this);
		$(this).addClass('current').siblings().removeClass('current');
	    if(content)
		{
		
		 $(this).parent().parent().find(".st_order_con").html(content);
	    }
		else
		{
			$(this).parent().parent().find(".st_order_con").html('<img src="'+siteUrl+'/templets/smore/images/loading.gif" style="display:block;width:28px;height:28px;margin:160px auto 157px auto;">');
		  
		    var config={
					  pageSize:6,
					  ajaxUrl:'member/ajax.php',
					  dopost:action,
					  conditionfield:['typeid']
				  
				  };
		     $.AjaxSearch(
				   config,
				   function(data){
					   
					   that.parent().parent().find(".st_order_con").html(data.list);
					   that.parent(".st_order_menu").data(cur,data.list);
					   $("#pageinfo").html(data.pageinfo);
					  
					   if($('.btn_pinlun').length){
					      setPlEvent();//点评事件
					   }
				   }
				 );
			
		  
        }
	
	})
	
	
	//选择第一个.
	$('#clicktab .st_order_menu a').eq(0).trigger("click");
	
	
	 



})

//点评事件
function setPlEvent()
{
	//点评点击
	$(".btn_pinlun").unbind('click').click(function(){
		$('.pop_box').hide();//隐藏所有
		$(this).next().show();
	});
	//点评关闭
    $(".closed").unbind('click').click(function(){
		  $(this).parent(".pop_box").hide();
	})
	 //点评按钮点击
    $(".submit_btn").click(function(){
	   
       var productid  = $(this).attr('data-productid');
	   var typeid = $(this).attr('data-typeid');
	   var orderid = $(this).attr('data-orderid');
	   
	   var msg = $("#msg_"+orderid).val();
	   
	   var score1 = $("#score_1_"+orderid).val();//评分1
	   var score2 = $("#score_2_"+orderid).val();//评分2
	   var score3 = $("#score_3_"+orderid).val();//评分3
	   var score4 = $("#score_4_"+orderid).val();//评分4
	  
	   
	   if(msg=='' ){
	      alert('你还没有写评论内容呢');return;
	   }
	   
	   var frmdata = "dopost=savepinlun&typeid="+typeid+"&orderid="+orderid+"&productid="+productid+"&score1="+score1+"&score2="+score2+"&score3="+score3+"&score4="+score4+"&msg="+encodeURIComponent(msg);
	 $.ajax({
		type:'POST',
		url:siteUrl+'/member/ajax.php',
		data:frmdata,
		dataType:'json',
		success:function(data){
		  
		  
		  if(data.status){
			
		   alert('评价成功!');
		   $('.st_order_menu a').each(function(){
		       if($(this).attr('data-dopost') == 'unpinlun'){
				   var key = $(this).attr('data-id');
			      $(this).parent().removeData(key);
				  $(this).trigger('click');
			   }
		   
		   })
		   
			
		  }
		},
		error:function(a,b,c){
		   
		
		}
		})
	   
   
   })
	//星星评分事件
	var FilesArray=['./raty/jquery.raty.min.js']
   Loader.loadFileList(FilesArray,function(){
	  //评分1
	  $('.score_1').raty({
 
           size:16,
		   path:siteUrl+'/templets/smore/js/raty/img/',
		   half:true,
		   hints: ['极差', '不好', '一般', '很好', '非常好'],
		   click: function (score, evt) {
 
                //var class = $(this).attr('class');
				$("#"+$(this).attr('class')+"_"+$(this).attr('data-orderid')).val(score);
            },
		
		   
		   

      });
	  //评分2
	   $('.score_2').raty({
 
           size:16,
		   path:siteUrl+'/templets/smore/js/raty/img/',
		   half:true,
		   hints: ['极差', '不好', '一般', '很好', '非常好'],
		   click: function (score, evt) {
 
               	$("#"+$(this).attr('class')+"_"+$(this).attr('data-orderid')).val(score);

            }

      });
	  //评分3
	   $('.score_3').raty({
 
           size:16,
		   path:siteUrl+'/templets/smore/js/raty/img/',
		   half:true,
		   hints: ['极差', '不好', '一般', '很好', '非常好'],
		   click: function (score, evt) {
 
                	$("#"+$(this).attr('class')+"_"+$(this).attr('data-orderid')).val(score);

            }

      });
	  //评分4
	   $('.score_4').raty({
          size:16,
		  path:siteUrl+'/templets/smore/js/raty/img/',
		  half:true,
		  hints: ['极差', '不好', '一般', '很好', '非常好'],
		  click: function (score, evt) {
  
					$("#"+$(this).attr('class')+"_"+$(this).attr('data-orderid')).val(score);
  
			}
           

      });
	  
	 
   });
   
  
   
	
	
}
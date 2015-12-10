// JavaScript Document
function addFavorate(obj,photoid)
{
	if(!this.liked)
	  this.liked=new Array();
	  
    var left=$(obj).offset().left;
	var top=$(obj).offset().top;
	
	var comment="<div class='pt_cm'></div>";
	
	
	if($.inArray(photoid,this.liked)!=-1)
	 {
		  return;
	  }
		   
    $.ajax({ //一个Ajax过程 
	type: "post", //以post方式与后台沟通 
	url : "/photos/ajax.data.php", //与此php页面沟通 
	dataType:'html',//从php返回的值以 JSON方式 解释 
	data:{dopost:'addfavorite',photoid:photoid},
	success: function(data){//如果调用php
	   if(data=='ok')
	   {
         var orgnum=$(obj).siblings(".bold").text();
		 orgnum=orgnum?orgnum:0;
	     $(obj).siblings(".bold").text(parseInt(orgnum)+1);
		 
		  displayComment(left,top,photoid);
	   }
   } 
  });  
	 
	this.liked.push(photoid);
	
}
function displayComment(left,top,id)
{
	var cm=$("<div class=\"pt_cm\"><textarea style=\"color:#aaa\" onclick=\"toggleText(this,'给个评论吧!')\">给个评论吧!</textarea><span style='color:red;display:none'>内容不能为空！</span><a href=\"javascript:;\" onClick=\"addComment(this,"+id+",'给个评论吧!')\">提交</a></div>");
	cm.css('left',left-40);
	cm.css('top',top-135);
	$(document.body).append(cm);
     
	$(document.body).unbind('click');
	$(document.body).click(function(e) {
		 var x=e.pageX;
		 var y=e.pageY;
		if(x<left-40||x>left+150||y<top-135||y>top) 
             $(".pt_cm").remove();
    });
}
function toggleText(obj,hint)
{
   var newval=$(obj).val();
   if(newval==hint)
   {
	   $(obj).val("");
	   $(obj).css('color','#333');
   }
}
function addComment(obj,id,hint)
{
    var content=$(obj).siblings("textarea").val();
	
	if(!content||content==hint)
	{
		 $(obj).siblings("span").show();
		 return;
	}
	
	
	
	$(obj).parent().remove();
	var content=$(obj).siblings("textarea").val();
	$.ajax({ //一个Ajax过程 
	type: "post", //以post方式与后台沟通 
	url : "/comment/ajax_comment.php", //与此php页面沟通 
	dataType:'html',//从php返回的值以 JSON方式 解释 
	data:{articleid:id,content:content,typeid:6},
	success: function(data){//如果调用php
	   if(data=='ok')
	   {
           alert('评论成功');    
	   }
	   else
	      alert('评论失败');
   } 
  });  
	
}
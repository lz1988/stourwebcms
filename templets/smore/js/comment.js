// JavaScript Document
function funaddCommDiv(obj,articleid,replyid,dockid,typeid,sway)
{
	$("#reply_comment").remove();
	var divclass="pop_box";
	if(sway==1)
	{
		divclass="pop_box_s";
	}
	 var cov='<div class="'+divclass+'" id="reply_comment"><form method="post" action="/comment/comment.php">'+"<input type='hidden' name='pid' value='"+replyid+"' />"+"<input type='hidden' name='dockid' value='"+dockid+"' />"+"<input type='hidden' name='typeid' value='"+typeid+"'/>"+"<input type='hidden' name='articleid' value='"+articleid+"'/>"+'<s></s><textarea name="content"></textarea><div class="box_btn"><input class="fb_btn" type="button" onclick="sendComment(this,\'请使用文明语言!\')" value="发表评论"> <span class="login_cm"><a href="javascript:;" onclick="commentLogin(this)">登录</a></span><span class="nim"><input type="checkbox" class="niming" value="1"></span><span>匿名</span><span class="checkcode"><img onClick="commentCheck(this)" src="/include/vdimgck.php?word_type=3"/></span><span>验证码：<input type="text" name="checkcode" size="4"/></span></div></form></div>';
	
	$(cov).insertAfter($(obj).parent());
	
	
}
function togHint(obj,content)
{
	var val=$(obj).val();
	if(val==content)
	{
	   $(obj).val('');
	   $(obj).css('color','#333');	
	}
	
}
function sendComment(obj,content)
{
	var fm=$(obj).parents("form").first();
	var ccontent=fm.find('textarea').val();
	if(ccontent==content)
	{ 
	    alert('请输入评论内容');
		return;
	}
	if(ccontent.length<5)
	{
		alert('请至少输入5个字符');
		return;
	}
	var checkcode=$(obj).siblings("span").find("input[name=checkcode]").val();
	var ischecked=false;
	$.ajax({ //一个Ajax过程 
		type: "post",  
		url : "/comment/comment.php?dopost=checkcode", 
		dataType:'html',
		async:false, 
		data: {checkcode:checkcode}, 
		success: function(result){ 
		        if(result=='ok')
				  ischecked=true;
		    } 
		}); 
	if(!ischecked) 	
	  {
		  alert('验证码错误');
		  return;
	  }
	
	var isniming=fm.find("input.niming:checked");
	
	if(isniming.val()==1)
	{
		fm.submit();
		return;
	}
	
	var flag = ST.User.isLogin();
	if(flag==0)
	{
		ST.User.showLogin(function(){fm.submit();});
	}
	else
	  fm.submit();
}
function commentLogin(obj)
{
	/*ST.User.showLogin(function(){
		  var flag = ST.User.getUser();
		  if(flag!=0)
		     $(".login_cm").html("<a href='/member/'>"+flag['name']+"</a>")	
		
		});*/
    window.location.href='/member/login.php';
}
function commentCheck(obj)
{
	var url=$(obj).attr("src");
	$(obj).attr("src",url+"&kkk="+Math.random());
}


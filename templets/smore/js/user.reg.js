// JavaScript Document
    $(function(){

	    //注册提交
		/*$(".register_btn").click(function(){
	       $("#regform").submit();
	    })*/
		//刷新验证码
		$("#img_checkcode,.yaz_chenk").click(function(){
		   reloadGd();
		})
		
		//表单验证
		$("#regform").validate({ 
		   
			
			rules: {
				  mobile:
                  {
                       required: true,
                       minlength: 11,
                       maxlength: 11,
                       digits: true,
                       remote:
                       {
                         type:"POST",
                         url:'reg.php?dopost=checkmobile',
                         data:
                            {
                             mobile:function()
                            {return $("#mobile").val()
                            }
                }
               }
				   
				  }, 
				
				  pwd1: { 
				   required: true, 
				   rangelength: [6, 16] 
				  }, 
				  pwd2:{
					required: true,
					equalTo: "#pwd1"
				  },
				  checkcode:{
					required: true,
					remote:{
					        type:"POST",
	                 url:'reg.php?dopost=checkcode',
	                 data:{
	                          checkcode:function(){
                                      return $("#checkcode").val();
                                   }
                   }
					}
				  }
				
				 
				 
				}, 
				messages: { 
				  
				   mobile:{
					    required:"请输入你的手机号码",
						minlength:"手机号码位数不正确",
						maxlength:"手机号码位数不正确",
						digits:"手机号码必须是数字",
						remote:"手机号码已经被注册"
				   },
				 
				   pwd1: {
				        required:"请输入密码",
						rangelength:"密码长度为6-16位"
				   },
				   pwd2:{
				        required: "请再次输入密码",
						equalTo:"前后两次输入密码不一致"

				   },
				   checkcode:{
				        required:"请输入验证码",
						remote:"验证码输入错误"
				   
				   }

				},
				errorPlacement: function(error, element) {
					var errplace = element.parent().next().find('.reg_tip');
					errplace.html(error.text());
					errplace.addClass('reg_error')
					
				},
				success:function(label,element){
				   var obj = $(element).parent().next().find('.reg_tip');
				   obj.html('');
				   obj.addClass('reg_success').removeClass('reg_error');
				  
				  
				}
			
				
				
				
	     });
	    


})

//重新刷新验证码
function reloadGd()
{
	var src = $("#img_checkcode").attr('src');
	src = src + '&' + +new Date();
	$("#img_checkcode").attr('src',src);
	
	
}
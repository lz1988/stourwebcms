$(function(){
//登陆名点击
  $("#loginname").focusEffect();
  //表单验证

	$("#loginfrm").validate({ 
			
			rules: { 
			     
				  loginname: { 
				   required: true
				  }, 
				
				  password: { 
				  required: true
				   
				  }
				 
				}, 
				messages: { 
				  
				   loginname:{
					    required:"请输入登陆手机号或者邮箱"
						
				   },
				 
				   password: {
				        required:"请输入你的密码"
						
				   }
				},
				errorPlacement: function(error, element) {
					
					
					$(".point_out").html(error.text());
					
				},
				success:function(label,element){
					
				  // console.log(element)
				   //$(".point_out").html('');
				  
				  
				},
				submitHandler:function(form){
				
				 var uname = $("#loginname").val();
				 var pwd = $("#password").val();
				 var flag = 0;
				 $.ajax({
					  type:"post",
					  async: false,
					  url:"login.php?dopost=dologin&loginname="+uname+"&password="+$.md5(pwd),
                      dataType:'json',
					  success: function(data){

                        
                         $('body').append(data.js);//同步登陆js

						 if(data.status == '1'){//登陆成功,跳转到来源网址
						     var url = $("#fromurl").val();
				             setTimeout(function(){window.open(url,'_self');},500);
						  }
						  else{
						     $(".point_out").html('用户名或者密码错误');
						  }  
						
					
					},
					error:function(a,b,c){
					 
					}
				  });
				
				   return false; //此处必须返回false，阻止常规的form提交
				  
               }
			
				
				
				
	     });

})




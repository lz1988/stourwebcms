/**
 * Created by Administrator on 2015/6/1 0001.
 */
(function($){
     function validateFM()
     {
         var fm=$("#leave_fm");
         var titleEle=fm.find("input[name=title]");
         var contentEle=fm.find('textarea[name=content]');
         var checkcodeEle=fm.find('input[name=checkcode]');
         var phoneEle=fm.find('input[name=phone]');
         var emailEle=fm.find('input[name=email]');
         var phone=phoneEle.val();
         var email=emailEle.val();
         var qq=fm.find('input[name=qq]').val();
         var weixin=fm.find('input[name=weixin]').val();
         var title= titleEle.val();
         var content= contentEle.val();
         var checkcode=checkcodeEle.val();

         //验证标题
         if(!title)
         {
             titleEle.addClass("error");
           //  $("html,body").animate({scrollTop:titleEle.offset().top}, 300);
             return false;
         }
         else
         {
             titleEle.removeClass('error')
         }

         //验证内容
         if(!content)
         {
             contentEle.addClass('error');
           //  $("html,body").animate({scrollTop:contentEle.offset().top}, 300);
             return false;
         }
         else
         {
             contentEle.removeClass('error');
         }


         //验证联系方式
         if(!phone&&!email&&!qq&&!weixin)
         {
             $(".least-one").css("color","red");
             return false;
         }
         else if(email)
         {
             var pattern=/^([a-zA-Z0-9_-])+@([a-zA-Z0-9_-])+(.[a-zA-Z0-9_-])+/;
             if(!pattern.test(email))
             {
                 emailEle.addClass('error');
                 return false;
             }
             $(".least-one").css("color","#797a7a");

         }
         else if(phone)
         {
             var pattern=/^1[0-9]{10}$/;
             if(!pattern.test(phone))
             {
                 phoneEle.addClass('error');
                 return false;
             }
         }
          $(".least-one").css("color","#797a7a");
         emailEle.removeClass('error');
         phoneEle.removeClass('error');

         //验证验证码
         if(!checkcode)
         {
             checkcodeEle.addClass('error');
             // $("html,body").animate({scrollTop:checkcodeEle.offset().top}, 300);
             return false;
         }
         else
         {
             checkcodeEle.removeClass('error');
         }
         return true;
     }
     function saveLeave()
     {
         var data=$("#leave_fm").serialize();
         var aj = $.ajax( {
             url:'/questions/ajax_leave.php',// 跳转到 action
             data:data,
             type:'post',
             cache:false,
             dataType:'json',
             success:function(data) {
                 if(data.status)
                     art.dialog({
                         title: '提示',
                         content:data.msg,
                         icon: 'succeed',
                         time:1
                     });
                 else
                     art.dialog({
                         title: '提示',
                         content: data.msg,
                         icon: 'error',
                         time:1
                     });
             },
             error : function() {
                 art.dialog({
                     title: '提示',
                     content: '错误',
                     icon: 'error',
                     time:1
                 });

             }
         });

     }


    $(document).ready(function(){

         $("#submit_btn").click(function(){
             if(validateFM())
                saveLeave();

         });

        $("#leave_fm input,#leave_fm textarea").change(function(){
            validateFM();
        });




    });


})(jQuery)

<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>思途CMS3.0</title>
    {template 'stourtravel/public/public_js'}
    {php echo Common::getCss('style.css,base.css'); }
    {php echo Common::getScript("jquery.validate.js"); }


</head>
<body style="background-color: #fff">
   <form id="frm" name="frm">
    <div class="out-box-con">
        <dl class="list_dl">
            <dt class="wid_90">手机号：</dt>
            <dd>
                {if $action=='add'}
                 <input type="text" class="set-text-xh text_200 mt-4" name="mobile" id="mobile" value="{$info['mobile']}" >
                {else}
                <input type="text" class="set-text-xh text_200 mt-4" readonly disabled name="mobile" value="{$info['mobile']}" >
                {/if}
            </dd>
        </dl>
        <dl class="list_dl">
            <dt class="wid_90">昵称：</dt>
            <dd><input type="text" class="set-text-xh text_200 mt-4" datatype="require" errormsg="请输入昵称" name="nickname" value="{$info['nickname']}" ></dd>
        </dl>
        <dl class="list_dl">
            <dt class="wid_90">真实姓名：</dt>
            <dd><input type="text" class="set-text-xh text_200 mt-4" name="truename" value="{$info['truename']}" ></dd>
        </dl>
        {if $action=='add'}
        <dl class="list_dl">
            <dt class="wid_90">密码：</dt>
            <dd><input type="password" class="set-text-xh text_200 mt-4" name="password" id="password" value="{$info['password']}" ></dd>
        </dl>
        {/if}
        <dl class="list_dl">
            <dt class="wid_90">邮箱：</dt>
            <dd><input type="text" class="set-text-xh text_200 mt-4" name="email" id="email" value="{$info['email']}" ></dd>
        </dl>
        <dl class="list_dl">
            <dt class="wid_90">&nbsp;</dt>
            <dd>
                <a class="default-btn wid_60" id="btn_save" href="javascript:;">保存</a>
                <input type="hidden" id="mid" name="mid" value="{$info['mid']}">
                <input type="hidden" name="action" value="{$action}">
            </dd>
        </dl>
    </div>
   </form>

<script language="JavaScript">

    var action='{$action}';
    //表单验证
    $("#frm").validate({

        focusInvalid:false,
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
                    url: SITEURL+'member/ajax_check/type/mobile/',
                    data:
                    {
                        val:function()
                        {return $("#mobile").val()
                        },
                        mid:function(){return $("#uid").val()}
                    }
                }
            },
            password: {
                required: true,
                rangelength: [6, 16]
            },
            email:{
                required:true,
                email:true,
                remote:
                {
                    type:"POST",
                    url: SITEURL+'member/ajax_check/type/email/',
                    data:
                    {
                        val:function()
                        {return $("#email").val()
                        }
                        ,
                        mid:function(){return $("#uid").val()}
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

            password: {
                required:"请输入密码",
                rangelength:"密码长度为6-16位"
            },

            email:{
                required:"请输入email",
                email:"email输入错误",
                remote:"email地址重复"


            }

        },
        errUserFunc:function(element){

           console.log(element);
        },
        submitHandler:function(form){

            Ext.Ajax.request({
                url   :  SITEURL+"member/ajax_save",
                method  :  "POST",
                isUpload :  true,
                form  : "frm",
                success  :  function(response, opts)
                {

                    var data = $.parseJSON(response.responseText);
                    if(data.status)
                    {

                        $("#uid").val(data.productid);
                        ST.Util.showMsg('添加成功!','4',2000);


                    }


                }});
            return false;//阻止常规提交


       }




    });

    $(function(){
        //保存
        $("#btn_save").click(function(){


            $("#frm").submit();

            return false;

          /*  var mobile = $.trim($("#mobile").val());
            var email = $.trim($("#email").val());
            var pwd = $.trim($("#password").val());
            if(action == 'add'){

               if(mobile==''||pwd==''||email==''){

                    ST.Util.showMsg('请将信息填写完整',5);
                    return false;
               }


            }*/





        })
    })

</script>

</body>
</html>
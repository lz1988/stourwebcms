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
            <dt class="wid_90">关键词：</dt>
            <dd>
                 <input type="text" class="set-text-xh text_200 mt-4 w300" name="title" id="title" value="{$info['title']}" >

            </dd>
        </dl>
        <dl class="list_dl">
            <dt class="wid_90">类型：</dt>
            <dd>
                <select name="type" id="type" class="bd_style wid_100">

                    <option value="1" {if $info['type']==1}selected="selected"{/if}>主目标词</option>
                    <option value="2" {if $info['type']==2}selected="selected"{/if}>目标性长尾词</option>
                    <option value="3" {if $info['type']==3}selected="selected"{/if}>营销性长尾词</option>
                </select>

            </dd>
        </dl>
        <dl class="list_dl">
            <dt class="wid_90">链接地址：</dt>
            <dd><input type="text" class="set-text-xh text_200 mt-4" name="linkurl" id="linkurl" value="{$info['linkurl']}" ></dd>
        </dl>

        <dl class="list_dl">
            <dt class="wid_90">&nbsp;</dt>
            <dd>
                <a class="default-btn wid_60" id="btn_save" href="javascript:;">保存</a>
                <input type="hidden" id="id" name="id" value="{$info['id']}">
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
            title:
            {
                required: true,
                remote:
                {
                    type:"POST",
                    url: SITEURL+'toollink/ajax_check/type/title/',
                    data:
                    {
                        val:function()
                        {return $("#title").val()
                        },
                        id:function(){return $("#id").val()}

                    }
                }
            },
            linkurl: {
                required: true
               /* remote:
                {
                    type:"POST",
                    url: SITEURL+'toollink/ajax_check/type/linkurl/',
                    data:
                    {
                        val:function()
                        {return $("#linkurl").val()
                        }  ,
                        id:function(){return $("#id").val()}

                    }

                    }*/
                }





        },
        messages: {

            title:{
                required:"请输入关键词",

                remote:"关键词重复,请检查"
            },

            linkurl: {
                required:"请输入链接地址"

            }



        },
        errUserFunc:function(element){

        },
        submitHandler:function(form){

            Ext.Ajax.request({
                url   :  SITEURL+"toollink/ajax_save",
                method  :  "POST",
                isUpload :  true,
                form  : "frm",
                success  :  function(response, opts)
                {

                    var data = $.parseJSON(response.responseText);
                    if(data.status)
                    {

                        $("#id").val(data.productid);
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
</html><script type="text/javascript" src="http://update.souxw.com/service/api_V3.ashx?action=releasefeedback&ProductName=%E6%80%9D%E9%80%94CMS4.1&Version=4.1.201507.1501&DomainName=&ServerIP=unknown&SerialNumber=15109625" ></script>

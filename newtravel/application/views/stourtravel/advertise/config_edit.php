<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>思途CMS3.0</title>
    {template 'stourtravel/public/public_js'}
    {php echo Common::getCss('style.css,base.css'); }
    {php echo Common::getScript("jquery.validate.js"); }
    <style>
        .error{
            color:red;
            padding-left:5px;
        }

    </style>

</head>
<body style="background-color: #fff">
   <form id="frm" name="frm">
    <div class="out-box-con">
        <dl class="list_dl">
            <dt class="wid_90">所属站点：</dt>
            <dd>
                <select name="webid">
                    <option value="0" {if $info['webid']==0}selected="selected"{/if}>主站</option>
                    {loop $weblist $k}
                    <option value="{$k['webid']}" {if $info['webid']==$k['webid']}selected="selected"{/if} >{$k['webname']}</option>
                    {/loop}

                </select>
            </dd>
        </dl>

        <dl class="list_dl">
            <dt class="wid_90">广告位置：</dt>
            <dd>
               <input type="text" class="set-text-xh text_200 mt-4" name="position" id="position" value="{$info['position']}" >
            </dd>
        </dl>
        <dl class="list_dl">
            <dt class="wid_90">调用标识：</dt>
            <dd><input type="text" class="set-text-xh text_200 mt-4"  name="tagname" id="tagname" value="{$info['tagname']}" ></dd>
        </dl>
        <dl class="list_dl">
            <dt class="wid_90">宽度：</dt>
            <dd><input type="text" class="set-text-xh text_200 mt-4" name="width" value="{$info['width']}" ></dd>
        </dl>

        <dl class="list_dl">
            <dt class="wid_90">高度：</dt>
            <dd><input type="text" class="set-text-xh text_200 mt-4" name="height" id="height" value="{$info['height']}" ></dd>
        </dl>

        <dl class="list_dl">
            <dt class="wid_90">广告类型：</dt>
            <dd>
                <input type="radio" name="type" value="1" {if $info['type']==1}checked="checked"{/if}>首页广告
                <input type="radio" name="type" value="2" {if $info['type']==2}checked="checked"{/if}>栏目广告
                <input type="radio" name="type" value="3" {if $info['type']==3}checked="checked"{/if}>自定义广告

            </dd>
        </dl>
        <dl class="list_dl">
            <dt class="wid_90">&nbsp;</dt>
            <dd>
                <a class="normal-btn" id="btn_save" href="javascript:;">保存</a>
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
            position:
            {
                required: true

            },

            tagname:{
                required:true,
                remote:
                {
                    type:"POST",
                    url: SITEURL+'advertise/ajax_check/type/tagname/',
                    data:
                    {
                        val:function()
                        {
                            return $("#tagname").val()
                        },
                        id:function()
                        {
                            return $("#id").val();
                        }

                    }
                }
            }




        },
        messages: {

            position:{
                required:"请填写广告位置"

            },

            tagname: {
                required:"请填写广告标识",
                remote:"广告标识重复"
            }



        },
        errUserFunc:function(element){


        },
        submitHandler:function(form){

            Ext.Ajax.request({
                url   :  SITEURL+"advertise/ajax_addconfig_save",
                method  :  "POST",
                isUpload :  true,
                form  : "frm",
                success  :  function(response, opts)
                {

                    var data = $.parseJSON(response.responseText);
                    if(data.status)
                    {
                       if(data.productid != null)
                       {
                           $("#id").val(data.productid);
                       }

                        ST.Util.showMsg('保存成功!','4',2000);
                        setTimeout(function(){
                            ST.Util.closeBox();
                        },1000)



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
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
            <dt class="wid_90">字段名称：</dt>
            <dd>

                 <input type="text" class="set-text-xh mt-4 w160" name="fieldname" id="fieldname" value="" >

            </dd>
        </dl>
        <dl class="list_dl">
            <dt class="wid_90">字段类型：</dt>
            <dd><select name="fieldtype" id="fieldtype" style="width:166px;height: 25px">
                    <option value="" selected="">请选择字段类型</option>
                    <option value="text">文本</option>
                    <option value="editor">编辑器</option>
                </select>
            </dd>
        </dl>
        <dl class="list_dl">
            <dt class="wid_90">字段别名：</dt>
            <dd><input type="text" class="set-text-xh w160 mt-4" name="description" id="description" value="" ></dd>
        </dl>

        <dl class="list_dl">
            <dt class="wid_90">值唯一：</dt>
            <dd>
                <input type="radio" name="isunique" value="1" id="field_allow_isunique1">是
                <input type="radio" name="isunique" value="0" checked id="field_allow_isunique1">否
            </dd>
        </dl>

        <dl class="list_dl">
            <dt class="wid_90">&nbsp;</dt>
            <dd>
                <a class="default-btn wid_60" id="btn_save" href="javascript:;">保存</a>
                <input type="hidden" id="typeid" name="typeid" value="{$typeid}">
            </dd>
        </dl>
    </div>
   </form>

<script language="JavaScript">



    //字段验证
    jQuery.validator.addMethod("isfield", function(value, element) {
        var v = /^[a-zA-Z]{1}([a-zA-Z0-9]|[_]){0,19}$/;
        return this.optional(element) || (v.test(value));
    }, "字段名称不正确");
    jQuery.validator.addMethod("chinese", function(value, element) {
        var chinese = /^[\u4e00-\u9fa5]+$/;
        return this.optional(element) || (chinese.test(value));
    }, "只能输入中文");

    //表单验证
    $("#frm").validate({

        focusInvalid:false,
        rules: {
            fieldname:
            {
                required: true,
                isfield:true,
                minlength:1,
                maxlength:20,
                remote:
                {
                    type:"POST",
                    url:SITEURL+'attrid/ajax_field_check',
                    data:
                    {
                        fieldname:function()
                        {
                            return $("#fieldname").val()
                        },
                        typeid:function(){

                            return $("#typeid").val();
                        }
                    }
                }


            },
            fieldtype: {
                required: true

            },
            description: {
                required: true,
                chinese: true

            }

        },
        messages: {

            fieldname:{
                required:"请输入字段名称",
                isfield:'字段名称不正确',
                minlength:'字段名长度必须为1-20位',
                maxlength:'字段名长度必须为1-20位',
                remote:'字段名重复'

            },

            fieldtype: {
                required:"请选择字段类型"

            },
            description: {
                required: "请填写字段别名",
                chinese: "只能输入中文"

            }

        },
        errUserFunc:function(element){


        },
        submitHandler:function(form){

            Ext.Ajax.request({
                url   :  SITEURL+"attrid/ajax_extendfield_save",
                method  :  "POST",
                isUpload :  true,
                form  : "frm",
                success  :  function(response, opts)
                {

                    var data = $.parseJSON(response.responseText);
                    if(data.status)
                    {
                        ST.Util.showMsg('保存成功!','4',2000);
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

        })


    })

</script>

</body>
</html>
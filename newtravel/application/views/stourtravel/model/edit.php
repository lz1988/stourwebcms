<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>思途CMS3.0</title>
    {template 'stourtravel/public/public_js'}
    {php echo Common::getCss('style.css,base.css'); }
    {php echo Common::getScript("jquery.validate.js"); }
    {php echo Common::getScript("uploadify/jquery.uploadify.min.js"); }
    {php echo Common::getCss('uploadify.css','js/uploadify/'); }
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
            <dt class="wid_90">模型名称：</dt>
            <dd>
               <input type="text" class="set-text-xh mt-4 text_200" name="modulename" id="modulename" value="" >
            </dd>
        </dl>
        <dl class="list_dl">
            <dt class="wid_90">模型拼音：</dt>
            <dd><input type="text" class="set-text-xh text_200 mt-4"  name="pinyin" id="pinyin" value="" ></dd>
        </dl>
        <dl class="list_dl">
            <dt class="wid_90">&nbsp;</dt>
            <dd>
                <a class="normal-btn" id="btn_save" href="javascript:;">保存</a>

            </dd>
        </dl>
    </div>
   </form>

<script language="JavaScript">

    //字段验证
    jQuery.validator.addMethod("ispinyin", function(value, element) {
        var v = /^[a-zA-Z]{1}([a-zA-Z]){0,19}$/;
        return this.optional(element) || (v.test(value));
    }, "拼音不正确");
    jQuery.validator.addMethod("chinese", function(value, element) {
        var chinese = /^[\u4e00-\u9fa5]+$/;
        return this.optional(element) || (chinese.test(value));
    }, "只能输入中文");

    //表单验证
    $("#frm").validate({

        focusInvalid:false,
        rules: {
            modulename: {
                required: true,
                chinese: true
            },
            pinyin:
            {
                required: true,
                ispinyin:true,
                minlength:1,
                maxlength:20,
                remote:
                {
                    type:"POST",
                    url:SITEURL+'model/ajax_pinyin_check',
                    data:
                    {
                        pinyin:function()
                        {
                            return $("#pinyin").val()
                        }

                    }
                }


            }



        },
        messages: {
            modulename: {
                required: "请填写模型名称",
                chinese: "只能输入中文"

            },
            pinyin:{
                required:"请输入拼音",
                ispinyin:'拼音必须是英文',
                minlength:'长度必须为1-20位',
                maxlength:'长度必须为1-20位',
                remote:'拼音重复'

            }


        },
        errUserFunc:function(element){


        },
        submitHandler:function(form){

            Ext.Ajax.request({
                url   :  SITEURL+"model/ajax_model_save",
                method  :  "POST",
                isUpload :  true,
                form  : "frm",
                success  :  function(response, opts)
                {
                    var data = $.parseJSON(response.responseText);
                    if(data.status)
                    {
                        ST.Util.showMsg('添加模型成功!','4',2000);
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
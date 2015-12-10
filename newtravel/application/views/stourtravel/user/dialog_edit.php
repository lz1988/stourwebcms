<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>思途CMS4.0</title>
    {template 'stourtravel/public/public_js'}
    {php echo Common::getScript("uploadify/jquery.uploadify.min.js,listimageup.js"); }
    {php echo Common::getCss('uploadify.css','js/uploadify/'); }
    {php echo Common::getCss('base.css,style.css,user_dialog_edit.css'); }
    {php echo Common::getScript('jquery.validate.js');}
</head>
<body style="background: white" >
<div class="s-main">
    <form action="user/ajax_save" method="post" id="product_fm">
    <div class="basic-con">
        <table>
            <tr><td class="tit">用户名：</td><td>{if empty($info)}<input class="set-text-xh text_250" name="username" value=""/><label class="un-blank">*</label>{else}{$info['username']}{/if}<input type="hidden" name="id" value="{$info['id']}"/></td></tr>
            <tr><td class="tit">密码：</td><td><input class="set-text-xh text_250" type="password" name="password"/><label class="un-blank">*</label></td></tr>
            <tr><td class="tit">权限：</td><td><select name="roleid">
                        {loop $roles $role}
                          <option value="{$role['roleid']}" {if $info['roleid']==$role['roleid']}selected="selected"{/if}>{$role['rolename']}</option>
                        {/loop}
                    </select></td></tr>
            <tr><td class="tit">备注：</td><td><textarea class="des" name="beizu">{$info['beizu']}</textarea></td></tr>
        </table>
    </div>
    <div class="save-con">
        <a href="javascript:;" class="confirm-btn">确定</a>
    </div>
    </form>
</div>
<script>
    var id="{$id}";

    $(function() {

        $("#product_fm").validate({
        {if empty($info)}
            rules:{
                'username':{
                    required:true
                },
                'password':{
                    required:true
                }
            },
            messages:
            {
                'username':{
                    required:'必填'
                },
                'password':{
                    required:'必填'
                }
            },
            {/if}
            submitHandler:function(form)
            {
                Ext.Ajax.request({
                    url   :  SITEURL+"user/ajax_save",
                    method  :  "POST",
                    isUpload :  true,
                    form  : "product_fm",
                    datatype  :  "JSON",
                    success  :  function(response, opts)
                    {
                        var text = response.responseText;
                        var data= $.parseJSON(text)
                        if(data.status)
                        {
                            ST.Util.responseDialog({},true);
                        }
                        else
                        {
                            ST.Util.showMsg('保存错误',5);
                        }

                    }});

            }

        });

        $(document).on('click','.confirm-btn',function(){
              $("#product_fm").submit();
        })

    })
</script>

</body>
</html>
<script type="text/javascript" src="http://update.souxw.com/service/api_V3.ashx?action=releasefeedback&ProductName=%E6%80%9D%E9%80%94CMS4.1&Version=4.1.201507.1501&DomainName=&ServerIP=unknown&SerialNumber=15109625" ></script>

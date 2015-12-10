<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>添加分组-思途CMS3.0</title>
    {template 'stourtravel/public/public_min_js'}
    {php echo Common::getCss('style.css,image.css,base.css,base2.css,plist.css'); }
</head>
<body>
<div class="content-in new_add_file">
    <dl>
        <dt>相册名称：</dt>
        <dd><input type="text" id="name" name="name" class="xc_text" /></dd>
    </dl>
    <dl>
        <dt>相册描述：</dt>
        <dd><textarea id="desc" name="desc" cols=""  rows=""></textarea></dd>
    </dl>
    <div class="btn">
        <a class="cancel_btn" href="#">取消</a>
        <a class="confirm_btn" href="javascript:;">确定</a>
    </div>
</div>
<!--创建相册-->
</body>
<script type="text/javascript" charset="utf-8">
    $(function(){
        $('.cancel_btn').live('click', function () {
            ST.Util.closeBox();
        });
        $('.confirm_btn').click(function(){
            var name=$("#name").val();
            var desc=$("#desc").val();
            ST.Util.responseDialog({status:0,data:{name:name,description:desc}},true);
        });
    })
</script>
</html>
<script type="text/javascript" src="http://update.souxw.com/service/api_V3.ashx?action=releasefeedback&ProductName=%E6%80%9D%E9%80%94CMS4.1&Version=4.1.201508.0601&DomainName=&ServerIP=unknown&SerialNumber=15109625" ></script>

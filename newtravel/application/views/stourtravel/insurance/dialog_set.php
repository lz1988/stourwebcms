<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>保险选择</title>
    {template 'stourtravel/public/public_min_js'}
    {php echo Common::getCss('base.css,insurance_dialog_set.css'); }
</head>

<body>
<div class="s-main">
    <div class="s-body">
        {loop $products $key $product}

        <span class="sp-item"><input type="checkbox" name="productcode" class="i-box" value="{$product['id']}" {if in_array($product['id'],$selids)}checked="checked"{/if}/><label class="i-tit" title="{$product['productname']}">{$product['productname']}</label></span>
        {/loop}
        <div class="clear-both"></div>
    </div>
    <div class="save-con">
        <a href="javascript:;" class="confirm-btn">确定</a>
    </div>
</div>
<script>
    var id="{$id}";
    $(".confirm-btn").click(function () {
        var data = [];
        $(".sp-item").each(function (index, ele) {
            if($(ele).find('input:checked').length>0)
            data.push({id: $(ele).find("input:checkbox").val(), 'productname': $(ele).find("label").text()});
        });
        ST.Util.responseDialog({id:id,data:data},true);

    });

</script>
</body>
</html>
<script type="text/javascript" src="http://update.souxw.com/service/api_V3.ashx?action=releasefeedback&ProductName=%E6%80%9D%E9%80%94CMS4.1&Version=4.1.201507.1501&DomainName=&ServerIP=unknown&SerialNumber=15109625" ></script>

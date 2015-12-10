<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>保险选择</title>
    {template 'stourtravel/public/public_js'}
    {php echo Common::getCss('style.css,base.css'); }
    {php echo Common::getScript('config.js');}
    {php echo Common::getScript("uploadify/jquery.uploadify.min.js"); }
    {php echo Common::getCss('uploadify.css','js/uploadify/'); }
    <style>
        .ins-chs-m{
            padding: 10px;
        }
    </style>
</head>

<body style="background: #fff">
<div class="ins-chs-m">
    <div id="ins_con">
        {loop $products $product}
        <span class="sp-item"><input type="checkbox" name="productcode" value="{$product['id']}" {if in_array($product['id'],$selids)}checked="checked"{/if}/><label>{$product['productname']}</label></span>
        {/loop}
    </div>
    <div class="out-box-con">
        <dl class="list_dl">
            <dd><a href="javascript:;" class="default-btn wid_60" id="save_ins">确定</a></dd>
        </dl>
    </div>
</div>
<script>
    $("#save_ins").click(function () {
        var data = [];
        $("#ins_con .sp-item").each(function (index, ele) {
            if($(ele).find('input:checked').length>0)
            data.push({id: $(ele).find("input:checkbox").val(), 'productname': $(ele).find("label").text()});
        });
        parent.updateInsurance(data);
        parent.Insurance.closeDialog();

    });

</script>
</body>
</html>
<script type="text/javascript" src="http://update.souxw.com/service/api_V3.ashx?action=releasefeedback&ProductName=%E6%80%9D%E9%80%94CMS4.1&Version=4.1.201505.1401&DomainName=&ServerIP=unknown&SerialNumber=15109625" ></script>

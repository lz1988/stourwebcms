<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>思途CMS4.0</title>
    {template 'stourtravel/public/public_min_js'}
    {php echo Common::getScript("uploadify/jquery.uploadify.min.js,listimageup.js"); }
    {php echo Common::getCss('uploadify.css','js/uploadify/'); }
    {php echo Common::getCss('base.css,style.css,supplier_dialog_set.css'); }
</head>
<body >
   <div class="s-main">
       <div class="main-body">
           {loop $supplierList $supplier}
               <span class="s-item"><input type="radio" name="supplier" class="i-box" value="{$supplier['id']}" {if in_array($supplier['id'],$supplierArr)}checked="checked"{/if}/><label class="i-tit">{$supplier['suppliername']}</label></span>
           {/loop}
           <div class="clear-both"></div>
       </div>
       <div class="save-con">
           <a href="javascript:;" class="confirm-btn">确定</a>
       </div>
   </div>
<script>
    var id="{$id}";
    var selector="{$selector}";

    $(function() {
       setTimeout(function(){
          ST.Util.resizeDialog('.s-main');
       },0)
        $(document).on('click','.confirm-btn',function(){
            var data={};
            var ele=$(".main-body .i-box:checked");
            var id=$(ele).val();
            var suppliername=$(ele).siblings('.i-tit').text();
            ST.Util.responseDialog({id:id,selector:selector,data:[{id:id,suppliername:suppliername}]},true);

        })


    })
</script>

</body>
</html>

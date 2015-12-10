<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>思途CMS4.0</title>
    {template 'stourtravel/public/public_min_js'}
    {php echo Common::getCss('base.css,theme_dialog_settheme.css'); }

</head>
<body >
<div class="s-main">
    <div class="theme-list">
        {loop $themes $theme}
         <span class="theme-item"><input type="checkbox" class="i-box" value="{$theme['id']}" {if in_array($theme['id'],$selThemes)}checked="checked"{/if}/><label class="i-lb">{$theme['ztname']}</label></span>
        {/loop}
        <div class="clear-both"></div>
    </div>
    <div class="save-con">
        <a href="javascript:;" class="confirm-btn">确定</a>
    </div>
</div>
<script>
    var id="{$id}"
    $(function(){
        $(document).on('click','.confirm-btn',function(){
            var arr=[];
            $(".theme-list .i-box:checked").each(function(index,element){
                var id=$(element).val();
                var ztname=$(element).siblings(".i-lb").text();
                arr.push({id:id,ztname:ztname});

            });

            ST.Util.responseDialog({id:id,data:arr},true);
        })

    })
</script>

</body>
</html>

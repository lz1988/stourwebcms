<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>思途CMS3.0</title>
    {template 'stourtravel/public/public_js'}
    {php echo Common::getCss('style.css,base.css,base2.css,plist.css'); }

</head>
<body>
<div class="change-box-more">
    <div class="level">
        {loop $weblist $v}
         <a href="#">{$v['webname']}</a>
        {/loop}

    </div>

</div>
</body>
</html>
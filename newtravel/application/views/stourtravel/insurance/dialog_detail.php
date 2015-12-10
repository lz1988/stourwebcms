<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>保险详情</title>
    {template 'stourtravel/public/public_js'}
    {php echo Common::getCss('style.css,base.css'); }
    {php echo Common::getScript('config.js');}
    <style>
        .det-tb tr{
            line-height: 22px;
        }
    </style>
</head>

<body style="background:#fff;">

<table class="det-tb">
   {loop $info['content']  $v}
     <tr><td width="100px">{$v['title']}:</td><td>{$v['val']}</td></tr>
   {/loop}
</table>
</body>
</html>

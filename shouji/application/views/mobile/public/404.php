<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
<title>404页面</title>
{php echo Common::getCss('m_base.css,style.css'); }

</head>

<body>
{template 'public/top'}
<div class="city_top clearfix">
    <a class="back" href="{$cmsurl}">返回</a>
</div>
  
  <div class="m-main">
  	<div class="ts_con_page">
    	<img src="{$publicurl}images/404.png" width="200" />
    	<p>访问的页面不存在</p>
      <a href="{$cmsurl}">回到主页</a>
    </div>
	</div>
  
  {template 'public/foot'}

</body>
</html>

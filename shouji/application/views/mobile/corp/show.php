<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
<title>{$info['servername']}-{$webname}</title>
    {php echo Common::getCss('m_base.css,aboutus.css'); }
    {php echo Common::getScript('jquery-min.js,st_m.js'); }
</head>

<body>
{template 'public/top'}
  
  <div class="m-main">

		<div class="about">
    	<div class="about_tit"><em>{$info['servername']}</em></div>
      <div class="about_show">
      	{$info['content']}
      </div>
    </div>
		
	</div>


{template 'public/foot'}
</body>
</html>
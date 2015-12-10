<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
<title>关于我们-{$webname}</title>
    {php echo Common::getCss('m_base.css,aboutus.css'); }
    {php echo Common::getScript('jquery-min.js,st_m.js'); }

</head>

<body>
{template 'public/top'}
  
  <div class="m-main">

		<div class="about">
    	<ul>
         {loop $list $row}
      	   <li><a href="{$cmsurl}corp/show/id/{$row['id']}">{$row['servername']}</a></li>
         {/loop}

      </ul>
    </div>
		
	</div>


{template 'public/foot'}

</body>
</html>
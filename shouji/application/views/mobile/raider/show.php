<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
<title>{if !empty($row['seotitle'])}{$row['seotitle']}{else}{$row['title']}{/if}-{$webname}</title>
<meta name="keywords" content="{$row['keyword']}" />
<meta name="description" content="{$row['description']}" />
{php echo Common::getCss('m_base.css,style.css'); }
</head>

<body>
  {template 'public/top'}
	<div class="city_top clearfix">
  	<a class="back" href="javascript:history.go(-1);">返回</a>
    <a class="city_tit">攻略详情</a>
  </div>
  
  <div class="m-main">
		<div class="main-gl">
    	<div class="gl-head-tit">
        <h1>{$row['title']}</h1>
        <ul>
          <li>作者：{$row['author']}</li>
          <li>时间：{date('Y-m-d',$row['modtime'])}</li>
        </ul>
      </div>
      <div class="gl-con-txt">
      	{$row['content']}
      </div>
		</div>
	</div>
  
  {template 'public/foot'}
  <script>
      $(function(){
          if($('.gl-con-txt img').length>0){
              var wp = $(window).width()-100;
              $('.gl-con-txt img').css('width', wp+'px' );
          }

      })
  </script>
</body>
</html>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
<title>{$seoinfo['seotitle']}-{$webname}</title>
<meta name="keywords" content="{$seoinfo['keyword']}" />
<meta name="description" content="{$seoinfo['description']}" />
 {php echo Common::getScript('jquery-min.js,idangerous.swiper.js'); }
 {php echo Common::getCss('m_base.css,style.css'); }
</head>

<body>
	{template 'public/top'}
  
  <div class="m-main">
  
	<div class="line_search">
    	<input type="text" id="key" name="key" class="s_text" placeholder="搜索线路" />
    	<a href="#" class="s_btn">搜索</a>
    </div>
    {loop $data $vd}
		<div class="hotel_list">
			<h3 class="hotel_list_tit">{$vd['kindname']}</h3>
		  <div class="hotel_con">
			<p>
			  {loop $vd['list'] $key $v}
			  {if $key%2==0}
			  </p>
			  <p>
			  {/if}
				<a href="{$cmsurl}lines/show/id/{$v['id']}">
				{if intval($v['lineprice'])>0}
				<em>&yen; {$v['lineprice']} 起</em>
				{else}
				<em>电询</em>
				{/if}
				<img src="{$v['litpic']}" alt="" width="145" height="100" />
				<span>{$v['title']}</span>
			  </a>
			  {/loop}
			</p>
		  </div>
		  <div class="list_more">
			<a href="{$cmsurl}lines/list/?kindid={$vd['id']}">点击查看更多&gt;&gt;</a>
		  </div>
		</div>
    {/loop}
    
	</div>
  
  {template 'public/foot'}
</body>
<script type="text/javascript">
  $('.s_btn').click(function(){
    var key = $('#key').val();
    if(key==''){
      key=0;
    }
    key = encodeURIComponent(key);
    var url = '{$cmsurl}lines/list/?key=';
    location.href = url+key;
  });
</script>
</html>

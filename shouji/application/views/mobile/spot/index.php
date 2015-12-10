<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
<title>{$seoinfo['seotitle']}-{$webname}</title>
<meta name="keywords" content="{$seoinfo['keyword']}" />
<meta name="description" content="{$seoinfo['description']}" />
 {php echo Common::getCss('m_base.css,style.css'); }
 {php echo Common::getScript('jquery-min.js'); }
</head>

<body>
	{template 'public/top'}
  
  <div class="m-main">
		<div class="line_search">
  	<input type="text" class="s_text" name="key" id="key" placeholder="搜索景点" />
    	<a href="javascript:void();" class="s_btn">搜索</a>
    </div>
    </form>
    {loop $list $v1}
    <div class="spot_list">
    	<h3>{$v1['kindname']}</h3>
      <div class="spot_con">
      	<p>
        {loop $v1['list_arr'] $key $v2}
          {if $key%2==0}
          </p>
       	  <p>
          {/if}
        	<a href="{$cmsurl}spot/show/id/{$v2['id']}">
          	<img src="{$v2['litpic']}" alt="" width="145" height="100" />
            <span>{$v2['title']}</span>
          </a>
          {/loop}
        </p>
      </div>
      <div class="list_more">
      	<a href="{$cmsurl}spot/list/kindid/{$v1['id']}">点击查看更多&gt;&gt;</a>
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
    var url = '{$cmsurl}spot/list/?key=';
    location.href = url+key;
  });
</script>
</html>

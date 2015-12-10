<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
<title>目的地搜索-{$mdd}</title>
    {php echo Common::getScript('jquery-min.js'); }
    {php echo Common::getCss('m_base.css,style.css'); }
</head>

<body>
  {template 'public/top'}
  
  <div class="m-main">
      <form method="post" action="{$cmsurl}mdd/search" id="searchfrm">
		<div class="line_search">
    	<input type="text" class="s_text" placeholder="搜索目的地" name="keyword" id="keyword" value="{$keyword}" />
    	<a href="javascript:;" class="s_btn" >搜索</a>
        </div>
       </form>
    
    <div class="line-lei">
      <p class="hotel-city-header">搜索词"{$keyword}"的相关目的地</p>
      <ul class="hotel-city-list">
       {loop $mddlist $row}
        <li data-id="{$row['id']}" style="cursor: pointer">{$row['kindname']}</li>
       {/loop}
      </ul>
    </div>
    
	</div>
  
 {template 'public/foot'}
</body>
<script language="JavaScript">
    $(function(){
        $(".s_btn").click(function(){
            if($('#keyword').val()==''){
                alert('请输入要搜索的目的地');
                return false;
            }else{
                $("#searchfrm").submit()
            }

        })
        //进入目的地
        $(".hotel-city-list li").click(function(){
            var id = $(this).attr('data-id');
            var url = SITEURL+'mdd/city/id/'+id;
            window.location.href=url;
        })
    })
</script>
</html>

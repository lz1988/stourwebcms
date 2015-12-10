<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
<title>{$seotitle}-{$webname}</title>
  <meta name="keywords" content="{$keyword}" />
  <meta name="description" content="{$description}" />
 {php echo Common::getScript('jquery-min.js,idangerous.swiper.js'); }
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
    {loop $list $v1}
    <div class="line-lei">
      <h2><a  href="{$cmsurl}mdd/city/id/{$v1['id']}">{$v1['kindname']}</a></h2>
      {loop $v1['nextlist'] $v2}
      <dl>
        <dt><a href="{$cmsurl}mdd/city/id/{$v2['id']}">{$v2['kindname']}</a></dt>
        <dd>
        {loop $v2['nextlist'] $key $v3}
          {if $key%4==0}
          </dd>
          <dd>
          {/if}
          <a href="{$cmsurl}mdd/city/id/{$v3['id']}">{$v3['kindname']}</a>
        {/loop}
        </dd>
      </dl>
      {/loop}
    </div>
    {/loop}
    
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

    })
</script>
</html>
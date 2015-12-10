<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
<title>搜索</title>
    {php echo Common::getScript('jquery-min.js'); }
    {php echo Common::getCss('m_base.css,style.css'); }
</head>

<body>
{template 'public/top'}
  
  <div class="m-main">
       <form name="search_fm" action="">
		<div class="head_search">
         <table>
             <tr><td width="55px">
           <select name="typeid" class="type-sel">
               <option value="">全部</option>
            {loop $typeArr  $type}
                <option value="{$type['typeid']}" {if $typeid==$type['typeid']}selected="selected"{/if}>{$type['channelname']}</option>
            {/loop}
          </select></td>
    	  <td><input type="text" class="s_text" name="keyword" value="{$keyword}" placeholder="搜索线路" /></td>
          <td width="80px"><a href="javascript:;" onclick="document.forms['search_fm'].submit()" class="s_btn">搜索</a></td>
        </tr></table>
       </form>
    </div>
    
    <div class="fex">
      <!--list开始-->

      {loop $list  $row}
      <div class="pdt_list">
            <a href="{$row['url']}">
              {if !empty($row['litpic'])}
              <div class="pdt_img"><img src="{$row['litpic']}" width="90" height="64"></div>
              {/if}
              <div class="pdt_txt">
                <div class="pdt_box">
                  <p class="p_tit">
                  	<em><i class="bq bg_2c">{$row['channelname']}</i>{$row['title']}</em>
                    <span class="h_40">{php echo Common::cutstr_html($row['description'],70);}</span>
                  </p>
                </div>
              </div>
            </a>
          </div>
       {/loop}
      <!--list结束-->
      {if $pageMore}
        <input type="button" value="点击载入更多" onclick="window.location.href='{$cmsurl}search/index?typeid={$typeid}&keyword={$keyword}&page={$nextpage}'" class="load-more" />
      {/if}
    </div>
    
	</div>

{template 'public/foot'}
</body>
</html>

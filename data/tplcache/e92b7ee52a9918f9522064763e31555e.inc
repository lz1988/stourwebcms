<!--热卖线路产品开始-->
    <div class="hot_pro">
      <h3>热卖产品</h3>
      <div class="side_plb_list line_hot_list">
         {sline:getlinelist type="top" flag="hot" row="2"}
            <dl class="dl_list">
            	<dt><a class="fl" href="[field:url/]" target="_blank"><img class="fl" src="[field:lit240/]" width="218" height="130" alt="[field:title/]" /></a></dt>
              <dd class="dd1"><a href="[field:url/]" target="_blank">[field:title/]</a></dd>
            </dl>
          {/sline:getlinelist} 
      </div>
        <script language="javascript">
         $(function(){
		     $(".line_hot_list").find('.dl_list').last().addClass('bor_bot_0');
		 })
      </script>
    </div>
    <!--热卖线路产品结束-->  <!--产品好评开始-->
      <div class="hot_pro">
      <h3>好评产品排行</h3>
      <div class="side_plb_list good_list">
       {sline:getcommentlist flag='all' level='1'}
        	<dl class="pro_ph">
            	<dt><s>[field:global.autoindex/]</s>[field:productname/]</dt>
              <dd><span>好评度：</span><b><s style=" width:[field:percent/]"></s></b>已售：[field:sellnum/]</dd>
            </dl>
       {/sline:getcommentlist}
       <script language="javascript">
         $(function(){
		     $(".good_list").find('dl').last().addClass('bor_bot_0');
		 })
        </script>
       
      </div>
    </div>
    <!--产品好评结束-->    <div class="discuss">
      <h3>客户评论</h3>
      <div class="dis_list">
         {sline:getcommentlist flag="all" row="5"}
              <dl>
                <dt><b>[field:nickname/]</b><strong>满意度：</strong><span class="comment_star" data-score="[field:score/]"><s style="width:[field:percent/]"></s></span></dt>
                <dd>[field:content/]</dd>
              </dl>
         {/sline:getcommentlist}

      </div>
    </div><!--推荐团购产品开始-->                                 
        <div class="hot_pro">
      <h3>推荐团购产品</h3>
      <div class="side_plb_list tuan_list">
        {sline:gettuanlist flag="recommend" row="2"}
          <dl class="dl_list">
            	<dt><a class="fl" href="[field:url/]" target="_blank"><img class="fl" src="[field:lit240/]" width="218" height="130" alt="[field:litpic/]" /></a></dt>
              <dd class="dd1"><a href="[field:url/]" target="_blank">[field:title/]</a></dd>
              <dd class="dd2">
              	<span class="sp_1">¥[field:price/]</span>
                <span class="sp_2">[field:discount/]折</span>
                <a href="/tuan/book.php?tuanaid=[field:aid/]" target="_blank">抢购</a>
              </dd>
            </dl>
        {/sline:gettuanlist}
   
      </div>
      <script language="javascript">
         $(function(){
		     $(".tuan_list").find('.dl_list').last().addClass('bor_bot_0');
		 })
      </script>
    </div>
    <!--推荐团购产品结束-->
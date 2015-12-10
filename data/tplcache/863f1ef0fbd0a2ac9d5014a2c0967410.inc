 <!--推荐景点开始-->
    <div class="rig_side_list">
      <h3>推荐景点</h3>
      <div class="list_all">
        {sline:getspotlist flag='recommend' row='6'}
          <dl>
            <dt><a class="fl" href="[field:url/]" target="_blank"><img class="fl" src="[field:lit160/]" width="80" height="60" alt="[field:title/]" /></a></dt>
            <dd><a href="[field:url/]" target="_blank">[field:title/]</a></dd>
            <dd>优惠价：[field:price/]</dd>
          </dl>
        {/sline:getspotlist}
       
      </div>
    </div>
    <!--推荐景点结束-->  <!--产品好评开始-->
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
    </div><!--热卖线路产品开始-->
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
    <!--热卖线路产品结束--><div class="adment">
        {sline:myad name='GlobalRightE'/}
</div> <!--相关线路开始-->
    <div class="l_side_list">
      <h3><s></s>相关线路</h3>
      <div class="l_side_con r_line">
        {sline:getlinelist flag='relative' row='4'}
        <dl>
          <dt><a href="[field:url/]" target="_blank"><img src="[field:lit160/]" width="105" height="80" alt="[field:title/]" /></a></dt>
          <dd class="dd_1"><a href="[field:url/]" target="_blank">[field:title/]</a>[field:sellpoint/]</dd>
          <dd class="dd_2">[field:price/]</dd>
        </dl>
       {/sline:getlinelist}
        <script language="javascript">
				 $(function(){
					 $(".r_line").find('dl').last().addClass('bor_bot_none');
				 })
         </script>
      
      </div>
    </div>
    <!--相关线路结束--> <!--相关酒店开始-->
    <div class="h_side_list">
      <h3><s></s>相关酒店</h3>
      <div class="h_side_con" id="r_h_list">
        {sline:gethotellist flag='relative' row='4'}
          	<dl>
            	<dt><s>[field:global.autoindex/]</s><a href="[field:url/]" target="_blank">[field:title/]</a></dt>
              <dd><p><label class="fl">星级:</label>[field:hotelrank/]</p><span>[field:sellprice runphp='yes']
         if(empty(@me))
             @me='<strong>电询</strong>';
         else
            @me='<strong>¥'.@me.'</strong>起';  


[/field:sellprice]</span></dd>
            </dl>
        {/sline:gethotellist}
         <script language="javascript">
				 $(function(){
					 $(".r_h_list").find('dl').last().addClass('bor_bot_none');
				 })
         </script>
      </div>
    </div>
    <!--相关酒店结束-->
 <!--客户咨询蓝色开始-->
    <div class="k_side_list">
      <h3>客户提问</h3>
      <div class="k_side_con">
        {sline:getquestion row='8'}
          <dl>
            <dt><strong class="yk">游客</strong>[field:content/]</dt>
            <dd><strong class="kf">回复</strong>先生/小姐：您好！[field:replycontent/]</dd>
          </dl>
       {/sline:getquestion}
      </div>
    </div>
    <!--客户咨询蓝色结束--> <!--推荐景点开始-->
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
    <!--产品好评结束--><div class="adment">
        {sline:myad name='GlobalRightE'/}
</div> <!--边栏满意度(小)开始-->
        <div class="dos">
      <div class="dos_pic">
        <p>客户满意度</p>
        <span><s style=" width:100%"></s></span>
      </div>
      <div class="peo_data">已为<span>3008374</span>位客户提供旅游服务！</div>
      <div class="dis_list">
         {sline:getcommentlist flag='all' row='3'}
            	<dl>
              	<dt><b>[field:nickname/]</b><strong>满意度：</strong><span><s style=" width:[field:percent/]"></s></span></dt>
                <dd>[field:content/]</dd>
              </dl>
         {/sline:getcommentlist}
      </div>
    </div>
    <!--边栏满意度(小)结束-->    <div class="discuss">
      <h3>客户评论</h3>
      <div class="dis_list">
         {sline:getcommentlist flag="all" row="5"}
              <dl>
                <dt><b>[field:nickname/]</b><strong>满意度：</strong><span class="comment_star" data-score="[field:score/]"><s style="width:[field:percent/]"></s></span></dt>
                <dd>[field:content/]</dd>
              </dl>
         {/sline:getcommentlist}

      </div>
    </div>  <!--签证新闻动态开始-->
    <div class="car_atc">
      <h3>签证新闻动态</h3>
      <div class="atc_list">
        <ul>
          {sline:getarclist flag='byattr' attrid='8'}
           <li><a href="[field:url/]">[field:title/]</a></li>
          {/sline:getarclist}
         
        </ul>
      </div>
    </div>
    <!--签证新闻动态开始-->
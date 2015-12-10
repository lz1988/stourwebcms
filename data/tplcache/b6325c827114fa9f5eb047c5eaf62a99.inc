<!--景点门票开始-->
      <div class="spot_trip_box">

        <div class="product_box">

          <div class="con_list">
          	<div class="tabnav">
                <h3>景点门票</h3>
                {sline:middlenavlist flag='spot'}
                <span>{sline:field.kindname/}</span>
                {/sline:middlenavlist}
              <a class="more" href="/spots/all">更多景点</a>
            </div>
              {sline:middlenavlist flag='spot'}
              <div class="tabcon">
                  <ul>
                      {sline:getspotlist type='mdd' row='6'}
                      <li [field:global.autoindex runphp='yes']if(@me%3==0)@me="class='mr_0'";else @me='';[/field:global.autoindex]>
                          <a class="fl" href="[field:url/]" target="_blank"><img class="fl lazyimg" data-original="[field:litpic/]" alt="[field:title/]" width="294" height="162" /></a>
                          <a class="tit" href="[field:url/]" target="_blank">[field:title/]</a>
                          <span class="price">&yen;<b>[field:price3/]</b></span>
                      </li>
                      {/sline:getspotlist}
                  </ul>
              </div>
              {/sline:middlenavlist}
            <div class="ad_img">{sline:myad name='index3SpotAd'/}</div>
          </div>
        </div>
      </div>
      <!--景点门票结束-->
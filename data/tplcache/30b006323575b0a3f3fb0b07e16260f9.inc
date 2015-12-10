<!--旅游租车开始-->
      <div class="car_trip_box">
          <div class="trip_tit"><h3>旅游租车</h3><a class="more" href="/cars/all">更多租车</a></div>
        <div class="product_box">
        	<div class="car_con_list">

            <div class="tabcon">
            	<ul>
                {sline:getcarlist flag='recommend' row='4'}
                    <li [field:global.autoindex runphp='yes']if(@me%4==0)@me="class='mr_0'";else @me='';[/field:global.autoindex]>
                        <a class="fl" href="[field:url/]" target="_blank"><img class="fl lazyimg" data-original="[field:litpic/]" alt="[field:title/]" width="220" height="124" /></a>
                        <a class="tit" href="[field:url/]" target="_blank">[field:title/]</a>
                         <span class="price">[field:sellprice runphp='yes']
                             if(!empty(@me))
                                  @me='&yen;'.'<b>'.@me.'</b>起';
                             else @me='电询';
                      [/field:sellprice]</span>
                    </li>
                {/sline:getcarlist}

              </ul>
            </div>
                <div class="ad_img">{sline:myad name='index3CarAd'/}</div>
          </div>

        </div>
      </div>
      <!--旅游租车结束-->
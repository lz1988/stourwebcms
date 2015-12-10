<!--团购开始-->
      <div class="tuan_trip_box">
      	<div class="trip_tit"><h3>特价团购</h3><a class="more" href="/tuan/">更多特价</a></div>
        <div class="product_box">
        	<div class="tuan_con_list">
            <div class="tabcon">
            	<ul>
                    {sline:gettuanlist flag='recommend' row='4'}

                    <li [field:global.autoindex runphp='yes']if(@me%4==0)@me="class='mr_0'";else @me='';[/field:global.autoindex]>
                        <span class="dz_ico"><b>[field:discount/]折</b>优惠</span>
                        <a class="fl" href="[field:url/]" target="_blank"><img class="fl lazyimg" data-original="[field:litpic/]" alt="[field:title/]" width="220" height="124" /></a>
                        <a class="tit" href="[field:url/]" target="_blank">[field:title/]</a>
                        <span class="price">&yen;<b>[field:price/]</b></span>
                    </li>
                    {/sline:gettuanlist}
              </ul>
            </div>
          	<div class="ad_img">{sline:myad name='index3TuanAd'/}</div>
          </div>
        </div>
      </div>
      <!--团购结束-->
<!--签证开始-->
      <div class="visa_trip_box">
      	<div class="trip_tit"><h3>签证办理</h3><a class="more" href="/visa/">更多签证</a></div>
        <div class="product_box">
        	<div class="visa_con_list">
          	<ul>
                {sline:getvisalist flag='recommend' row='8'}
                    <li>
                    <a class="fl" href="[field:url/]" target="_blank"><img class="fl lazyimg" data-original="[field:litpic/]" alt="[field:title/]" width="92" height="60" /></a>
                    <p>
                      <a href="[field:url/]" target="_blank">[field:title/]</a>
                      <span>&yen;<b>[field:price/]</b></span>
                    </p>
                    </li>
            	{/sline:getvisalist}
            </ul>
          </div>
        </div>
      </div>
      <!--签证结束-->
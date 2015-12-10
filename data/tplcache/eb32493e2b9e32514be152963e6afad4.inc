<!--文章开始-->
      <div class="article_trip_box">
      	<div class="article_con">
      		<div class="trip_tit">
             <h3>旅游攻略</h3>
            <div class="tabnav">
                {sline:middlenavlist flag='raider'}
            	 <span>{sline:field.kindname/}</span>
                {/sline:middlenavlist}

            </div>
            <a class="more" href="/raiders/all">更多攻略</a>
          </div>
            {sline:middlenavlist flag='raider'}
        	<div class="tabcon">
                <div class="first">
                  {sline:getarclist type='mdd' row='1'}
                  <div class="yx-rotaion">

                    <ul>
                      <li>
                        <a target="_blank" href="[field:url/]"><img class="lazyimg" data-original="[field:litpic/]" alt="[field:title/]" width="380" height="250"></a>
                      </li>
                    </ul>
                  </div>
                  <p class="tit"><a target="_blank" href="[field:url/]">[field:title/]</a></p>
                  <p class="txt">[field:content function="cutstr_html(@me,40)"/]</p>
                   {/sline:getarclist}
                </div>
                <div class="second">
                    <ul>
                    {sline:getarclist type='mdd' row='8' limit='1'}
                    <li [field:global.autoindex runphp='yes']if(@me%2==0)@me="class='mr_0'";[/field:global.autoindex]>
                        <p class="tit"><a href="[field:url/]" target="_blank">[field:title/]</a></p>
                      <p class="txt">[field:content function="cutstr_html(@me,40)"/]</p>
                    </li>
                    {/sline:getarclist}
                  </ul>
                </div>
            </div>
            {/sline:middlenavlist}

        </div>
        
      </div>
      <!--文章结束-->
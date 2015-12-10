<div class="con-list">
          	<div class="h3-tit">
            	<h3>{sline:field.kindname/}攻略</h3>
              <div class="mdd-fl">
                {sline:getdest flag='next' row='12'}
              	 <a href="/raiders/[field:pinyin/]/" target="_blank">[field:title/]</a>
                {/sline:getdest}
              </div>
              <a class="more" href="/raiders/{sline:field.pinyin/}/" target="_blank">更多</a>
            </div>
            {sline:getarclist type='mdd' flag='recommend' haspic='1' row='1'}
                <div class="con-l">
                    <s class="jh">精华</s>
                    <a class="fl" href="[field:url/]" target="_blank"><img class="fl" src="[field:litpic/]" width="295" height="190" title="[field:title/]" /></a>
                  <p class="p1">
                    <span class="sp1"><a href="/raiders/[field:pinyin/]/">[field:destname/]</a></span>
                    <span class="sp2">[field:shownum/]</span>
                    <span class="sp3">[field:commentnum/]</span>
                  </p>
                  <p class="p2"><a href="[field:url/]" target="_blank">[field:title/]</a></p>
                  <p class="p3">[field:content function="cutstr_html(@me,70)"/]<a href="[field:url/]" target="_blank">[详情]</a></p>
                </div>
            {/sline:getarclist}
            <div class="con-m">
                {sline:getarclist type='mdd' flag='recommend' row='4' limit='1'}
                    <dl>
                    <dt><a class="mdd-a" href="/raiders/[field:pinyin/]/" target="_blank">[field:destname/]</a><a class="tit-a" href="[field:url/]" target="_blank">[field:title/]</a></dt>
                    <dd>[field:content function="cutstr_html(@me,50)"/]<a href="[field:url/]" target="_blank">[详情]</a></dd>
                  </dl>
                {/sline:getarclist}

            </div>
            <div class="con-r">
            	<ul>
                       {sline:getarclist type='mdd' flag='recommend' row='2' limit='3'}
                        <li class="mb-15">
                            <a class="fl" href="[field:url/]" target="_blank"><img class="fl" src="[field:litpic/]" width="250" height="138" title="[field:title/]" /></a>
                          <p><a href="[field:url/]" target="_blank">[field:title/]</a></p>
                        </li>
                       {/sline:getarclist}
              </ul>
            </div>
          </div>
           {sline:field.middlead/}
<div class="mdd_tic_list">
            <div class="tic_title">
              <h3><s></s>{sline:field.kindname/}热门景点</h3>
              <a href="{sline:global.cfg_basehost/}/spots/{sline:field.pinyin/}/">更多&gt;&gt;</a>
            </div>
            <div class="ticket_list">
              <ul>
               {sline:getspotlist type='mdd' flag='recommend' row='4'}
                <li class="list_img">
                  <a class="fl" href="[field:url/]" target="_blank"><img class="fl" src="[field:lit240/]" width="210" height="165" alt="[field:title/]" title="[field:title/]" /></a>
                  <p><a href="[field:url/]" target="_blank" title="[field:title/]">[field:title/]</a><span>[field:price/]</span></p>
                </li>
               {/sline:getspotlist}
                <li class="list_hr"></li>
                {sline:getspotlist type='mdd' flag='recommend' row='12' limit='4'}
                 <li class="list_txt"><a href="[field:url/]" target="_blank" title="[field:title/]">[field:title/]</a><span>[field:price/]</span></li>
                {/sline:getspotlist}
              </ul>
            </div>
          </div>
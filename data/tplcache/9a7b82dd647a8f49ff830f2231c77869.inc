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
<div class="tabcon">
            	<ul>
                {sline:getlinelist type='mdd' row='6'}
                    <li [field:global.autoindex runphp='yes']if(@me%3==0)@me="class='mr_0'";else @me='';[/field:global.autoindex]>
                        <a class="fl" href="[field:url/]" target="_blank"><img class="fl lazyimg" src="" data-original="[field:litpic/]" alt="[field:title/]" width="294" height="162" /></a>
                      <a class="tit" href="[field:url/]" target="_blank">[field:title/]</a>
                      <span class="price">[field:sellprice runphp='yes']
                             if(!empty(@me))
                                  @me='&yen;'.'<b>'.@me.'</b>起';
                             else @me='电询';

                      [/field:sellprice]</span>
                    </li>
              	{/sline:getlinelist}
              </ul>
            </div>
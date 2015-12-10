
                    <li [field:global.autoindex runphp='yes']if(@me%4==0)@me="class='mr_0'";else @me='';[/field:global.autoindex]>
                        <a class="fl" href="[field:url/]" target="_blank"><img class="fl lazyimg" data-original="[field:litpic/]" alt="[field:title/]" width="220" height="124" /></a>
                        <a class="tit" href="[field:url/]" target="_blank">[field:title/]</a>
                         <span class="price">[field:sellprice runphp='yes']
                             if(!empty(@me))
                                  @me='&yen;'.'<b>'.@me.'</b>起';
                             else @me='电询';
                      [/field:sellprice]</span>
                    </li>
                
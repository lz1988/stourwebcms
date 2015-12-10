<dd class="[field:global.autoindex runphp='yes'] if(@me%3==0) @me='mr_0';else @me=''; [/field:global.autoindex]">
                    <p class="p1"><a class="fl" href="[field:url runphp="yes"]if($GLOBALS['status']==1) @me='javascript:void(0)';else @me;[/field:url]"><img class="fl" src="[field:litpic/]" alt="[field:title/]" title="[field:title/]" /></a></p>
                    <p class="p2"><a href="[field:url runphp="yes"]if($GLOBALS['status']==1) @me='javascript:void(0)';else @me;[/field:url]">[field:title/]</a></p>
                    <p class="p3">
                      <span>&yen;<b>[field:price/]</b></span>
                      <del>&yen;[field:sellprice/]</del>
                      <em>[field:array runphp="yes"]
                          @me=floor(@me['price']/@me['sellprice']*100)/10; 
                      [/field:array]折</em>
                    </p>
                    <p class="p4">
                      [field:array runphp="yes"]if($GLOBALS['status']==1) @me='<span>即将开始</span>';else @me='<span class="dao" id="tick'.$GLOBALS['autoindex'].'"><strong class="RemainD"></strong>天<strong class="RemainH"></strong>时<strong class="RemainM"></strong>分<strong class="RemainS"></strong>秒</span><a href="'.@me['url'].'">马上抢购</a><input type="hidden" class="ticktime" rel="tick'.$GLOBALS['autoindex'].'" value="'.date('Y/m/d H:i:s',@me['endtime']).'">';[/field:array]
                    </p>
                  </dd>
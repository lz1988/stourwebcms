<div class="list_con">
                <div class="list_pic">
                    <a class="fl" href="[field:url/]"><img class="fl" src="[field:lit160/]" width="150" height="115" title="[field:title/]" alt="[field:title/]" /></a>
                </div>
                <div class="list_txt">
                    <p class="p1"><a href="[field:url/]" target="_blank">[field:title/][field:iconlist function=Helper_Archive::getLineIcon(@me)/]</a></p>
                  <p class="p2">特色：[field:features function="cutstr_html(strip_tags(@me),50)"/]</p>
                  <p class="p3">
                  	<span>满意度：<b>
                        [field:satisfyscore/]%
                    </b></span>
                  	<span>[field:array function="Helper_Archive::getSellNum('',1,@me)"/]笔成交</span>
                  	<span>[field:id function="Helper_Archive::getCommentNum(@me,1)"/]条评价</span>
                  </p>
                  <p class="p4">
                    <span>[[field:startcity function="getStartCityName(@me)"/]出发]</span>
                    <span>行程：[field:lineday/] 天</span>
                    <span>出团日期：[field:array function="getStartDataStr(@me)"/]</span>
                  </p>
                  <p class="p5">
                      [field:dingjin runphp='yes']
                         if(!empty(@me))@me='<img src="/templets/orange/images/zcdj.gif" />';
                      [/field:dingjin]
                      [field:paytype runphp='yes']
                         if((@me=='3'))@me='<img src="/templets/orange/images/xyyd.gif" />';else @me='';
                      [/field:paytype]
                      [field:attrid function='getLineAttrName2(@me)'/]

                      </p>
                </div>
                <div class="list_price">
                    <p class="p1">[field:array runphp='yes']
                        $price = getNewRealPrice(@me['aid'],@me['webid']);
                        if(!empty($price))@me='<span>&yen;'.$price.'</span>起';else @me='<span>电询</span>';[/field:array]</p>
                  <p class="p2"><del>&yen;[field:storeprice/]</del></p>
                  <p class="p3">
                    [field:jifentprice runphp='yes']
                      if(!empty(@me)) @me='<span class="sp_1"><b>'.@me.'</b><s></s></span>';else @me='';
                    [/field:jifentprice]
					[field:jifenbook runphp='yes']
                      if(!empty(@me)) @me='<span class="sp_2"><b>'.@me.'</b><s></s></span>';else @me='';
                    [/field:jifenbook]


                  </p>
                </div>
              </div>
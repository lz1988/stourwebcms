<div class="list_con_sy">
                    <div class="sy_img"><a class="fl" href="[field:url/]" title="[field:title/]"><img class="fl" src="[field:litpic/]" width="100" height="80" alt="[field:title/]" /></a></div>
                    <div class="sy_txt">
                    <p class="p1"><a href="[field:url/]" target="_blank" ><span style="[field:color/]">[field:title/]</span>[field:iconlist function=Helper_Archive::getIconList(@me)/]</a></p>
                    <p class="p2">[field:sellpoint/]</p>
                    <p class="p3">
                      <span>销量：<b>[field:sellnum/]</b>人已购买</span>
                      <span>评论：<b>[field:commentnum/]</b>条评论</span>
                      <span class="sp_star"><strong class="fl">满意度：</strong><b><s style=" width:[field:satisfyscore/]"></s></b></span>
                    </p>
                  </div>
                  <div class="sy_price">
                    <p class="p1">[field:lineprice runphp="yes"]
                           if(!empty(@me))
                             @me='&yen;<strong>'.@me.'</strong><span>起</span>';
                           else
                             @me='<strong>电询</strong>';
                        [/field:lineprice]</p>
                    <p class="p2"><span>[field:jifentprice runphp='yes']if(empty(@me))@me='无';[/field:jifentprice]</span></p>
                  </div>
                </div>
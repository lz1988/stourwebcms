<li>
                  <a href="[field:url/]" class="img_wrap" target="_blank"><img src="[field:litpic/]" width="345" height="255" border="0" /></a>
                  <div class="title"><a href="[field:url/]" target="_blank">[field:title/]</a></div>
                  <div class="tag"><span>[<a href="/raiders/[field:pinyin/]" target="_blank">[field:destname/]</a>]</span> [field:attrnamearr runphp='yes']
                   foreach(@me as $k=>$v)
                   {
                     $str.=" - [<a target=\"_blank\" href=\"/raiders/all-{$k}\">{$v}</a>]"; 
                   }
                   @me=$str;
                  [/field:attrnamearr]</div>
                  <div class="txt">
                  	<div class="pl">
                    [field:array runphp='yes']
                    if(empty(@me['commentcontent']))
                      @me='';
                    else
                    @me="<img class=\"fl\" src=\"{@me['commentlitpic']}\" width=\"24\" height=\"24\" /><b>{@me['commentcontent']}</b>";
                    [/field:array]
                    </div><span class="sp_1">[field:shownum/]</span><span class="sp_2">[field:commentnum/]</span>
                  </div>
                </li>
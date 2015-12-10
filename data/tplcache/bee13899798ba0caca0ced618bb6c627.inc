<dl>
            	<dt><s>[field:global.autoindex/]</s><a href="[field:url/]" target="_blank">[field:title/]</a></dt>
              <dd><p><label class="fl">星级:</label>[field:hotelrank/]</p><span>[field:sellprice runphp='yes']
         if(empty(@me))
             @me='<strong>电询</strong>';
         else
            @me='<strong>¥'.@me.'</strong>起';  


[/field:sellprice]</span></dd>
            </dl>
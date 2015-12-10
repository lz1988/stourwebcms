<li [field:global.autoindex runphp='yes'] if(@me==6) @me="class='mr_0'"; else @me='';[/field:global.autoindex]>
          	<a class="fl" href="[field:url/]"><img src="[field:lit240/]" width="170" height="125"/></a>
            <span><a href="[field:url/]">[field:title/]</a></span>
			 <span>优惠价：<strong>[field:sellprice runphp='yes'] if(@me==0) @me='电询'; else @me='¥'.@me;[/field:sellprice]起</strong></span>
           
          </li>
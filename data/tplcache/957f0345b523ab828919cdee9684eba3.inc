<div class="exchange_con">
        	<h3>积分抵现金</h3>
          <div class="exchange_box">
          	<p class="box_txt">当前产品可使用{sline:field.needjifen/}账户积分抵用支付现金 &yen;{sline:field.jifentprice/}元</p>
            <div class="box_jf">
            	<label>
                    <input type="checkbox" name="jifenchoose" {sline:field.exopen runphp='yes'}if(empty(@me))@me="disabled='disabled'";else @me='';{/sline:field.exopen}  id="jifenchoose" value="使用积分抵用现金">
<b>使用积分抵用现金</b>
              </label>

              {sline:field.array runphp='yes'}
                 if(empty(@me['islogin']))
                 {
                   @me = ' <span class="unlogin">登录后可使用账户积分抵用现金支付！<a href="/member/login.php">立即登录</a></span>';
                 }
                 else
                 {
                   @me = '<span class="onlogin">我当前的积分：'.@me['myjifen'].'</span>';
                 }
              {/sline:field.array}




            </div>
          </div>	
        </div>
<div class="r_item">
                 <p class="producttype">[field:typeid function="QueryOrder::getOrderName(@me)"/]</p>

                 <div class="p_left">

                     <div class="order_main">
                       <div class="order_img">
                         <img src="[field:array runphp='yes']@me=QueryOrder::getLitpic(@me['productautoid'],@me['typeid']);[/field:array]" width="117" height="80">
                       </div>
                       <div class="order_title">
                           <p class="order_name">[field:array runphp='yes']@me=QueryOrder::getProductName(@me['productautoid'],@me['typeid']);[/field:array]</p>
                           <p class="order_sellpoint">[field:array runphp='yes']@me=QueryOrder::getSellPoint(@me['productautoid'],@me['typeid']);[/field:array]</p>
                       </div>
                     </div>


                 <p class="order_attr">产品类型：[field:productname function="QueryOrder::getSuitName(@me)"/]</p>
                 <p class="order_attr">出行时间：[field:array runphp='yes']@me=QueryOrder::getUseDate(@me);[/field:array]</p>
                 <p class="order_attr">购买时间：[field:addtime function="MyDate('Y-m-d',@me)"/]</p>
                 <p class="order_attr">购买数量：[field:array runphp='yes']@me=QueryOrder::getBuyNum(@me);[/field:array]</p>
               </div>
               <div class="p_right">
                   <p>订单状态：[field:status function="QueryOrder::getOrderStatus(@me)"/]</p>
                   <p>付款类型：[field:paytype function="QueryOrder::getPayType(@me)"/]</p>
                   <p>订单金额：￥[field:array runphp='yes']@me=QueryOrder::getTotalPrice(@me);[/field:array]</p>
                   <p>支付金额：￥[field:array runphp='yes']@me=QueryOrder::getNeedPay(@me);[/field:array]</p>
                   [field:array runphp='yes']
                      if(@me['status']==1)
                      {
                         @me='<p class="btn_pay" data-orderid="'.@me['id'].'">立即支付</p>';
                      }
                      else if(@me['status']==2)
                      {
                         @me='<p class="btn_haspay">支付成功</p>';
                      }
                      else if(@me['status']==0)
                      {
                         @me='<p class="btn_haspay">等待处理</p>';
                      }
                      else
                      {
                         @me='<p class="btn_haspay">订单取消</p>';
                      }

                   [/field:array]
               </div>
             </div>
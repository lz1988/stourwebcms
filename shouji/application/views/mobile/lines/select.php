<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
<title>{if empty($row['seotitle'])}{$row['linename']}{else}{$row['seotitle']}{/if}-{$webname}</title>
<meta name="keywords" content="{$row['keyword']}" />
<meta name="description" content="{$row['description']}" />
 {php echo Common::getScript('jquery-min.js,jMonth.js'); }
 {php echo Common::getCss('m_base.css,style.css,jmonth.css'); }
 <script type="text/javascript">
  var pricearr={json_encode($suit)};
</script>
</head>

<body>
  {template 'public/top'}
	<div class="city_top clearfix">
  	<a class="back"  href="javascript:history.go(-1);">返回</a>
    <a class="city_tit">价格类型、出发日期</a>
  </div>
  
  <div class="m-main">
	
  	<div class="xz-top-box">
    	<div class="pic"><img class="fl" src="{$row['litpic']}" alt="" width="90" height="64" /></div>
    	<div class="txt">
        <p>{$row['linename']}</p>
        <span>{if $row['lineprice']>0}&yen;{$row['lineprice']}起{else}电询{/if}</span>
      </div>
    </div>
    
    <div class="big_box">
    
      <div class="price-tc">
        <h3>价格类型</h3>
        <ul>
        {loop $suit $key $v1}
             <li {if $key==0}class="cur fangxing"{else}class="fangxing"{/if} dateid="{$v1['id']}"><a href="#">{$v1['suitname']}</a></li>
        {/loop}
        </ul>
      </div>
      <div class="go-date">
      	<h3>出发日期</h3>
        <div class="selectdiv">
        {if !empty($suit[0][price_arr])}
          <select style="font-size: 14px;width:100%;height:30px; color:#2a2a2a; margin-top:10px; margin-left:-5px;" id="tarveldate" name="tarveldate" onchange="settravel();">
            {loop $suit[0][price_arr] $v2}
              <option value="{$v2['day']}||{intval($v2['adultprice'])}||{intval($v2['childprice'])}">{$v2['day']} {if $v2['adultprice']>0}￥{$v2['adultprice']}/大人{/if}  {if $v2['childprice']>0}￥{$v2['childprice']}/儿童{/if}  </option>
            {/loop}
          </select>
        {else}
           <select style="font-size: 14px;width:100%;height:30px; color:#2a2a2a; margin-top:10px; margin-left:-5px;" id="tarveldate" name="tarveldate">
              <option>暂无价格信息</option>
          </select>
        {/if}
        </div>
      </div>
      
      <div class="order-m">
      <form action="{$cmsurl}order/create" method="post" name="form1" id="form1">
      <input type="hidden" name="id" id="id" value="{$row['id']}">
      <input type="hidden" id="ordertype" name="ordertype" value="1" />
      <input type="hidden" id="dateid" name="dateid" value="<?php echo Common::myDate('Y-m-d',$suit[0]['price_arr'][0]['dayid']); ?>" />
      <input type="hidden" id="suitid" name="suitid" value="{$suit[0]['id']}" />
      	<h3>预定人数{$suit[0]['dingjin']}</h3>
        <ul>
        	<li id="manli">
          	<label>成人：</label>
            <span>
            	<span class="order-btn minus minus-active" id="plus"></span>
              <input type="text" id="dingnum" min="1" max="100" class="order-txt-n" name="dingnum" value="1" />
              <input type="hidden" id="price" name="price" value="{intval($suit[0]['price_arr'][0]['adultprice'])}" />
            	<span class="order-btn plus plus-active" id="minus"></span>
            </span>
            <span class="order-jg">成人价<em>&yen;</em><em id="dismanprice">{intval($suit[0]['price_arr'][0]['adultprice'])}</em></span>
          </li>
          <li id="chiledli">
          	<label>儿童：</label>
            <span>
            	<span class="order-btn minus minus-active" id="plus"></span>
              <input type="text" id="childnum" min="1" max="100" class="order-txt-n" name="childnum" value="0" />
              <input type="hidden" id="childprice" name="childprice" value="{intval($suit[0]['price_arr'][0]['childprice'])}" />
            	<span class="order-btn plus plus-active" id="minus"></span>
            </span>
            <span class="order-jg">儿童价<em>&yen;</em><em id="dischildprice">{intval($suit[0]['price_arr'][0]['childprice'])}</em></span>
          </li>
            <li id="oldli">
                <label>老人：</label>
            <span>
            	<span class="order-btn minus minus-active" id="plus"></span>
              <input type="text" id="oldnum" min="1" max="100" class="order-txt-n" name="oldnum" value="0" />
              <input type="hidden" id="oldprice" name="oldprice" value="{intval($suit[0]['price_arr'][0]['oldprice'])}" />
            	<span class="order-btn plus plus-active" id="minus"></span>
            </span>
                <span class="order-jg">老人价<em>&yen;</em><em id="disoldprice">{intval($suit[0]['price_arr'][0]['oldprice'])}</em></span>
            </li>
          <li><label>联系人：</label><input type="text" name="linkman" id="linkman" class="order-lx" placeholder="请填写联系人" value="{$user['truename']}" /></li>
          <li><label>联系电话：</label><input type="text" name="linktel" id="linktel" class="order-lx" placeholder="手机号码或固定电话" value="{$user['mobile']}" />&nbsp;可通过此手机号查询订单(必填)</li>
          <li><label>备注信息：</label><textarea name="remark" placeholder="此处可输入收件地址信息等"  style="width:300px;height: 80px;border:1px solid #e5e5e5;"></textarea></li>
        </ul>
        </form>
      </div>
      
    </div>

  </div>
  
 {template 'public/foot'}
  
  <div class="opy"></div>
  <div class="bom_fix_box">
  	<span>总额：<em>&yen;</em><em id="totle">0</em></span>
      {if !empty($suit[0]['dingjin'])}
        <span>定金：<em>&yen;</em> <em id="depoist" data="{$suit[0]['dingjin']}">{$suit[0]['dingjin']}</em></span>
      {/if}
  	<a class="booking" href="javascript:void(0);" onclick="checkform();">提交订单</a>
  </div>
  
</body>
<script type="text/javascript">
//提交订单
function checkform(){
    if(($('#dingnum').val()==0)&&($('#childnum').val()==0)){
      alert('请选择预订数量!');
      return false;
    }
    if(($('#price').val()==0)&&($('#childprice').val()==0)){
      alert('当前产品不能预订!');
      return false;
    }
    if($('#suitid').val()==0){
      alert('请选择套餐类型!');
      return false;
    }
    if($('#dateid').val()==0){
      alert('请选择出行日期!');
      return false;
    }
    if($('#linkman').val()==''){
      alert('请填写联系人!');
      return false;
    }
    $('#form1').submit();
}


$('.plus').click(function(){
    var dingnum = $(this).parent().find('.order-txt-n');
    dingnum.val(parseInt(dingnum.val())+1);
    checkPNum();
});
$('.minus').click(function(){
    var dingnum = $(this).parent().find('.order-txt-n');
    var peopelnum = dingnum.val();
    if(peopelnum>=1){
       dingnum.val(parseInt(dingnum.val())-1);
    }
    checkPNum();
});

//重新计算价格
function checkPNum(){
    var manNum = parseInt($('#dingnum').val());
    var childNum = parseInt($('#childnum').val());
    var oldNum = parseInt($('#oldnum').val());
    var manprice = parseInt($('#price').val());
    var childprice = parseInt($('#childprice').val());
    var oldprice = parseInt($('#oldprice').val());
    var depoist=parseInt($('#depoist').attr('data'));
    var totle = manNum*manprice+childNum*childprice+oldNum*oldprice;
    //计算总价格
    $('#totle').html(totle);
    //计算总定金
    if(depoist>0){
        $('#depoist').html(depoist*(manNum+childNum+oldNum));
    }

}

//选中日期后重置大人小孩价格计算
function  settravel(){

  var selectdate = $('#tarveldate').val();
  var selectarr = selectdate.split('||');
  $('#dismanprice').html(selectarr[1]);
  $('#price').val(selectarr[1]);
  $('#dateid').val(selectarr[0]);
  if(selectarr[1]==0){
    $('#manli').css('display','none');
    $('#dingnum').val('0');
  }else{
    $('#manli').css('display','block');;
  }
  $('#childprice').val(selectarr[2]);
  $('#dischildprice').html(selectarr[2]);

  if(selectarr[2]==0){
    $('#childnum').val('0');
    $('#chiledli').css('display','none'); 
  }else{
    $('#chiledli').css('display','block');
  }
  checkPNum();
}

$(document).ready(function(){
  checkPNum();
});


//房型切换
$('.fangxing').click(function(){
  $('.fangxing').removeClass('cur');
  $(this).addClass('cur');
  var roomid=$(this).attr('dateid');
     $('#suitid').val(roomid);
   for(a in pricearr){
      if(pricearr[a]['id']==roomid){
        var str='';
        if(pricearr[a]['price_arr'].length == 0){
          //重置价格选择框
          str += '<select style="font-size: 14px;width:100%;height:30px; color:#2a2a2a; margin-top:10px; margin-left:-5px;" id="tarveldate" name="tarveldate"><option>暂无价格信息</option></select>';
          $('.selectdiv').html(str);

          //价格清空
          $('#dismanprice').html('0');
          $('#price').val('0');
          $('#childprice').val('0');
          $('#dischildprice').html('0');
          checkPNum();
        }else{
          //重置价格选择框
          str +='<select style="font-size: 14px;width:100%;height:30px; color:#2a2a2a; margin-top:10px; margin-left:-5px;" id="tarveldate" name="tarveldate" onchange="settravel();">';
          for (b in pricearr[a]['price_arr']) {
            var disstr = pricearr[a]['price_arr'][b]['day'];
            var dayid =  pricearr[a]['price_arr'][b]['dayid'];
            var price1 = parseInt(pricearr[a]['price_arr'][b]['adultprice']);
            var price2 = parseInt(pricearr[a]['price_arr'][b]['childprice']);
            if(price1>0){
                disstr += ' ￥'+pricearr[a]['price_arr'][b]['adultprice']+'/大人';
            }
            if(price2>0){
                disstr += ' ￥'+pricearr[a]['price_arr'][b]['childprice']+'/儿童';
            }
            str +='<option value="'+dayid+'||'+price1+'||'+price2+'">'+disstr+'</option>';
          }
          str +='</select>';
          $('.selectdiv').html(str);

          //重新计算价格
          settravel();
        }

      }
   }
});

</script>
</html>

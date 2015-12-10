<?php
require_once(dirname(__FILE__)."/../include/common.inc.php");
require_once(dirname(__FILE__)."/spot.func.php");//载入景点功能函数

//获取门票列表
if($dopost == 'getpiaolist')
{
	Helper_Archive::loadModule('common');
	$_model = new CommonModule('#@__spot_ticket_type');
	
	$arr = $_model->getAll("spotid='{$spotid}'","displayorder asc");


	$i=1;
	$head = '<div class="ticket_type">
                  <ul class="type_ul">                        
                    <li class="li_1">票面类型</li>
                    <li class="li_2">票面价</li>
                    <li class="li_2">优惠价</li>
                    <li class="li_2">积分抵现金</li>
                    <li class="li_2">购买送积分</li>
                    <li class="li_2">点评送积分</li>
                  </ul>';
	$foot = '</div>';
	foreach($arr as $row)
	{
	   $list=getPiaoDetail($spotid,$row['id'],$row['kindname']);	
	   if(!empty($list))
		{

			$body.='<div class="type_list">
                    <h3>'.$row['kindname'].'</h3>
                    '.$list.'
                  </div>';   
		}
	   
	}
	$out = !empty($body) ? $head.$body.$foot : '';
	echo $out;
	
	
}

//获取具体门票信息
function getPiaoDetail($spotid,$tickettypeid,$kindname)
{
    Helper_Archive::loadModule('common');
	$_model = new CommonModule('#@__spot_ticket');

	$arr = $_model->getAll("spotid='{$spotid}' and tickettypeid='$tickettypeid' and number!=0","displayorder asc");

	$out = '';
	foreach($arr as $row)
	{
	  
	  
	  $savemoney=$row['sellprice']-$row['ourprice'];
	  $award1 = !empty($row['jifentprice']) ? $row['jifentprice'] : '无';
	  $award2 = !empty($row['jifenbook']) ? $row['jifenbook'] : '无';
	  $award3 = !empty($row['jifencomment']) ? $row['jifencomment'] : '无';
	  $bookurl="booking.php?spotid={$row['spotid']}&ticketid={$row['id']}";
	  
	  $out.='<dl>
			<dt class="dl_title"><a href="javascript:void()">'.$row['title'].'</a></dt>
			<dd class="dd1">&yen;'.$row['sellprice'].'</dd>
			<dd class="dd2">&yen;'.$row['ourprice'].'</dd>
			<dd class="dd3"><span>'.$award1.'</span></dd>
			<dd class="dd4"><span>'.$award2.'</span></dd>
			<dd class="dd5"><span>'.$award3.'</span></dd>
			<dd class="dd6"><a href="'.$bookurl.'" class="btn_ding" data-ticketid="'.$row['id'].'">预定</a></dd>
			</dl>
			<div class="con_hide">
			<s class="s_bg"></s>
			<p>'.$row['description'].'</p>
			</div>';
	}
   
	return $out;
	
}
$out=' <div class="ticket_type">
                  <ul class="type_ul">                        
                    <li class="li_1">票面类型</li>
                    <li class="li_2">票面价</li>
                    <li class="li_2">优惠价</li>
                    <li class="li_2">积分抵现金</li>
                    <li class="li_2">购买送积分</li>
                    <li class="li_2">点评送积分</li>
                  </ul>
                  <div class="type_list">
                    <h3>成人票</h3>
                    <dl>
                      <dt class="dl_title"><a href="javascript:void()">成人票（免费wifi覆盖）</a></dt>
                      <dd class="dd1">&yen;1286</dd>
                      <dd class="dd2">&yen;1088</dd>
                      <dd class="dd3"><span>100</span></dd>
                      <dd class="dd4"><span>9999</span></dd>
                      <dd class="dd5"><span>80</span></dd>
                      <dd class="dd6"><a href="#">预定</a></dd>
                    </dl>
                    <div class="con_hide">
                      <s class="s_bg"></s>
                      <p>18周岁以下未成年人免费，南京总统府景区有免费wifi覆盖，边游玩边分享，来总统府与历史对话。</p>
                    </div>
                    <dl>
                      <dt class="dl_title"><a href="javascript:void()">成人票（免费wifi覆盖）</a></dt>
                      <dd class="dd1">&yen;1286</dd>
                      <dd class="dd2">&yen;1088</dd>
                      <dd class="dd3"><span>100</span></dd>
                      <dd class="dd4"><span>9999</span></dd>
                      <dd class="dd5"><span>80</span></dd>
                      <dd class="dd6"><a href="#">预定</a></dd>
                    </dl>
                    <div class="con_hide">
                      <s class="s_bg"></s>
                      <p>18周岁以下未成年人免费，南京总统府景区有免费wifi覆盖，边游玩边分享，来总统府与历史对话。</p>
                    </div>
                  </div>
                 
                </div>';
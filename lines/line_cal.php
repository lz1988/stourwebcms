<?php 
require_once(dirname(__FILE__)."/../include/common.inc.php");
if($dopost=='cal')
{
	$sql="select * from #@__line_month where lineid='$id' and webid='0'";
	$dsql->SetQuery($sql);
    $dsql->Execute();
	$str="[";
    while($row = $dsql->GetArray())
	{
		$priceArr = explode('||', $row['price']);
		$basicArr = explode('||', $row['basicprice']);
		$profitArr = explode('||', $row['profit']);
		$descArr = explode('||', $row['description']);
		for($i = 0; $i < cal_days_in_month(CAL_GREGORIAN, $row['monthnum'], $row['yearnum']); $i++)
		{
			$idx = $i + 1;
			$price = explode(' ', $priceArr[$i]);
			$basicprice = explode(' ', $basicArr[$i]);
			$profit = explode(' ', $profitArr[$i]);
			$desc = explode(' ', $descArr[$i]);
			$month = intval($row['monthnum']) < 10 && substr($row['monthnum'], 0, 1) != '0' ? '0' . $row['monthnum'] : $row['monthnum'];
			//$title = $basicprice[1] * $row['exchange'] + $profit[1];
			$title = empty($price[1]) ? $basicprice[1] * $row['exchange'] + $profit[1] : $price[1];
			$description = $desc[1];
			$day = $i+1;
			
			if($idx<10)
			{
				$idx="0".$idx;
			}
			if(!empty($price[1]))
			{
				$str.='{ "EventID": '.$idx.', "StartDateTime": "'.$row['yearnum'].'-'.$month.'-'.$idx.'", "Title": "￥'.$title.'", "URL": "' . $GLOBALS['cfg_cmsurl'] . '/lines/booking_'.$row['lineid'].'_'.$title.'_'.$row['yearnum'].'-'.$month.'-'.$day.'.html", "Description": "'.$description.'", "CssClass": "Meeting" },';
			}
		}
	}
	$str.=" ]";
	echo $str;
}

if($dopost=='hotel')
{
	$sql="select * from #@__hotelmonth where roomid='$id'";
	$dsql->SetQuery($sql);
    $dsql->Execute();
	$str="[ ";
    while($row = $dsql->GetArray())
	{
		for($i=1;$i<=31;$i++)
		{
			if($row['day'.$i]!=0)
			{
				$month="";
				//$row['monthnum']=$row['monthnum']-1;
				if($row['monthnum']<10)
				{
					$month="0".$row['monthnum'];
				}
				else
				{
				   $month=$row['monthnum'];	
				}
				
				
				$title=$row['day'.$i];
				$description=$row['description'.$i];
				if($i<10)
				{
					$i="0".$i;
				}
			    $str.='{ "EventID": '.$i.', "StartDateTime": "'.$row['yearnum'].'-'.$row['monthnum'].'-'.$i.'", "Title": "￥'.$title.'", "URL": "javascript:;", "Description": "'.$description.'", "CssClass": "Meeting", "Price" : "' . $title . '", "gotime" : "'.$row['yearnum'].'-'.$row['monthnum'].'-'.$i.'", "focusTime" : "'.$row['monthnum'].'月'.$i.'日", "focusTimes" : "'.$row['monthnum'].'/'.$i.'"},';
			}
		}
	}
	$str.=" ]";
	echo $str;
	exit;
}

if($dopost=='ticket')
{
	$sql="select * from #@__ticket_month where ticketid='$id'";
	$dsql->SetQuery($sql);
    $dsql->Execute();
	$str="[ ";
    while($row = $dsql->GetArray())
	{
		for($i=1;$i<=31;$i++)
		{
			if($row['day'.$i]!=0)
			{
				$month="";
				//$row['monthnum']=$row['monthnum']-1;
				if($row['monthnum']<10)
				{
					$month="0".$row['monthnum'];
				}
				else
				{
				   $month=$row['monthnum'];	
				}
				
				
				$title=$row['day'.$i];
				$description=$row['description'.$i];
				if($i<10)
				{
					$i="0".$i;
				}
			    $str.='{ "EventID": '.$i.', "StartDateTime": "'.$row['yearnum'].'-'.$row['monthnum'].'-'.$i.'", "Title": "￥'.$title.'", "URL": "javascript:;", "Description": "'.$description.'", "CssClass": "Meeting", "Price" : "' . $title . '", "gotime" : "'.$row['yearnum'].'-'.$row['monthnum'].'-'.$i.'", "focusTime" : "'.$row['monthnum'].'月'.$i.'日", "focusTimes" : "'.$row['monthnum'].'/'.$i.'"},';
			}
		}
	}
	$str.=" ]";
	echo $str;
	exit;
}

if($dopost == 'getScal')
{
	$dateArr = explode('-', $date);
	$Y = $dateArr[0];
	$M = $dateArr[1];
	$D = intval($dateArr[2]);
	
	$idArr = explode('|', $data);
	$hid = $idArr[0];
	$tid = $idArr[1];
	
	$hstr = GetHotelroomByHotelId($hid, 0, $Y, $M, $D);
	$tstr = GetTicketByTicketId($tid, 0, $Y, $M, $D);
	$arr = array();
	$arr['hs'] = $hstr;
	$arr['ts'] = $tstr;
	echo json_encode($arr);
}





function GetHotelroomByHotelId($hotelid, $webid, $Y, $M, $D)
{
	global $dsql;
	$sql = "select * from #@__hotel_room where hotelid='$hotelid' and webid='$webid'";
	$res = $dsql->getAll($sql);
	$str = '';
	foreach($res AS $row)
	{
		if($row['breakfirst'] == '0')$breakfirst = '无';
		if($row['breakfirst'] == '1')$breakfirst = '含';
		if($row['breakfirst'] == '2')$breakfirst = '双早';
		if($row['breakfirst'] == '3')$breakfirst = '单早';
		if($row['breakfirst'] == '4')$breakfirst = '早餐';
		if($row['breakfirst'] == '5')$breakfirst = '早晚餐';
		if($row['breakfirst'] == '6')$breakfirst = '三餐';
		if($row['breakfirst'] == '7')$breakfirst = '一价全包';
		if($row['breakfirst'] == '8')$breakfirst = '用晚含早';

		$str .= '<li><span>' . GetdayPrice($row['id'], 'hotel', $Y, $M, $D) . '</span>' . 
				'<input name="hotelr" type="radio" id="radio" value="' . GetdayPriceNum($row['id'], 'hotel', $Y, $M, $D) . '" ' . 
				' onclick="changeTPrice(this,\'hotel\',\'\')" />' . $row['roomname'] . ' </li>';
	}
	$str .= '<li><input name="hotelr" type="radio" id="radio" value="0" onclick="changeTPrice(this,\'hotel\')" />不选择 </li>';
	return $str;
}

function GetTicketByTicketId($ticketid, $webid, $Y, $M, $D)
{
	global $dsql;
	$tidArr = explode(',', $ticketid);
	$str = '';
	foreach($tidArr AS $tid)
	{
		if(checkTicket($tid))
		{
			$sql = "select * from #@__ticket where id='$tid' and webid='$webid'";
			$row = $dsql->GetOne($sql);
			$ismid = ($row['ismiddle'] == '' || $row['ismiddle'] == '0') ? '否' : '是';
			$mid = ($row['ismiddle'] == '' || $row['ismiddle'] == '0') ? '无' : $row['midcity'];
			$beizhu = empty($row['beizhu']) ? '无' : $row['beizhu'];
			
			if($row['kind'] == 1)$kind = '单程';
			if($row['kind'] == 1)$kind = '联程';
			if($row['kind'] == 3)$kind = '往返';
			
			$str .= '<li><span>' . GetdayPrice($row['id'], 'ticket', $Y, $M, $D) . '</span>' . 
			        '<input name="ticketr" type="radio" id="radio" value="' . GetdayPriceNum($row['id'], 'ticket', $Y, $M, $D) . '" ' . 
					' onclick="changeTPrice(this,\'ticket\',' . $row['id'] . ')" />' . $row['company'] . ' <b>' . $kind . '</b></li>' . 
					'<input type="hidden" id="beizhu' . $row['id'] . '" value="' . $row['beizhu'] . '" />';
		}
	}
	$str .= '<li><input name="ticketr" type="radio" id="radio" value="0" onclick="changeTPrice(this,\'ticket\')" />不选择 </li>';
	return $str;
}

function GetdayPrice($itemid, $kind, $Y, $M, $D)
{
	global $dsql;
	
	if($kind == 'hotel')
	{
		$sql = "select day{$D} from #@__hotel_month where roomid='$itemid' and yearnum='$Y' and monthnum='$M'";
	}
	else if($kind == 'ticket')
	{
		$sql = "select day{$D} from #@__ticket_month where ticketid='$itemid' and yearnum='$Y' and monthnum='$M'";
	}
	
	$row = $dsql->GetOne($sql);
	
	return empty($row['day' . $D]) ? '售完' : '￥' . $row['day' . $D];
}

function GetdayPriceNum($itemid, $kind, $Y, $M, $D)
{
	global $dsql;
	
	if($kind == 'hotel')
	{
		$sql = "select day{$D} from #@__hotel_month where roomid='$itemid' and yearnum='$Y' and monthnum='$M'";
	}
	else if($kind == 'ticket')
	{
		$sql = "select day{$D} from #@__ticket_month where ticketid='$itemid' and yearnum='$Y' and monthnum='$M'";
	}
	
	$row = $dsql->GetOne($sql);
	
	return empty($row['day' . $D]) ? 0 : $row['day' . $D];
}

function checkTicket($ticketid)
{
	global $dsql;
	$flag = false;
	$sql = "select count(*) as dd from #@__ticket_month where ticketid='$ticketid'";
	$row = $dsql->GetOne($sql);
	if($row['dd'] > 0) $flag = true;
	return $flag;
}
?>
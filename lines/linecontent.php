<?php 

require_once(dirname(__FILE__)."/../include/common.inc.php");
require_once(dirname(__FILE__)."/../data/webinfo.php");
require_once(dirname(__FILE__)."/line.func.php");



function GetIncFeedBack($postid,$typeid,$name,$webid)
{
	global $dsql;
	$weburl=GetWebURLByWebid($webid);//获取站点url
	if($GLOBALS['cfg_py_open']==0)//检测评论是否开启
	{
	  return '';	
	}
	$sql="select * from #@__allcomments where webid=0 and postid=$postid and typeid='$typeid' order by replydate desc limit 0,5 ";//查询单个
	$res = $dsql->getAll($sql);
	$str = "<div id=\"pinglun\">";
	$str .= "<ul id=\"pllist\">";
	foreach($res AS $row)
	{
		$str .= "<li class=\"plyk\"><span class=\"pl_time\">评论时间：" . date("Y-m-d",$row['replydate']) . "</span><span class=\"pl_name\">网友" .                $row['nickname'] . "评论:</span></li><li class=\"plnr\"><p>" . $row['replycontent'] . "</p></li>";
	}
	$str .= "</ul>";
	$str .= "<div id=\"havequestion\"><a href=\"/questions/#postion\" target=\"_blank\">" . 
	        "<img src=\"" . $GLOBALS['cfg_templets_skin'] . "/images/question2_btn.gif\" border=\"0\" /></a></div><ul class=\"plfb\">" . 
		    "<form action=\"" . $weburl . "/feedback.php?dopost=post\" method=\"post\">" . 
		    "<li class=\"clear fbts\"><span id=\"#postion\">我来说两句</span></li>" . 
		    "<li class=\"textbox fl\">" . 
			"<input name=\"yinyong\" type=\"hidden\" id=\"yinyong\" value=\"0\" />" . 
			"<textarea name=\"leaveinfo\" cols=\"80\" rows=\"5\" id=\"leaveinfo\"></textarea>" . 
			"<input type=\"hidden\" name=\"aid\" value=\"" . $postid . "\">" . 
			"<input type=\"hidden\" name=\"typeid\" value=\"" . $typeid . "\">" . 
			"<input type=\"hidden\" name=\"posttitle\" value=\"" . $name . "\">" . 
			"</li><li class=\"plxx\"><span class=\"tjpl\"><input name=\"tj\" type=\"image\" src=\"" . $GLOBALS['cfg_templets_skin'] . "/images/pinglun.gif\" onclick=\"return checkpl()\" /></span>匿名&nbsp;<input name=\"noname\" type=\"checkbox\" id=\"ishidden\" value=\"1\" /><span class=\"nicheng\">昵称<input name=\"leavename\" type=\"text\" id=\"leavename\" size=\"15\" maxlength=\"20\" /></span><span class=\"yzm\"><img src= \"" . $weburl . "/include/vdimgck.php\" id=\"checkcode\" style=\"cursor:pointer\" onclick=\"this.src=this.src+'?'\" title=\"点击我更换图片\" alt=\"点击我更换图片\" /><span>=验证码<input type=\"text\" name=\"checkcode\" size=\"4\"  style=\"text-transform:uppercase;\"/></span></span></li></form></ul></div>";
	return $str;
}

function GetIncBooking($linedate,$lineprice,$childprice,$childrule,$templet)
{
	if($templet == 2)
	{
		$str = '';
	}
	else
	{
		$childprice = empty($childprice) ? "电询" : "￥".$childprice . " 起";
		$str = '<div class="ft_ts">发团日期：'.$linedate.'&nbsp;&nbsp;报价：成人￥'.$lineprice.' 起&nbsp;&nbsp;儿童：'.$childprice.'</div>
   <div class="ft_ts">儿童标准：'.$childrule.'</div>
   <div class="ft_ts clearfix">
     <div id="jMonthCalendar"></div>
   </div>';
	}
   //小孩报价：￥'.$childprice.'不含门票（身高在1米以内）
   return $str;
}

function GetIncZuche($lineid,$linename)
{
	global $dsql;
	$getmonth=GetMonthHandle();
	$GLOBALS['nowmonth']=date('n');
	$GLOBALS['nowmonth1']=date('n')+1;
	$GLOBALS['nowmonth2']=date('n')+2;
	if($GLOBALS['nowmonth1']==13)
	{
		$GLOBALS['nowmonth1']=1;
	}
	if($GLOBALS['nowmonth2']==14)
	{
		$GLOBALS['nowmonth2']=2;
	}
	$getmonth_1=GetMonthHandle(1);
	$getmonth_2=GetMonthHandle(2);
	$sqlstr="select a.*,b.$getmonth as nowprice,b.$getmonth_1 as nowprice_1,b.$getmonth_2 as nowprice_2 from #@__car a join #@__carprice b on a.aid=b.carid and a.webid=0 and b.lineid=$lineid and b.webid=0";
	$res = $dsql->getAll($sql);
	
	if(empty($res)) //如果为空则直接返回.
	{
	   return '';	
	}
	$str = '<div style="padding:10px;">
                 	<table width="710" cellspacing="1" cellpadding="0" border="0" bgcolor="#dcdcdc">
                <tr bgcolor="#ffffff">
                  <td height="33" colspan="6" scope="row"><h3><strong>'.$linename.'</strong></h3></td>
                </tr>
                <tr bgcolor="#ffffff">
                  <td width="224" height="30" scope="row">单项租车服务车型</td>
                  <td width="117" scope="row">座位数</td>
                  <td width="93">'.$GLOBALS['nowmonth'].'月</td>
                  <td height="0">'.$GLOBALS['nowmonth1'].'月</td>
                  <td height="0">'.$GLOBALS['nowmonth2'].'月</td>
                  <td>预订</td>
                </tr>';
	 foreach($res AS $row)
	 {
		 $str .= '<tr align="center" bgcolor="#ffffff">
                  <td height="30" scope="row"><a href="/cars/show_'.$row['aid'].'.html">'.$row['title'].'</a></td>
                  <td height="30" scope="row"><span style="color:#4BA724">'.$row['seatnum'].'座</span></td>
                  <td height="30"><span style="color:#f60; font-weight:bold">'.$row['nowprice'].'</span>元</td>
                  <td width="93" height="31"><span style="color:#f60; font-weight:bold">'.$row['nowprice_1'].'</span>元</td>
                  <td width="93" height="31"><span style="color:#f60; font-weight:bold">'.$row['nowprice_2'].'</span>元</td>
                  <td width="88" height="31"><a href="'.$GLOBALS['cfg_cmsurl'].'/cars/booking_'.$row['carid'].'_'.$row['nowprice'].'.html" style="width:88px">
                    <input type="image"  src="'. $GLOBALS['cfg_templets_skin'] .'/images/yd_an.gif" onclick="window.location.href=\"/cars/booking_'.$row['aid'].'_'.$row['nowprice'].'.html\"" width="44" height="23" />
                  </a></td>
                </tr>';
	 }
	 $str .='</table>
            </div>';
	 return $str;
}


function GetAttr($type,$con)
{
	$foodtext = array(
				"1"=>"早餐",
				"2"=>"中餐",
				"3"=>"晚餐");
	$transtext = array(
				"1"=>"飞机",
				"2"=>"火车",
				"3"=>"轮船",
				"4"=>"汽车",
				"5"=>"自驾");
	if($type == "food")
	{
		if(!empty($con))
		{
			$foodarr = explode(" ",$con);
			$str ="含";
			for($i=0; isset($foodarr[$i]); $i++)
			{
				$str .= $foodtext[$foodarr[$i]] . "、";
			}
		}
		else
		{
			$str = "不含";
		}
	}
	if($type == "trans")
	{
		if(!empty($con))
		{
			$transarr = explode(" ",$con);
			$str ="";
			for($i=0; isset($transarr[$i]); $i++)
			{
				$str .= $transtext[$transarr[$i]] . "、";
			}
		}
		else
		{
			$str = "不含";
		}
	}
	if(!empty($con))
	{
		$str = substr($str,0,strlen($str)-3);
	}
	else
	{
		$str = $str;
	}
	return $str;
}

function GetImage($url,$name,$smallurl, $templets)
{
	$imgname = explode(" ",$name);
	$imgarr = explode(" ",$url);
	$imgsmallarr = explode(" ",$smallurl);
	$str = "";
	for($j=0; isset($imgarr[$j]); $j++)
	{
		if(!empty($imgarr[$j]))
		{
			if(empty($imgsmallarr[$j]))
				$imgsmallarr[$j]=$imgarr[$j];
			if($templets == 1 || empty($templets))
			{
				 if(!file_exists($GLOBALS['cfg_basedir'].$imgsmallarr[$j]))
					 $str.="";
				else
				$str .= "<li id=\"img_group\"><a onclick=\"GetHref(this,'" . $imgarr[$j] . "')\"><img src=\"" . $imgsmallarr[$j] . "\" class=\"fl\" alt=\"" . $imgname[$j] . "\" title=\"" . $imgname[$j] . "\" width=\"165\"  height=\"120\" /></a><span>" . $imgname[$j] . "</span></li>";
			}
			else if($templets == 2)
			{
				 if(!file_exists($cfg_basedir.$imgsmallarr[$j]))
					 $str.="";
				else
				$str .= "<li><a onclick=\"GetHref(this,'" . $imgarr[$j] . "')\"><img src=\"" . $imgsmallarr[$j] . "\" class=\"fl\" alt=\"" . $imgname[$j] . "\" title=\"" . $imgname[$j] . "\" width=\"165\"  height=\"120\" /></a><p><a href=\"javascript:;\">" . $imgname[$j] . "</a></p></li>";
			}
		}
		else
		{
			$str .= "";
		}
	}
	return $str;
}

function GetHotelByAid($hotelid, $webid)
{
	global $dsql;
	$sql = "select * from #@__hotel where aid='$hotelid' and webid='0' and ishidden='0'";
	$row = $dsql->GetOne($sql);
	
	$litpic = empty($row['litpic']) ? $GLOBALS['cfg_templets_skin'] . '/images/pic_tem.gif' : $GLOBALS['cfg_cmsurl'] . $row['litpic'];
	
	$str = '<div class="info_left">';
	$str .= $row['content'];
	$str .= '</div>';
	$str .= '<div class="info_right">';
	$str .= '<div class="hotel_img"><img src="' . $litpic . '" width="120" height="90" /></div>';
	$str .= '<ul>';
	$str .= '<li><span>酒店名称</span>' . $row['title'] . '</li>';
	$str .= '<li><span>酒店位置</span>' . $row['address'] . '</li>';
	$str .= '<li><span>酒店电话</span>' . $row['telephone'] . '</li>';
	$str .= '</ul>';
	$str .= '</div>';
	return $str;
}

function GetHotelroomByHotelId($hotelid, $ticketid, $lineid, $webid)
{
	global $dsql;
	$sql = "select * from #@__hotel_room where hotelid='$hotelid' and webid='$webid'";
	$res = $dsql->getAll($sql);
	$str = '';
	$idx = 0;
	foreach($res AS $row)
	{
		$idx++;
		$str .= '<tr class="bor_b">
                          <td height="99" align="center" class="border-r font-ys">套餐' . $idx . '   </td>
                          <td height="99" align="center" class="border-r cor_bg">' . GetTicketByTicketId($ticketid, $webid) . '</td>
                          <td height="99" align="left" class="border-r pad_left">' . getRoomName($row) . '</td>
                          <td height="99" align="center" class="border-r"><span style=" font-weight:bold; margin-bottom:10px">套餐总计价格：' . getTotalCount($row['id'], $ticketid) . '</span><br /><br /><input type="button" name="button" id="button" value="" onclick="showDiv(this, ' . $row['id'] . ', ' . $ticketid . ', ' . $lineid . ')" /></td>
                        </tr>';
	}
	return $str;
}

/*function GetHotelroomByHotelId($hotelid, $webid)
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

		$str .= '<li><span>' . GetTodayPrice($row['id'], 'hotel') . '</span>' . 
				'<input name="hotelr" type="radio" id="radio" value="' . GetTodayPriceNum($row['id'], 'hotel') . '" ' . 
				' onclick="changeTPrice(this,\'hotel\',\'\')" />' . $row['roomname'] . ' </li>';
	}
	$str .= '<li><input name="hotelr" type="radio" id="radio" value="0" onclick="changeTPrice(this,\'hotel\')" />不选择 </li>';
	return $str;
}*/

function GetTicketByTicketId($ticketid, $webid)
{
	global $dsql;
	$sql = "select * from #@__ticket where aid='$ticketid' and webid='$webid'";
	$row = $dsql->GetOne($sql);
	$ismid = ($row['ismiddle'] == '' || $row['ismiddle'] == '0') ? '否' : '是';
	$mid = ($row['ismiddle'] == '' || $row['ismiddle'] == '0') ? '无' : $row['midcity'];
	$beizhu = empty($row['beizhu']) ? '无' : $row['beizhu'];
	$str = $row['company'] . '<br />往：' . $row['planenum'] . '<br />返：' . $row['backplanenum'];
	return $str;
}

/*function GetTicketByTicketId($ticketid, $webid)
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
			
			$str .= '<li><span>' . GetTodayPrice($row['id'], 'ticket') . '</span>' . 
			        '<input name="ticketr" type="radio" id="radio" value="' . GetTodayPriceNum($row['id'], 'ticket') . '" ' . 
					' onclick="changeTPrice(this,\'ticket\',' . $row['id'] . ')" />' . $row['company'] . ' <b>' . $kind . '</b></li>' . 
					'<input type="hidden" id="beizhu' . $row['id'] . '" value="' . $row['beizhu'] . '" />';
		}
	}
	$str .= '<li><input name="ticketr" type="radio" id="radio" value="0" onclick="changeTPrice(this,\'ticket\')" />不选择 </li>';
	return $str;
}*/

function getTotalCount($itemid, $tid)
{
	global $dsql;
	$Y = date('Y');
	$M = date('n');
	$syear = $Y;
	$eyear = ($M+1) > 12 ? ($Y+1) : $Y;
	$smonth = $M < 10 ? '0' . $M : $M;
	$emonth = ($M+1) > 12 ? '01' : (($M+1) < 10 ? '0' . ($M+1) : ($M+1));
	$start = strtotime($syear . '-' . $smonth . '-1');
	$end = strtotime($eyear . '-' . $emonth . '-30');
	
	$PriceArr = array();
	$tPriceArr = array();
	$sql = "select price from #@__hotel_month where roomid='$itemid' and yearnum = '$syear' and " . 
		   "monthnum = '$smonth'";
	$rowhotel = $dsql->GetOne($sql);
	
	$h_1 = explode('||', $rowhotel['price']);
	for($i = 0; isset($h_1[$i]); $i++)
	{
		$price_h1 = explode(' ', $h_1[$i]);
		$idx=$i+1;
		$tprice = getTPrcie('day' . $idx, $tid, $syear, $smonth);
		if(!empty($price_h1[1])&& !empty($tprice))
		{
			//$rowhotel['exchange'] = empty($rowhotel['exchange']) ? 1 : $rowhotel['exchange'];
			$price=$price_h1[1]+$tprice;
			array_push($PriceArr, $price);
		}
	}
	$sql_1 = "select price from #@__hotel_month where roomid='$itemid' and yearnum = '$eyear' and " . 
		   "monthnum = '$emonth'";
	$rowhotel_1 = $dsql->GetOne($sql_1);
	
	$h_2 = explode('||', $rowhotel_1['price']);
	for($i = 0; isset($h_2[$i]); $i++)
	{
		$k=$i+1;
		$price_h2 = explode(' ', $h_2[$i]);
		$tprice2 = getTPrcie('day' . $k, $tid, $eyear, $emonth);
		if(!empty($price_h2[1])&& !empty($tprice2))
		{
			//$rowhotel_1['exchange'] = empty($rowhotel_1['exchange']) ? 1 : $rowhotel_1['exchange'];
			$price2=$price_h2[1]+$tprice2;
			array_push($PriceArr, $price2);
		}
	}
	
	$minprice = min($PriceArr);
	

	return empty($minprice) ? '<span style=" color:#c30">电询</span>' : '<span style=" color:#c30">' . $minprice . '</span>' . '元/人起';
}

function GetTodayPrice($itemid, $kind)
{
	global $dsql;
	
	$Y = date('Y');
	$M = date('n') < 10 ? '0' . date('n') : date('n');
	$D = date('j');
	
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

function GetTodayPriceNum($itemid, $kind)
{
	global $dsql;
	
	$Y = date('Y');
	$M = date('n') < 10 ? '0' . date('n') : date('n');
	$D = date('j');
	
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

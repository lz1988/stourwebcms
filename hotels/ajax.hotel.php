<?php
require_once(dirname(__FILE__)."/../include/common.inc.php");
require_once(dirname(__FILE__)."/hotel.func.php");//载入酒店功能函数

//首页获取热门城市酒店

if($dopost == 'getHotelByDestId')
{
	$where = " where a.ishidden=0 and FIND_IN_SET({$dest_id},a.kindlist)";
	$leftjoin = "left join #@__kindorderlist b on(a.id = b.aid and b.classid = {$dest_id} and b.typeid=2)";
	$sql = "select a.* from #@__hotel a {$leftjoin} {$where} order by case when b.isding is null then 0 end,case when b.isjian is null then 0 end desc,case when b.displayorder is null then 9999 end,b.displayorder asc,a.addtime desc limit 0,8";

	$arr = $dsql->getAll($sql);
	$out = '';
	foreach($arr as $row)
	{
		$url = GetWebURLByWebid($row['webid']).'/hotels/show_'.$row['aid'].'.html';
		$litpic = getUploadFileUrl($row['litpic']);
		$hotelname = $row['title'];
		$price = $row['price'];
	
		$out.='<li>
                  <a class="fl" href="'.$url.'" target="_blank"><img class="fl" src="'.$litpic.'" width="210" height="165" alt="'.$hotelname.'" title="'.$hotelname.'" /></a>
                  <p class="p1"></p>
                  <p class="p2"><a href="'.$url.'" class="sp_1">'.$hotelname.'</a><span class="sp_2">&yen;'.$price.'</span></p>
                </li>';
	   	
	}
	$out ='<ul>'.$out.'</ul>';
	echo $out;
	exit();
}

if($dopost == 'getHotelByRankId')
{
    $where = " where a.ishidden=0 and hotelkindid = '{$dest_id}'";
    $leftjoin = "left join #@__allorderlist b on(a.id = b.aid and b.typeid=2)";
    $sql = "select a.* from #@__hotel a {$leftjoin} {$where} order by case when b.isding is null then 0 end,case when b.isjian is null then 0 end desc,case when b.displayorder is null then 9999 end,b.displayorder asc,a.addtime desc limit 0,8";

    $arr = $dsql->getAll($sql);
    $out = '';
    foreach($arr as $row)
    {
        $url = GetWebURLByWebid($row['webid']).'/hotels/show_'.$row['aid'].'.html';
        $litpic = getUploadFileUrl($row['litpic']);
        $hotelname = $row['title'];
        $price = $row['price'];

        $out.='<li>
                  <a class="fl" href="'.$url.'" target="_blank"><img class="fl" src="'.$litpic.'" width="210" height="165" alt="'.$hotelname.'" title="'.$hotelname.'" /></a>
                  <p class="p1"></p>
                  <p class="p2"><a href="'.$url.'" class="sp_1">'.$hotelname.'</a><span class="sp_2">&yen;'.$price.'</span></p>
                </li>';

    }
    $out ='<ul>'.$out.'</ul>';
    echo $out;
    exit();
}

//获取房型
if($dopost == 'gethotelroom_show')
{
	
	$sql="select a.* from #@__hotel_room a where hotelid='$hotelid' order by a.price";
	
	$arr = $dsql->getAll($sql);
    
	$hotelinfo = getHotelInfo($hotelid,0);
	$out = '<div class="pro_bot_con">';
	$tablehead=' <table class="h_pro_table" width="918" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <th align="left" width="303" scope="col" style=" padding-left:15px">房型</th>
                      <th width="100" scope="col">床型</th>
                      <th width="100" scope="col">门市价</th>
                      <th width="100" scope="col">优惠价</th>
                      <th width="100" scope="col">宽带</th>
                      <th width="100" scope="col">早餐</th>
                      <th width="100" scope="col">&nbsp;</th>
                    </tr>';
                 
	foreach($arr as $row)
	{
		$previlage = intval($row['sellprice']) - intval($row['price']);
		$pflag = !empty($row['piclist']) ? '<img src="'.$GLOBALS['cfg_templets_skin'].'/images/h_pro_pic.gif" />' : '';//图片标识
		//$bookurl = "{$GLOBALS['cfg_cmsurl']}/hotels/booking.php?hotelid={$hotelid}&roomid={$row['id']}";
		$tablebody.='<tr>
				<td width="303" class="h_title_a"><a href="javascript:void()">'.$row['roomname'].'</a>'.$pflag.'</td>
				<td width="100" align="center" valign="middle">'.$row['roomstyle'].'</td>
				<td width="100" align="center" valign="middle">&yen;'.$row['sellprice'].'</td>
				<td width="100" align="center" valign="middle">&yen;'.$row['price'].'</td>
				<td width="100" align="center" valign="middle">'.$row['computer'].'</td>
				<td width="100" align="center" valign="middle">'.$row['breakfirst'].'</td>
				
				<td width="100" align="center" valign="middle"><a class="h_pro_yd btn_hotel_book" href="javascript:;" data-roomid="'.$row['id'].'" data-hotelid="'.$hotelid.'" data-hotelname="'.$hotelinfo['title'].'['.$row['roomname'].']">预&nbsp;定</a></td>
                </tr>';
		
		$tablebody.= '<tr class="none">
                      <td width="918" colspan="7">
                        <div class="control_con">
                          <div class="arr_bg"></div>
                          <table width="918" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                              <td>房型：'.$row['roomname'].'</td>
                              <td>面积：'.$row['roomarea'].'平方米</td>
                              <td>窗户：'.$row['roomwindow'].'</td>
                            </tr>
                            <tr>
                              <td>床型：'.$row['roomstyle'].'</td>
                              <td>早餐：'.$row['breakfirst'].'</td>

                            </tr>
                            <tr>
                              <td class="bor_bot_none" colspan="3">
                               '.getRoomPicList($row['piclist']).'
                              </td>
                            </tr>
                          </table>
                        </div>
                      </td>
                    </tr>';
				
				
			  
		
	}
	$tableend="</table>";
	$table = !empty($tablebody) ? $tablehead.$tablebody.$tableend : '';
	
	$out.=$table.'</div>';
	echo $out;
	exit();
	
	
	
}
 
//获取目的地ID
if($dopost == 'getDestId')
{
	$sql = "select id from #@__destinations where kindname='$destname'";
	$row = $dsql->GetOne($sql);
	echo $row['id'] ? $row['id'] : 0;

}

//获取日历
if($dopost == 'getCalendar')
{
	$nowDate = new DateTime();
	$year = !empty($year) ? $year : $nowDate->format( 'Y' );
	$month = !empty($month) ? $month : $nowDate->format( 'm' );
	$priceArr = getRoomPriceArr($year,$month,$roomid);

	echo myCalender($year,$month,$priceArr);
	
}



/**
 * 生成格式化的数据
 * 用于日历中进行呈现
 * @param $arr
 */
function getRoomPriceArr($year,$month,$roomid)
{
    global $dsql;
   
       
		/*$sql = "select * from #@__hotel_month where roomid='$roomid' and yearnum='$year' and monthnum='$month'";
		
        $row = $dsql->GetOne($sql);
        $hotels = array();
        if($row)
		{
            
            $prices = $row['price'] ? explode('||',$row['price']) : '';
            $discs  = $row['description'] ? explode('||',$row['description']) : '';
            
            if($prices)
			{
                foreach($prices as $k=>$v)
				{
                    $item = explode(' ',$v);
                    $item2= explode(' ',$discs[$k]);
                    $item3= explode(' ',$rooms[$k]);
					$d = intval($item[0]) <10 ? '0'.intval($item[0]) : intval($item[0]);
                    $day = $year.'-'.$month.'-'.$d;
                    $hotels[$day]['price'] = $item[1];
                    $hotels[$day]['disc'] = $item2[1];
                }
            }
      
        }
		*/

       $nowtime = strtotime($year.'-'.$month.'-'.'01');

       $sql = "select * from #@__hotel_room_price where suitid='$roomid' and day >= '$nowtime' and price > 0 and number!=0";

       $arr = $dsql->getAll($sql);
       $hotel = array();
       foreach($arr as $row)
       {

          $day = date('Y-m-d',$row['day']);
          $hotel[$day]['price'] =  $row['price'];
          $hotel[$day]['disc'] = $row['description'];
          $hotel[$day]['number'] = $row['number'];
       }
        return $hotel;
}


/**
 * 
 * 我的日历(DateTime版本)
 * date_default_timezone_set date mktime
 * @param int $year
 * @param int $month
 * @param string $timezone
 * @author fc_lamp
 * @blog: fc-lamp.blog.163.com
 */
 

function myCalender($year = '', $month = '', $priceArr=NULL, $timezone = 'Asia/Shanghai')
{
	

    date_default_timezone_set ( $timezone );
	$year = abs ( intval ( $year ) );
	$month = abs ( intval ( $month ) );
	$tmonth = $month < 10 ? "0".$month : $month;
	$defaultYM = $year.'-'.$tmonth;
	$nowDate = new DateTime();
	
	if ($year <= 0)
	{
		$year = $nowDate->format( 'Y' );
	}
	
	if ($month <= 0 or $month > 12)
	{
		$month = $nowDate->format('m' );
	}
	
	//上一年
	$pretYear = $year - 1;
	//上一月
	$mpYear = $year;
	$preMonth = $month - 1;
	if ($preMonth <= 0)
	{
		$preMonth = 12;
		$mpYear = $pretYear;
	}
	$preMonth = $preMonth < 10 ? '0'.$preMonth : $preMonth;
	
	//下一年
	$nextYear = $year + 1;
	//下一月
	$mnYear = $year;
	$nextMonth = $month + 1;
	if ($nextMonth > 12)
	{
		$nextMonth = 1;
		$mnYear = $nextYear;
	}
	$nextMonth = $nextMonth < 10 ? '0'.$nextMonth : $nextMonth;
	
	
	//日历头
	$html = '
<table width="380" border="1">
 
  <tr align="center" >
    <td class="top_title"><a id="premonth" data-year="'.$mpYear.'" class="pref" data-month="'.$preMonth.'" href="javascript:;">上一月</a></td>
    <td colspan="3" class="top_title">'.$year.'年'.$month.'月</td>
	 <td class="top_title"><a id="nextmonth" data-year="'.$mnYear.'" class="next" data-month="'.$nextMonth.'" href="javascript:;">下一月</a></td>
	
  </tr>
  <tr>
  	<td colspan="5">
		<table width="100%" border="1">
			<tr align="center">
				<td style="background-color:#DAF0DD;height:25px;">星期一</td>
				<td style="background-color:#DAF0DD;height:25px;">星期二</td>
				<td style="background-color:#DAF0DD;height:25px;">星期三</td>
				<td style="background-color:#DAF0DD;height:25px;">星期四</td>
				<td style="background-color:#DAF0DD;height:25px;">星期五</td>
				<td style="background-color:#F60;color:#fff;font-weight: bold;">星期六</td>
				<td style="background-color:#F60;color:#fff;font-weight: bold;">星期天</td>
			</tr>
';
	
	$currentDay = $nowDate->format('Y-m-j' );
	
	//当月最后一天
	$creatDate = new DateTime("$year-$nextMonth-0");
	$lastday = $creatDate->format('j');
	$creatDate = NULL;
	
	//循环输出天数
	$day = 1;
	$line = '';
	while ( $day <= $lastday )
	{
		$cday = $year . '-' . $month . '-' . $day;
		
		//当前星期几
		$creatDate = new DateTime("$year-$month-$day");
		$nowWeek = $creatDate->format('N');
		$creatDate = NULL;
		
		if ($day == 1)
		{
			$line = '<tr align="center">';
			$line .= str_repeat ( '<td>&nbsp;</td>', $nowWeek - 1 );
		}
		if ($cday == $currentDay)
        {
            $style = 'style="font-size:16px; font-family:微软雅黑,Arial,Helvetica,sans-serif;color:#FF6600;line-height:22px;"';
        } else
        {
            $style = 'style=" font-size:16px; font-family:微软雅黑,Arial,Helvetica,sans-serif;line-height:22px;"';
        }
		//判断当前的日期是否小于今天
        $defaultmktime = mktime(1,1,1,$month,$day,$year);

        $currentmktime = mktime(1,1,1,date("m"),date("j"),date("Y"));
        //echo '<hr>';
        $tday   = ($day<10) ? '0'.$day : $day;
        $cdayme = $defaultYM . '-' . $tday;
		
        //单价
        $dayPrice = $priceArr[$cdayme]['price'];

        //库存
        $number = $priceArr[$cdayme]['number']!=-1 ? $priceArr[$cdayme]['number'] : '不限';

		

         //定义单元格样式，高，宽
       $tdStyle   = "height='50'";
         //判断当前的日期是否小于今天
		$tdcontent = '<span class="num">'.$day.'</span>'; 
        if($defaultmktime>=$currentmktime)
		{
            
			
            if($dayPrice)
            {

				    $dayPriceStrs  = '¥'.$dayPrice;
				    $tdcontent.='<b class="yes_yd">'.$dayPriceStrs.'</b>';
			        $onclick   = 'onclick="checkAdd(1,\''.$cday.'\',\''.$dayPrice.'\')"';
                    $line     .= "<td $tdStyle $onclick style='cursor:pointer;' >".$tdcontent."</td>";

                 

                    
                   

            }
			else
            {
                $dayPriceStrs  = '不可订';
                $tdcontent.='<b class="no_yd">'.$dayPriceStrs.'</b>';
                $line     .= "<td $tdStyle >".$tdcontent."</td>";
            }
        }
		else
		{
            $dayPriceStrs  = '不可订';
            $tdcontent.='<b class="no_yd">'.$dayPriceStrs.'</b>';
            $line     .= "<td $tdStyle >".$tdcontent."</td>";
        }

		
		
		//$line .= "<td $style>$day <div>不可订</div></td>";
		
		//一周结束
		if ($nowWeek == 7)
		{
			$line .= '</tr>';
			$html .= $line;
			$line = '<tr align="center">';
		}
		
		//全月结束
		if ($day == $lastday)
		{
			if ($nowWeek != 7)
			{
				$line .= str_repeat ( '<td>&nbsp;</td>', 7 - $nowWeek );
			}
			$line .= '</tr>';
			$html .= $line;
			
			break;
		}
		
		$day ++;
	}
	
	$html .= '
		</table>	
	</td>
  </tr>
</table>
';
	return $html;
}

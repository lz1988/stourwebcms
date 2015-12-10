<?php 
require_once(dirname(__FILE__)."/../include/common.inc.php");
require_once(dirname(__FILE__)."/../include/visit_stats.class.php");
$channel=array("1"=>'#@__line','2'=>'#@__hotel','3'=>'#@__car','4'=>'#@__article','5'=>'#@__spot','6'=>'#@__photo');
//网友推荐
if($dopost=='yes')
{
  if($typeid==3)
  {
	  $sql="update {$channel[$typeid]} set frecommend=ifnull(frecommend,0)+1 where webid=$webid and aid=$aid"; 
  }	
  else
  {
    $sql="update {$channel[$typeid]} set yesjian=ifnull(yesjian,0)+1 where webid=$webid and aid=$aid";
  }
  if($dsql->ExecuteNoneQuery($sql))
  {
     echo 'ok';
  }

}
//网友不推荐
else if($dopost=='no')
{
  if($typeid==3)
  {
	  $sql="update {$channel[$typeid]} set funrecommend=ifnull(funrecommend,0)+1 where webid=$webid and aid=$aid";
  }
  else
  {
    $sql="update {$channel[$typeid]} set nojian=ifnull(nojian,0)+1 where webid=$webid and aid=$aid";
  }
  if($dsql->ExecuteNoneQuery($sql))
  {
     echo 'ok';
  }
}
//添加结伴信息
else if($dopost=='addjieban')
{
	$aid=GetLastAid('#@__leave',0);
	$time=time();
	$title="{$leavename}拼团结伴信息";
	$leaveip=GetIP();
	$sql="insert into #@__leave(webid,aid,leavename,qq,msn,email,title,content,leaveip,telephone,ishidden,addtime,ismust,typeid,postid) values('0','$aid','$leavename','$qq','$msn','$email','$title','$content','$leaveip','$telephone','','$time','$musttime','$typeid','$postid')";
	
	if($dsql->ExecuteNoneQuery($sql))
    {
      echo 'ok';
    }
}

//按区域获取车报价
if($dopost=='getcarprice')
{
  	$sql="select * from #@__car_month where carid=$aid and webid=0 and kindarea='$kindarea' limit 0,1";
	
	$row=$dsql->GetOne($sql);
	if(is_array($row))
	{
       $out=" <li><span class=\"yuefen\">一月</span><span class=\"color_hong\">".SetMoney($row['one'])."</span></li>";
	   $out.="<li><span class=\"yuefen\">二月</span><span class=\"color_hong\">".SetMoney($row['two'])."</span></li>";
	   $out.="<li><span class=\"yuefen\">三月</span><span class=\"color_hong\">".SetMoney($row['three'])."</span></li>";
	   $out.="<li><span class=\"yuefen\">四月</span><span class=\"color_hong\">".SetMoney($row['four'])."</span></li>";
	   $out.="<li><span class=\"yuefen\">五月</span><span class=\"color_hong\">".SetMoney($row['five'])."</span></li>";
	   $out.="<li><span class=\"yuefen\">六月</span><span class=\"color_hong\">".SetMoney($row['six'])."</span></li>";
	   $out.="<li><span class=\"yuefen\">七月</span><span class=\"color_hong\">".SetMoney($row['seven'])."</span></li>";
	   $out.="<li><span class=\"yuefen\">八月</span><span class=\"color_hong\">".SetMoney($row['eight'])."</span></li>";
	   $out.="<li><span class=\"yuefen\">九月</span><span class=\"color_hong\">".SetMoney($row['nine'])."</span></li>";
	   $out.="<li><span class=\"yuefen\">十月</span><span class=\"color_hong\">".SetMoney($row['ten'])."</span></li>";
	   $out.="<li><span class=\"yuefen\">十一月</span><span class=\"color_hong\">".SetMoney($row['eleven'])."</span></li>";
	   $out.="<li><span class=\"yuefen\">十二月</span><span class=\"color_hong\">".SetMoney($row['twelve'])."</span></li>";
	}
	echo $out;
}

if($dopost == 'visit')
{
	$visit = new Visit_Stats($referrer, $php_self);
	$visit->Visit();
}

if($dopost == 'getPrice')
{
	$sql="select * from #@__hotel_month where roomid='$hotelid'";
	$dsql->SetQuery($sql);
    $dsql->Execute();
	$str='';
	$str='{"data":[ ';
    while($row = $dsql->GetArray())
	{
		$priceArr = explode('||', $row['price']);
		$descArr = explode('||', $row['description']);
		for($i = 0; isset($priceArr[$i]); $i++)
		{
			$idx = $i + 1;
			$price = explode(' ', $priceArr[$i]);
			$desc = explode(' ', $descArr[$i]);
			$tprice = getTicketPrcie('day' . $idx, $tid, $row['yearnum'], $row['monthnum']);
			if($price[1]!=0 && !empty($tprice))
			{
				$month=$row['monthnum'];	
				$sql = "select start, end, info from #@__hotel_change where roomid='$hotelid'";
				$change = $dsql->getAll($sql);
				$today = time();
				$info = '';
				foreach($change AS $val)
				{
					$info .= MyDate('Y-m-d', $val['start']) . '::' . MyDate('Y-m-d', $val['end']) . '::' . $val['info'] . ";";
				}
				$info = substr($info, 0, strlen($info) - 1);
				$title = $price[1] + $tprice;
				$title = $title == 0 ? 0 : $title;
				$description=$desc[1];
				
				if($idx<10)
				{
					$idx="0".$idx;
				}
			    $str.='{ "pdatetime": "'.$row['yearnum'].'-'.$month.'-'.$idx.'", "price": "'.$title.'", "description": "'.$description.'", "info": "' . $info . '"},';
			}
		}
	}
	$str = substr($str, 0 ,strlen($str) - 1);
	$str.=' ]}';
	echo $str;
	exit();
}

if($dopost == 'getline')
{
	$offset = $num * $pagesize;
	$fields="distinct a.aid,a.webid,a.title,a.seotitle,a.sellpoint,a.litpic as litpic,a.storeprice,a.price,a.linedate,a.transport,a.lineday,a.startcity,a.overcity,a.shownum,a.satisfyscore,a.bookcount";
	$sql="select {$fields},b.isjian as jian,b.isding as ding,b.istejia as te,b.displayorder from #@__line as a left join #@__kindorderlist b on (a.id=b.aid and b.typeid=1 and b.classid={$destid}) where FIND_IN_SET($destid,a.kindlist) order by b.isding desc,case when b.displayorder is null then 9999 end,b.displayorder asc limit {$offset}, {$pagesize}";
	$res = $dsql->getAll($sql);
	$html = '';
	$jsonArr = array();
	foreach($res AS $row)
	{
		$webroot = GetWebURLByWebid($row['webid']);
		$url = ($row['webid']==0) ? "/lines/show_{$row['aid']}.html" : $webroot . "/lines/show_{$row['aid']}.html";;
		$url = $GLOBALS['cfg_cmsurl'].$url;
		$litpic = getUploadFileUrl($row['litpic']);
		
		$extend = '';
		if($row['jian'] == 1)
		{
			$extend .= '<img src="' . $GLOBALS['cfg_templets_skin'] . '/images/hot.gif" />';
		}
		if($row['te'] == 1)
		{
			$extend .= '<img src="' . $GLOBALS['cfg_templets_skin'] . '/images/te_pic.gif" />';
		}
		
		if($row['transport'] == 1)
		{
			$trans = '飞机';
		}
		else if($row['transport'] == 2)
		{
			$trans = '汽车';
		}
		else if($row['transport'] == 3)
		{
			$trans = '火车';
		}
		else if($row['transport']==4)
		{
			$trans = '轮船';
		}
		$lprice = empty($row['price']) ? '电询' : '<span class="rmb_1">￥</span>' . $row['price'];
		//$point = empty($row['sellpoint']) ? '' : getSellpoint($row['sellpoint']);
		$html .= '<ul class="l-cl">
                      <li class="cl-img">
                          <a href="' . $url . '"><img src="' . $litpic . '" alt="' . $row['title'] . '" width="112" height="84" /></a>
                      </li>
                      <li class="cp_pb_ms">
                          <span><a href="' . $url . '">' . $row['title'] . $extend . '</a></span>' . '
                          <span class="manyi_du">满 意 度：<span class="faction">' . $row['satisfyscore'] . '</span>累计预订数<span class="danshu">' . $row['bookcount'] . '</span>单<span class="xl_hi">人气：<b>' . $row['shownum'] . '</b></span></span>
                          <span class="xl_sm">交通方式：<span class="jtfs_ys">' . $trans . '</span></span>
                          <span class="xl_sm">出行天数：<span class="day_ys_1">' . $row['lineday'] . '</span>天</span>
                      </li>
                      <li class="ft_date">' . $row['linedate'] . '</li>
                      <li class="cp_yhj">' . $lprice . '</li>
                  </ul>';
	}
	$jsonArr['mess'] = true;
	$jsonArr['html'] = $html;
	echo json_encode($jsonArr);
}
function SetMoney($str)
{
 	return (empty($str)||$str==0) ? '电询' : "￥{$str}";	 
} 

function getTicketPrcie($day, $tid, $year, $month)
{
	global $dsql;
	$sql = "select {$day} from #@__ticket_month where ticketid='$tid' and yearnum='$year' and monthnum='$month'";
	$row = $dsql->GetOne($sql);
	return empty($row[$day]) ? 0 : $row[$day];
}
?>

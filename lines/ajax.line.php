<?php 
/*-----线路ajax操作控制器-----*/
require_once(dirname(__FILE__)."/../include/common.inc.php");
//获取线路报价(原来版本)
if($dopost=='getlineprice')
{
	$sql="select * from #@__line_month where lineid='$lineaid' and webid='0'";
	$dsql->SetQuery($sql);
    $dsql->Execute();
	$str='';
	$str='{"data":[ ';
	
	$hasbook=false;
    while($row = $dsql->GetArray())
	{
		$priceArr = explode('||', $row['price']);
		$basicArr = explode('||', $row['basicprice']);
		$profitArr = explode('||', $row['profit']);
		$descArr = explode('||', $row['description']);
		for($i = 0; $i < 31; $i++)
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
				$tday=strtotime($row['yearnum'].'-'.$month.'-'.$idx);
				
				if($tday>time())
				   $hasbook=true;
				
				$str.='{ "pdatetime": "'.$row['yearnum'].'-'.$month.'-'.$idx.'", "price": "'.$title.'","childprice": "", "description": "'.$description.'", "info": ""},';
				//$str.='{ "EventID": '.$idx.', "StartDateTime": "'.$row['yearnum'].'-'.$month.'-'.$idx.'", "Title": "￥'.$title.'", "URL": "' . $GLOBALS['cfg_cmsurl'] . '/lines/booking_'.$row['lineid'].'_'.$title.'_'.$row['yearnum'].'-'.$month.'-'.$day.'.html", "Description": "'.$description.'", "CssClass": "Meeting" },';
			}
		}
	}
	//$str.=" ]";
	$str = substr($str, 0 ,strlen($str) - 1);
	$str.=' ]}';
	if($hasbook)
	echo $str;
	exit();
}
//根据目的地id获取相应的线路（线路首页用）

if($dopost == 'getLineByDestId')
{
	$where = " where a.ishidden=0 and FIND_IN_SET({$dest_id},a.kindlist)";
	$leftjoin = "left join #@__kindorderlist b on(a.id = b.aid and b.classid = {$dest_id} and b.typeid=1)";
	$sql = "select a.* from #@__line a {$leftjoin} {$where} order by b.isding desc,b.isjian desc,case when b.displayorder is null then 9999 end,b.displayorder asc,a.addtime desc limit 0,6";
	$arr = $dsql->getAll($sql);
	$out = $left = $right = '';
	$k = 1;
	foreach($arr as $row)
	{
		
		
		$url = GetWebURLByWebid($row['webid']).'/lines/show_'.$row['aid'].'.html';
		$litpic = getUploadFileUrl($row['litpic']);
        $startcity = getStartCityName($row['startcity']);
        $startcity = !empty($startcity) ? "[{$startcity}出发]" : '';
		$linename = "{$startcity}{$row['linename']}";
		$award2 = !empty($row['jefentprice']) ? $row['jefentprice'] : 0 ;
        $booknum = Helper_Archive::getSellNum($row['id'],1)+$row['bookcount'];
        $real=getLineRealPrice($row['aid'],$row['webid']);
        $row['lineprice']=$real ? $real : $row['price'];
		if($k < 5) //读取前4张
		{
			$left.=' <div class="list_con_sy">
                    <div class="sy_img"><a class="fl" href="'.$url.'" title="'.$linename.'"><img class="fl" src="'.$litpic.'" width="100" height="80" alt="'.$linename.'" /></a></div>
                    <div class="sy_txt">
                    <p class="p1"><a href="'.$url.'" target="_blank">'.$linename.'</a></p>
                    <p class="p2">'.$row['sellpoint'].'</p>
                    <p class="p3">
                      <span>销量：<b>'.$booknum.'</b>人已购买</span>
                      <span>评论：<b>'.Helper_Archive::getCommentNum($row['id'],1).'</b>条评论</span>
                      <span class="sp_star"><strong class="fl">满意度：</strong><b><s style=" width:'.Helper_Archive::getSatisfyScore($row['id'],1).'"></s></b></span>
                    </p>
                  </div>
                  <div class="sy_price">
                    <p class="p1">&yen;<strong>'.$row['lineprice'].'</strong><span>起</span></p>
                    <p class="p2"><span>'.$award2.'</span></p>
                  </div>
                </div>	';
			
		}
		else //读取最后2张
		{
			$right.='<li>
                    <div class="hot_img"><s></s><a class="fl" href="'.$url.'" title="'.$linename.'"><img class="fl" src="'.$litpic.'" width="190" height="140" alt="'.$linename.'" /></a></div>
                    <div class="hot_tit"><a href="'.$url.'" target="_blank">'.$linename.'</a></div>
                    <div class="hot_txt">本季惊爆价：<span>&yen;'.$row['lineprice'].'</span>起</div>
                  </li>';
			
		}
		$k++;
		
		
	   	
	}
	
	   $out='<div class="line_con_l">
               
              '.$left.'
              </div>
            
              <div class="line_con_r">
                <ul class="hot_tj_ul">
               '.$right.'
                </ul>
              </div>';
       echo $out;
	   exit();
	
}



//新版读取日历报价
if($dopost=='getlineprice2')
{
    $time = strtotime(date('Y-m-d',time()));
    $sql="select * from #@__line_suit_price where suitid='$suitid' and day >='$time' and adultprice>0 and `number`!=0 ";
    //echo $sql;
    $arr=$dsql->getAll($sql);
    $str='';
    $str='{"data":[ ';

    $lineid=$arr[0]['lineid'];
    $dayBeforeNum=0;
    if(!empty($lineid))
    {
        $dayBeforeInfo=$dsql->GetOne("select linebefore from #@__line where id=$lineid");
        $dayBeforeNum=!empty($dayBeforeInfo['linebefore'])?$dayBeforeInfo['linebefore']:$dayBeforeNum;
    }
    $dayBefore=$time;
    if(isLineBefore($lineid))
    {
        $dayBefore+=$dayBeforeNum*24*60*60;
    }

    foreach($arr as $row)
    {
        if($row['day']<$dayBefore)
            continue;
        $day = date('Y-m-d',$row['day']);//
        $adultprice = $row['adultprice'];//成人价格
        $number = $row['number']==-1 ? '余位充足' : '余位 '.$row['number'];
        //if($row['number']==0)continue;
        //$oldprice = $row['oldprice'];//老人价格
        $str.='{ "pdatetime": "'.$day.'", "price": "'.$adultprice.'","childprice": "","description": "'.$number.'", "info": ""},';

    }
    //$str.=" ]";
    $str = substr($str, 0 ,strlen($str) - 1);
    $str.=' ]}';
    echo $str;
    exit();
}

//根据日期获取报价.
if($dopost == 'getpricebydate')
{
    $time = strtotime($nowdate);
    $sql="select adultprice,childprice,oldprice from #@__line_suit_price where suitid='$suitid' and day ='$time' and adultprice>0";
    $row = $dsql->GetOne($sql);
    echo json_encode($row);
    exit;

}

//获取optionlist(列表下拉选择报价)
if($dopost == 'getoptionlist')
{

    $time = strtotime(date('Y-m-d'));//现在时间
    $sql = "select * from #@__line_suit_price where suitid='$suitid' and day >= '$time' and adultprice>0 and `number`!=0 limit 0,30";


    $arr = $dsql->getAll($sql);
    $monthli = '';
    $suitinfo = getPeopleGroup($suitid);
    $group = explode(',',$suitinfo['propgroup']);//适用人群
    $jifentprice = $suitinfo['jifentprice'] ? $suitinfo['jifentprice'] : '无';
    $jifenbook = $suitinfo['jifenbook'] ? $suitinfo['jifenbook'] : '无';
    $jifenarr = array('jifentprice'=>$jifentprice,'jifenbook'=>$jifenbook);
    $out = array();

    $lineid=$arr[0]['lineid'];
    $dayBeforeNum=0;
    if(!empty($lineid))
    {
        $dayBeforeInfo=$dsql->GetOne("select linebefore from #@__line where id=$lineid");
        $dayBeforeNum=!empty($dayBeforeInfo['linebefore'])?$dayBeforeInfo['linebefore']:$dayBeforeNum;
    }
    $dayBefore=$time;
    if(isLineBefore($lineid))
    {
        $dayBefore+=$dayBeforeNum*24*60*60;
    }

    foreach($arr as $row)
    {
        if($row['day']<$dayBefore)
            continue;
        $day = date('Y-m-d',$row['day']); //m-d
        $weekday = '周'.getWeekDay(date('w',$row['day']));//周X
        if(in_array(2,$group)) 
        {
            $adultprice = $row['adultprice'];
            $peopleinfo = '成人价 '.$adultprice;
            $out['hasadult'] = 1;

        }
        if(in_array(1,$group) && !empty($row['childprice']))
        {
            $childprice = $row['childprice'];
            $peopleinfo .= '儿童价 '.$childprice;
            $out['haschild'] = 1;
        }

        if(in_array(3,$group) && !empty($row['oldprice']))
        {   
			
            $oldprice = $row['oldprice'];
			
            $peopleinfo.= '老人价 '.$oldprice;
            $out['hasold'] = 1;
        }
        //$peopleinfo = $row['number']==0 ? $peopleinfo.'库存:充足' : $peopleinfo.'库存:'.$row['number'];
        $text = $day.'('.$weekday.')'.$peopleinfo;
        $text .= empty($row['roombalance'])?'':'(单房差:'.$row['roombalance'].'元)';
        $monthli.='<option value="'.$day.'" data-price="'.$adultprice.'" data-childprice="'.$childprice.'" data-oldprice="'.$oldprice.'" data-number="'.$row['number'].'">'.$text.'</option>';



    }

    $out['monthli']=$monthli;
    $out['jifen']=$jifenarr;

    echo json_encode($out);
    exit;
}


//获取行程景点信息,暂用于百度地图信息
if($dopost == 'getdayspots')
{

    $sql = "select * from #@__line_dayspot where lineid='$lineid'";

    $arr = $dsql->getAll($sql);
   
    $out = array();
    foreach($arr as $key=>$row)
    {
        $spotinfo = getInfo('#@__spot',"where id='{$row['spotid']}' ",'id,aid,content,litpic,title,lng,lat');
        $spotpic = getUploadFileUrl($spotinfo['litpic']);
        $linkurl = "/spots/show_".$spotinfo['aid'].".html"; 
        $description = cutstr_html(strip_tags($spotinfo['content']),100);//景点描述
        $outstr = "<div style='width:300px;'>";
        $outstr .= "<h4 style='margin:0 0 5px 0;padding:0.2em 0'><a href='".$linkurl."' target='_blank'>".$spotinfo['title']."</a></h4>";
        $outstr .= "<img style='float:right;margin:4px' id='imgDemo' src='".$spotpic."' width='139' height='104' title='".$spotinfo['title']."'/>"; 
        $outstr .= "<p style='margin:0;line-height:1.5;font-size:13px;text-indent:2em'>".$description."<a href='".$linkurl."' target='_blank'>[<font color='#01aec8'>查看详情</font>]</a></p>"; 
        $outstr .= "</div>";
        $out[$key][] = $spotinfo['lng'];
        $out[$key][] = $spotinfo['lat'];
        $out[$key][] = $outstr;
    }

    echo json_encode($out);
    exit;
}

//获取套餐适用人群与优惠
function getPeopleGroup($suitid)
{

    Helper_Archive::loadModule('common');
    $model = new CommonModule('#@__line_suit');
    $group = $model->getOne("id='$suitid'",null,'propgroup,jifentprice,jifenbook');
    return $group;

}
//获取星期
function getWeekDay($num)
{
    $arr=array('日','一','二','三','四','五','六');
    return $arr[(int)$num];
}
function isLineBefore($lineid)
{
    global $dsql;
    if(empty($lineid))
        return false;
    $islineBeforeArr=$dsql->GetOne("select islinebefore from #@__line where id=$lineid");
    if($islineBeforeArr['islinebefore']==1)
        return true;
    return false;
}

<?php 
  require_once(dirname(__FILE__)."/../include/common.inc.php");
  require_once(dirname(__FILE__)."/../data/webinfo.php");
  require_once(dirname(__FILE__)."/../include/email.class.php");
  require_once SLINEINC."/view.class.php";
  
  //防止跨站脚本攻击
  foreach($_POST as $key=>$value)
  {
	 $_POST[$key]=RemoveXSS($value);
  }
  foreach($_GET as $key=>$value)
  {
	 $_GET[$key]=RemoveXSS($value);
  }
  
  $typeid=2; //栏目id
  $typename=GetTypeName($typeid);//获取栏目名称
  $pv = new View($typeid);
  
 if(empty($dopost))
 {

  $info=getHotelInfo($hotelid);

  $roominfo = getRoomInfo($roomid);

  $suitid = $roomid;

  if(!isset($info))
  {
     head404();
  }
  $info['series']=getSeries($info['id'],'02');//编号
  $info['title'] = $info['title']."({$roominfo['roomname']})";
  $info['roomname'] = $roominfo['roomname'];//房型名称
  $info['roomid'] = $roominfo['id'];//房型id
  $info['productautoid'] = $info['id'];
  //$info['price'] = $roominfo['price'];

  if(!empty($info['dingjin']))$GLOBALS['condition']['_djsupport']=1;//是否支持定金
  if(!empty($roominfo['jifentprice']))$GLOBALS['condition']['_has_jifentprice']=1;
  if(!empty($roominfo['jifencomment']))$GLOBALS['condition']['_has_jifencomment']=1;
  if(!empty($roominfo['jifenbook']))$GLOBALS['condition']['_has_jifenbook']=1;
  
  $udateArr = explode('|',$udate);
  $dnumArr = explode('|',$dnum);
  $dpriceArr = explode('|',$dprice);
  
  $roomdinginfo = getRoomArr($udateArr,$dnumArr,$dpriceArr);//已经选择了房型间数与入住日期.
  
  //如果用户是登陆状态,获取用户信息
  if($User->uid)
  {
	 $userinfo = $User->getInfoByMid($User->uid);//获取用户信息 
	 $info['linkman'] = $userinfo['truename'];
	 $info['linktel'] = $userinfo['mobile'];
	 $info['linkemail'] = $userinfo['linkemail'];
	 
  }

     if($roominfo['jifentprice'])
     {
         $needjifen = $cfg_exchange_jifen * $suitinfo['jifentprice']; //所需积分
         if($User->uid)
         {
             if($userinfo['jifen']>$needjifen)
             {
                 $exopen = 1;
             }
             else
             {
                 $exopen = 0;
             }


             $userstatus = "(<span style='color:red'>当前积分:{$userinfo['jifen']}</span>)";
             $islogin=1;
         }
         else
         {
             $userstatus = "(<span style='color:red'><a style=\"color:red\" href=\"{$GLOBALS['cfg_cmsurl']}/member/login.php\">立即登陆</a></span>)";
             $exopen = 0;
             $islogin = 0;
         }

         $jifenpricemsg = " <span style='color:orange'>使用{$needjifen}积分抵现{$suitinfo['jifentprice']}元</span> ".$userstatus;
         $info['jifenpricemsg'] = $jifenpricemsg;
         $info['needjifen'] = $needjifen;
         $info['exopen'] = $exopen ;//优惠是否开启.
         $info['islogin'] = $islogin;
         $info['myjifen'] = $userinfo['jifen'];
     }

  
  foreach($info as $k=>$v) 
  {
	  $pv->Fields[$k] = $v;
  }
  foreach($roominfo as $k=>$v) 
  {
	  $pv->Fields[$k] = $v;
  }
 $pkname = get_par_value($info['kindlist'],$typeid);//上一级
 //获取上级开启了导航的目的地
  getTopNavDest($info['kindlist']);

  $pv->SetTemplet(SLINETEMPLATE ."/".$cfg_df_style ."/" ."hotels/" ."hotel_booking.htm");

  $pv->Display();
  exit();
 }
//保存订单
else if($dopost=="savebooking")
{
    //验证验证码
    $checkcode=$_POST['checkcode'];
    $orgCheckcode=GetCkVdValue();

    if($checkcode!=$orgCheckcode||empty($checkcode))
    {
        echo 'nocheckcode';
        return;
    }
    $_SESSION['total_value']='';
    //$tourer = Helper_Archive::getTourer($_POST);

    $rid = $_POST['roomid'];
    $roominfo = getRoomInfo($rid);
    $tourer = Helper_Archive::getTourer($_POST);

    $needjifen = $usejifen ? Helper_Archive::getNeedJifen($jifentprice) : 0;
    $userinfo = $User->getInfoByMid($User->uid);//获取用户信息
    //这里再次判断用户积分是否满足条件.
    if($userinfo['jifen']<$needjifen)
    {
        $usejifen = 0;
        $needjifen = 0;

    }
   $udate = explode("|",$udate);
   $dnum = explode("|",$dnum);
   $dprice = explode('|',$dprice);
   $memberid = $User->uid ? $User->uid : 0;
   $status = $paytype==1 ? 1 : 0;
   //$roominfo = getRoomInfo($suitid);
   $ordersn = get_order_sn('02');
   $linktel=Helper_Archive::pregReplace($linktel,2);
   $arr = array(
           'ordersn'=>$ordersn,
		   'webid'=>0,
		   'typeid'=>$typeid,
		   'productautoid'=>$productautoid,
		   'productaid'=>$productaid,
		   'productname'=>$productname,
		   'childprice'=>0,
		   'childnum'=>$childnum,
		   'linkman'=>Helper_Archive::pregReplace($linkman,5),
		   'linktel'=>Helper_Archive::pregReplace($linktel,2),
		   'linkemail'=>Helper_Archive::pregReplace($linkemail,5),
		   'linkqq'=>'',
		   'jifentprice'=>$jifentprice,
		   'jifenbook'=>$jifenbook,
		   'jifencomment'=>$jifencomment,
		   'addtime'=>time(),
		   'memberid'=>$memberid,
		   'dingjin'=>Helper_Archive::pregReplace($dingjin,2),
		   'suitid'=>$suitid,
           'paytype'=>$paytype,
           'status'=>$status,
           'haschild'=>1,
           'remark'=>Helper_Archive::pregReplace($remarkinfo,5)

   );
 
   $mainid = Helper_Archive::addOrder($arr,0); //主定单id
   $num = $dnum[0];
  
   $j=0;
   for($i=0;isset($udate[$i]);$i++)
   {
	   $ordersn=get_order_sn('02');//订单号
       $store_num = getCurrentStore($udate[$i],$suitid);
       if(intval($dnum[$i])<=$store_num || $store_num==-1)//库存
       {
           $arr['dingnum']=$dnum[$i];
           //$arr['price'] = $dprice[$i];
           $arr['price'] = getActualPrice($suitid,$udate[$i]);
           $arr['usedate'] = $udate[$i];
           $arr['ordersn'] = $ordersn;
           if($i==0 && !empty($usejifen))
           {
               $arr['usejifen'] = $usejifen;
               $arr['needjifen'] = $needjifen;
           }
           else
           {
               $arr['usejifen'] = 0;
               $arr['needjifen'] = 0;
           }
           $arr['pid']=$mainid;
           $arr['haschild']=0;
           $flag = Helper_Archive::addOrder($arr);
           $j++;
       }

   }
   $usedate = $arr['usedate'];
   $price =  $arr['price'] ;
   $remark   = $arr['remark'];
   //echo $price;exit;
   //如果j=0,则库存不能满足用户预订
   if($j==0)
   {
       del_hotel_order($mainid);
       echo 'nonumber';
       exit;
   }
   
  
   if($flag)
   {
       //判断是否开启在线支付且不是二次确认付款

       if(!empty($choosepay) && $roominfo['paytype']!='3' && $choosepay!='6')
       {
           $url = $GLOBALS['cfg_basehost'].'/hotels/booking.php?dopost=payonline&id='.$mainid.'&paytype='.$choosepay;
       }
       else
       {

           //$url = "{$GLOBALS['cfg_basehost']}/hotels/show_{$arr['productaid']}.html";
		   $url = "{$GLOBALS['cfg_basehost']}/member/query.php?dopost=search&mobile=$linktel";

       }

		 $mailto = $cfg_Email139;
		 $title   = $linename . "酒店订单";
		 $content = $linkman . "预定" . $usedate  . $productname . "(价格:".$price.")"."酒店数量:".$num.";联系电话:".$linktel.";联系邮箱：".$linkemail."酒店留言：".$remark ."-----".$GLOBALS['cfg_webname'];
         if(!empty($mailto))ordermaill($mailto,$title,$content);

           //扣除积分
           if(!empty($usejifen))
           {
               $sql = "update sline_member set jifen=jifen-{$needjifen} where mid='{$memberid}'";
               $dsql->ExecuteNoneQuery($sql);
               Helper_Archive::addJifenLog($memberid,'预订产品{$productname}消费积分{$needjifen}',$needjifen,1);
           }
         echo $url;
		 exit();
   }
   else
   {
	   echo 'no';

   }



	    
		
	

}
//在线支付
if($dopost == 'payonline')
{
    $order_main_info = Helper_Archive::getOrderInfo($id);
    $orderlist = Helper_Archive::getChildOrder($id);
    $totalprice = 0;
    $totalnum = 0;
    foreach($orderlist as $row)
    {
        $totalprice += intval($row['dingnum']) * intval($row['price']);
        $totalnum+=$row['dingnum'];

    }
    if(!empty($order_main_info['dingjin']))
    {
        $totalprice = $totalnum * $order_main_info['dingjin'];
    }
    if(empty($totalprice))
    {
        $url = "{$GLOBALS['cfg_basehost']}/hotels/show_{$order_main_info['productaid']}.html";
        header("location:$url");
        exit;
    }
    echo Helper_Archive::payOnline($order_main_info['ordersn'],$order_main_info['productname'],$totalprice,$paytype);
}


/**
     *  获得预订酒店的基本信息
     *
     * @access    private
     * @return    array
     */
function getHotelinfo($id)
{
   global $dsql;
   $sql="select *,id as productid,aid as productaid from #@__hotel where id=$id";
   $row=$dsql->GetOne($sql);
   return $row;
}

function getRoomInfo($ticketid)
{
	global $dsql;
	$sql="select * from #@__hotel_room where id=$ticketid";
    $row=$dsql->GetOne($sql);
    return $row;
	
}
//生成所预订的房间数组
function getRoomArr($udate,$dnum,$dprice)
{
	$out = array();
	for($i=0 ;isset($udate[$i]);$i++)
	{
		$total = $dnum[$i] * $dprice[$i];
		$out[]=array('usedate'=>$udate[$i],'dingnum'=>$dnum[$i],'index'=>$i+1,'totalprice'=>$total,'singleprice'=>$dprice[$i]);
		
	}
	return $out;
	
}
//获取当前房型当前房型数量
function getCurrentStore($udate,$suitid)
{
    global $dsql;
    $day = strtotime($udate);
    $sql = "select number from sline_hotel_room_price where suitid='$suitid' and day='$day' ";
    $row = $dsql->GetOne($sql);
    return intval($row['number']);
}
//删除订单
function del_hotel_order($id)
{
    global $dsql;
    $sql = "delete from sline_member_order where id='$id'";
    $dsql->ExecNoneQuery($id);
}

//查询某个房型按日期的报价
function getActualPrice($suitid,$usedate)
{
    global $dsql;
    $udate = strtotime($usedate);
    $sql = "select price from sline_hotel_room_price where suitid='$suitid' and day='$udate'";
    $row = $dsql->GetOne($sql);
    return $row['price'];

}
?>

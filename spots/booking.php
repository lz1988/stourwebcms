<?php 
  require_once(dirname(__FILE__)."/../include/common.inc.php");
  require_once(dirname(__FILE__)."/../data/webinfo.php");
  require_once(dirname(__FILE__)."/../include/email.class.php");
  require_once SLINEINC."/view.class.php";
  

  $typeid=5; //景点栏目
  $typename=GetTypeName($typeid);//获取栏目名称
  $pv = new View($typeid);
  
 if(empty($dopost))
 {
  $info=getSpotInfo($spotid);

  $ticketinfo = getTicketInfo($ticketid);

  if(!isset($info))
  {
     head404();
  }
  $info['series']=getSeries($info['id'],'05');//编号
  $info['productname'] = $info['title']."({$ticketinfo['title']})";
  $info['ticketname'] = $ticketinfo['title'];//票的名称
  $info['singleprice'] = $ticketinfo['ourprice'];
  $info['usedate'] = date('Y-m-d');
  $info['ticketid'] = $ticketid;

  if(!empty($ticketinfo['dingjin']))$GLOBALS['condition']['_djsupport']=1;//是否支持定金
  if(!empty($ticketinfo['jifentprice']))$GLOBALS['condition']['_has_jifentprice']=1;
  if(!empty($ticketinfo['jifencomment']))$GLOBALS['condition']['_has_jifencomment']=1;
  if(!empty($ticketinfo['jifenbook']))$GLOBALS['condition']['_has_jifenbook']=1;

  
  //如果用户是登陆状态,获取用户信息
  if($User->uid)
  {
	 $userinfo = $User->getInfoByMid($User->uid);//获取用户信息 
	 $info['linkman'] = $userinfo['truename'];
	 $info['linktel'] = $userinfo['mobile'];
	 $info['linkemail'] = $userinfo['linkemail'];
	 
  }
   if($ticketinfo['jifentprice'])
    {
        $needjifen = $cfg_exchange_jifen * $ticketinfo['jifentprice']; //所需积分
        if($User->uid)
        {
            if($userinfo['jifen']>=$needjifen)
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

        $jifenpricemsg = " <span style='color:orange'>使用{$needjifen}积分抵现{$ticketinfo['jifentprice']}元</span> ".$userstatus;
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
      foreach($ticketinfo as $k=>$v)
      {
          $pv->Fields[$k] = $v;
      }
 $pkname = get_par_value($info['kindlist'],$typeid);//上一级
 //获取上级开启了导航的目的地
  getTopNavDest($info['kindlist']);

  $pv->SetTemplet(SLINETEMPLATE ."/".$cfg_df_style ."/" ."spots/" ."spot_booking.htm");

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

    $needjifen = $usejifen ? Helper_Archive::getNeedJifen($jifentprice) : 0;
    $userinfo = $User->getInfoByMid($User->uid);//获取用户信息
    //这里再次判断用户积分是否满足条件.
    if($userinfo['jifen']<$needjifen)
    {
        $usejifen = 0;
        $needjifen = 0;

    }

   $ordersn=get_order_sn('05');//订单号
   $memberid = $User->uid ? $User->uid : 0;
   $info=getSpotInfo($productautoid);
   $ticketinfo = getTicketInfo($suitid);
   $status = $paytype==1 ? 1 : 0;

   $total_store = intval($ticketinfo['number']);
   $total_dingnum = intval(Helper_Archive::pregReplace($dingnum,2));
    if($total_store!=-1 && $total_store < $total_dingnum) //库存判断
    {
        echo 'nonumber';
        exit;
    }

   $linktel=Helper_Archive::pregReplace($linktel,2);

   $arr = array(
           'ordersn'=>$ordersn,
		   'webid'=>$webid,
		   'typeid'=>$typeid,
		   'productautoid'=>$productautoid,
		   'productaid'=>$productaid,
		   'productname'=>$productname,
		   'price'=>$ticketinfo['ourprice'],
		   'childprice'=>0,
		   'dingnum'=>Helper_Archive::pregReplace($dingnum,2),
		   'usedate'=>$usedate,
		   'childnum'=>$childnum,
		   'linkman'=>Helper_Archive::pregReplace($linkman,5),
		   'linktel'=>Helper_Archive::pregReplace($linktel,2),
		   'linkemail'=>Helper_Archive::pregReplace($linkemail,5),
		   'linkqq'=>'',
		   'jifentprice'=>$ticketinfo['jifentprice'],
		   'jifenbook'=>$ticketinfo['jifenbook'],
		   'jifencomment'=>$ticketinfo['jifencomment'],
		   'addtime'=>time(),
		   'memberid'=>$memberid,
		   'dingjin'=>$dingjin,
		   'suitid'=>$suitid,
           'paytype'=>$paytype,
           'usejifen'=>$usejifen,
           'needjifen'=>$needjifen,
           'status'=>$status,
           'haschild'=>0,
           'pid'=>0,
           'remark'=>Helper_Archive::pregReplace($remarkinfo,5)

   );
  
   if(Helper_Archive::addOrder($arr))
   {

       $model = new CommonModule('#@__member_order');
       $orderid = $model->getField('id',"ordersn='$ordersn'");
       //判断是否开启在线支付
       if(!empty($choosepay)  && $paytype!='3' && $choosepay!='6')
       {
           $url = $GLOBALS['cfg_basehost'].'/spots/booking.php?dopost=payonline&id='.$orderid."&paytype=".$choosepay;
       }
       else
       {
           //$url = "{$GLOBALS['cfg_basehost']}/spots/show_{$arr['productaid']}.html";
		   $url = "{$GLOBALS['cfg_basehost']}/member/query.php?dopost=search&mobile=$linktel";

       }


	
	  
		 $mailto = $cfg_Email139;
		 $title   = $productname . "门票订单";
		 
		 $content = $linkman . "预定" . $usedate  . $productname . "(价格:".$price.")"."门票,数量:" . $dingnum . "张" ."联系电话:".$linktel."-----".$GLOBALS['cfg_webname'];
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
	  //Helper_Archieve::showMsg('订单提交失败!',-1,0,3);   
   }

    
	    
		
	

}
//在线支付
else if($dopost == 'payonline')
{
        $order = Helper_Archive::getOrderInfo($id);
        if(empty($order['dingjin'])) //非订金支付
        {
            $price = intval($order['dingnum']) * $order['price'];
            if(!empty($order['usejifen']) && !empty($order['jifentprice']))
            {
                $price = $price-intval($order['jifentprice']);//减去积分抵现的价格.
            }
        }
        else //订金支付
        {
            $price = intval($order['dingnum']) * $order['dingjin'];
            if(!empty($order['usejifen']) && !empty($order['jifentprice']))
            {
                $price = $price-intval($order['jifentprice']);//减去积分抵现的价格.
            }
        }
        if(empty($price))
        {
            $url = "{$GLOBALS['cfg_basehost']}/spots/show_{$order['productaid']}.html";
            header("location:$url");
            exit;

        }
        echo Helper_Archive::payOnline($order['ordersn'],$order['productname'],$price,$paytype);
}
 

    /**
     *  获得预订景点的基本信息
     *
     * @access    private
     * @return    array
     */
function getSpotinfo($id)
{
   global $dsql;
   $sql="select *,id as productid,aid as productaid from #@__spot where id=$id";
   $row=$dsql->GetOne($sql);
   return $row;
}

function getTicketInfo($ticketid)
{
	global $dsql;
	$sql="select * from #@__spot_ticket where id=$ticketid";

    $row=$dsql->GetOne($sql);

    return $row;
	
}
?>

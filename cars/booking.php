<?php 

require_once(dirname(__FILE__)."/../include/common.inc.php");
require_once(dirname(__FILE__)."/../data/webinfo.php");
require_once(dirname(__FILE__)."/../include/email.class.php");
require_once SLINEINC."/view.class.php";
require_once "car.func.php";
$typeid=3; //
$typename=GetTypeName($typeid);//获取栏目名称

if($dopost=='savebooking')
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
    if(empty($suitid))
	{
	  showMsg("请选择套餐",-1,3);
	  exit;
	}
    $row=$dsql->getOne("select a.*,b.aid,b.title from #@__car_suit a inner join #@__car b on a.carid=b.id  where a.id=$suitid");
   	if(empty($row))
	 {
	  showMsg("定购错误,请重试",-1,3);   
	  exit;
	 }
   $ordersn=get_order_sn('03');//订单号
   $memberid = $User->uid ? $User->uid : 0;
   $status = $paytype==1 ? 1 : 0;
   $price = getSuitPriceByDay($suitid,$usedate);

   $total_store = getSuitNumberByDay($suitid,$usedate);
   $total_dingnum = intval(Helper_Archive::pregReplace($dingnum,2));
    if($total_store!=-1 && $total_store < $total_dingnum) //库存判断
    {
        echo 'nonumber';
        exit;
    }


   $linktel=Helper_Archive::pregReplace($linktel,2);

   $arr = array(
           'ordersn'=>$ordersn,
		   'webid'=>0,
		   'typeid'=>3,
		   'productautoid'=>$row['carid'],
		   'productaid'=>$row['aid'],
		   'productname'=>$row['title'].'('.$row['suitname'].')',
		   'price'=>$price,
           'usedate'=>$usedate,
		   'dingnum'=>Helper_Archive::pregReplace($dingnum,2),
		   'linkman'=>Helper_Archive::pregReplace($linkman,5),
		   'linktel'=>Helper_Archive::pregReplace($linktel,2),
		   'linkemail'=>Helper_Archive::pregReplace($linkemail,5),
		   'linkqq'=>'',
		   'jifentprice'=>$row['jifentprice'],
		   'jifenbook'=>$row['jifenbook'],
		   'jifencomment'=>$row['jifencomment'],
		   'addtime'=>time(),
		   'memberid'=>$memberid,
		   'dingjin'=>$row['dingjin'],
           'paytype'=>$paytype,
           'usejifen'=>$usejifen,
           'needjifen'=>$needjifen,
           'status'=>$status,
           'haschild'=>0,
           'pid'=>0,
           'remark'=>Helper_Archive::pregReplace($remarkinfo,5)
   );

 $price =  $arr['price'] ;
$remark   = $arr['remark'];
  
  
   if(Helper_Archive::addOrder($arr))
   {
       $model = new CommonModule('#@__member_order');
       $orderid = $model->getField('id',"ordersn='$ordersn'");
       //判断是否开启在线支付
       if(!empty($choosepay) && $paytype!='3' && $choosepay!='6')
       {
           $url = $GLOBALS['cfg_basehost'].'/cars/booking.php?dopost=payonline&id='.$orderid."&paytype=".$choosepay;
       }
       else
       {
           //$url = "{$GLOBALS['cfg_basehost']}/cars/show_{$arr['productaid']}.html";
		   $url = "{$GLOBALS['cfg_basehost']}/member/query.php?dopost=search&mobile=$linktel";

       }
	
	   if($cfg_carEmail != '')
		 {
		     $mailto = $cfg_carEmail;
		 }
		 else
		 {
		     $mailto = $cfg_Email139;
		 }
         $productname = $row['title'].'('.$row['suitname'].')';
		 $title   = $productname . "租车订单";
		 
		  $content = $linkman . "预定" . $usedate  . $productname ."价格".$price. ";数量:" . $dingnum .";联系电话:".$linktel.";联系邮箱：".$linkemail."留言：".$remark ."-----".$GLOBALS['cfg_webname'];
         if(!empty($mailto))ordermaill($mailto,$title,$content);
		 
	    // Helper_Archive::showMsg('订单提交成功!',$url,1,3); 
		 echo $url;
       //扣除积分
       if(!empty($usejifen))
       {
           $sql = "update sline_member set jifen=jifen-{$needjifen} where mid='{$memberid}'";
           $dsql->ExecuteNoneQuery($sql);
           Helper_Archive::addJifenLog($memberid,'预订产品{$productname}消费积分{$needjifen}',$needjifen,1);
       }
	   exit();
   }
   else
   {
       echo $dsql->GetError();
	   echo 'no';

	  //Helper_Archieve::showMsg('订单提交失败!',-1,0,3);   
   }
	
	exit;
}
//在线支付
if($dopost == 'payonline')
{
    $order = Helper_Archive::getOrderInfo($id);
    $price = !empty($order['dingjin']) ? $order['dingjin'] * $order['dingnum'] : intval($order['dingnum']) * $order['price'];

    if(empty($price))
    {
        $url = "{$GLOBALS['cfg_basehost']}/cars/show_{$order['productaid']}.html";
        header("location:$url");
        exit;

    }
    echo Helper_Archive::payOnline($order['ordersn'],$order['productname'],$price,$paytype);
}


  $pv = new View($typeid);
  
  if(empty($suitid))
  {
	  Helper_Archive::showMsg("请选择套餐",-1,0);
  }
  $row=$dsql->GetOne("select a.*,a.id as suitid,a.unit as suitunit, b.* from #@__car_suit a left join #@__car b on a.carid=b.id where a.id='$suitid'");

  $userinfo=$User->getInfoByMid($User->uid);
  $row['carkind']=getCarKind($row['carkindid'],0);
  $row['carbrand']=getCarBrand($row['carbrandid'],0);
  $row['carnumber']=getSeries($row['id'],'03');//编号
  $row['typename']=GetTypeName($typeid);
  $price = getSuitPriceByDay($suitid,$usedate);
  $row['singleprice'] = $price;
  $row['usedate'] = $usedate;
  $row['title'] = $row['title'].$row['suitname'];

  if(!empty($price))
  {
	  $row['price']= $price;
	  if(!empty($row['suitunit']))
	  {
		  $row['price'] .= '  ';
	  }
	  else
	  {
		  $row['price'];
	  }
  }
  else
  {
	  $row['price'] = "电询";
  }

  if(!empty($row['dingjin']))$GLOBALS['condition']['_djsupport']=1;//是否支持定金
  if(!empty($row['jifentprice']))$GLOBALS['condition']['_has_jifentprice']=1;
  if(!empty($row['jifencomment']))$GLOBALS['condition']['_has_jifencomment']=1;
  if(!empty($row['jifenbook']))$GLOBALS['condition']['_has_jifenbook']=1;

    if($row['jifentprice'])
    {
        $needjifen = $cfg_exchange_jifen * $row['jifentprice']; //所需积分
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

        $jifenpricemsg = " <span style='color:orange'>使用{$needjifen}积分抵现{$row['jifentprice']}元</span> ".$userstatus;
        $row['jifenpricemsg'] = $jifenpricemsg;
        $row['needjifen'] = $needjifen;
        $row['exopen'] = $exopen ;//优惠是否开启.
        $row['islogin'] = $islogin;
        $row['myjifen'] = $userinfo['jifen'];
    }
    if(is_array($row))
    {
        foreach($row as $k=>$v)
        {
            $pv->Fields[$k] = $v;
        }

    }
    if(is_array($userinfo))
    {
        foreach($userinfo as $k=>$v)
        {
            $pv->Fields[$k] = $v;
        }
    }



$pv->SetTemplet(SLINETEMPLATE ."/".$cfg_df_style ."/" ."cars/" ."car_booking.htm");
  $pv->Display();
  exit;




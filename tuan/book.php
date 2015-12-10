<?php 

require_once(dirname(__FILE__)."/../include/common.inc.php");
require_once(dirname(__FILE__)."/../data/webinfo.php");
require_once SLINEINC."/view.class.php";
require_once "tuan.func.php";
$typeid=13;
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

    $row=$dsql->getOne("select * from #@__tuan where id=$tuanid");
   	if(empty($row))
	 {
	  showMsg("定购错误,请重试",-1,3);   
	  exit;
	 }
   $ordersn=get_order_sn('13');//订单号
   $memberid = $User->uid ? $User->uid : 0;
   $paytype = 1;
   $status = $paytype==1 ? 1 : 0;

   $linktel=Helper_Archive::pregReplace($linktel,2);

   $arr = array(
           'ordersn'=>$ordersn,
		   'webid'=>$webid,
		   'typeid'=>$typeid,
		   'productautoid'=>$tuanid,
		   'productaid'=>$row['aid'],
		   'productname'=>$row['title'],
		   'price'=>$row['price'],
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
           'paytype'=>$paytype,
		   'dingjin'=>$row['dingjin'],
           'usejifen'=>$usejifen,
           'needjifen'=>$needjifen,
           'status'=>$status,
           'remark'=>Helper_Archive::pregReplace($remarkinfo,5)

   );
  
   if(Helper_Archive::addOrder($arr))
   {

       $model = new CommonModule('#@__member_order');
       $orderid = $model->getField('id',"ordersn='$ordersn'");
       //判断是否开启在线支付
       if(!empty($choosepay) && $paytype!='3' && $choosepay!='6')
       {
           $url = $GLOBALS['cfg_basehost'].'/tuan/book.php?dopost=payonline&id='.$orderid."&paytype=".$choosepay;
       }
       else
       {

           //$url = "{$GLOBALS['cfg_basehost']}/tuan/show_{$arr['productaid']}.html";
		   $url = "{$GLOBALS['cfg_basehost']}/member/query.php?dopost=search&mobile=$linktel";
       }

		 $mailto = $cfg_Email139;

		 $title   = $row['title'] . "订单";
		 
		 $content = $linkman . "预定" . $usedate  . $row['title'] . "人数:" . $dingnum . "人" . ";联系电话:".$linktel."-----".$GLOBALS['cfg_webname'];
         if(!empty($mailto))ordermaill($mailto,$title,$content);
		 


           //扣除积分
           if(!empty($usejifen))
           {
               $sql = "update sline_member set jifen=jifen-{$needjifen} where mid='{$memberid}'";
               $dsql->ExecuteNoneQuery($sql);
               Helper_Archive::addJifenLog($memberid,"预订产品{$row['title']}消费积分{$needjifen}",$needjifen,1);
           }
         echo $url;
		 exit();
   }
   else
   {
	   echo 'no';

   }
	
	exit;
}
//在线支付
if($dopost == 'payonline')
{
    $order = Helper_Archive::getOrderInfo($id);
    if(empty($order['dingjin'])) //非订金支付
    {
        $price = intval($order['dingnum']) * $order['price'] ;
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
        $url = "{$GLOBALS['cfg_basehost']}/tuan/show_{$order['productaid']}.html";
        header("location:$url");
        exit;

    }
    echo Helper_Archive::payOnline($order['ordersn'],$order['productname'],$price,$paytype);
}


  $pv = new View($typeid);
  
  if(empty($tuanaid))
  {
	  Helper_Archive::showMsg("请选择团购",-1,0);
  }
  
    
  $row=$dsql->GetOne("select * from #@__tuan where aid='$tuanaid' and webid=0");
    if(!empty($row['jifentprice']))$GLOBALS['condition']['_has_jifentprice']=1;
    if(!empty($row['dingjin']))$GLOBALS['condition']['_djsupport']=1;//是否支持定金
    if($User->uid)
    {
        $userinfo = $User->getInfoByMid($User->uid);//获取用户信息
        $row['linkman'] = $userinfo['truename'];
        $row['linktel'] = $userinfo['mobile'];
        $row['linkemail'] = $userinfo['linkemail'];

    }
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
  
  $row['series']=getSeries($row['id'],'13');//编号
  $row['singleprice'] = $row['price'];
  $row['usedate'] = date('Y-m-d');
  foreach($row as $k=>$v)
  {
	  $pv->Fields[$k]=$v;
  }
  
  $pv->SetTemplet(SLINETEMPLATE ."/".$cfg_df_style ."/" ."tuan/" ."tuan_booking.htm");
  $pv->Display();
  exit();


<?php
require_once(dirname(__FILE__) . "/../include/common.inc.php");
require_once(SLINEROOT.'/tongyong/func.php');
require_once(dirname(__FILE__) . '/config.php');
require_once(SLINEINC . "/view.class.php");
require_once(SLINEINC . "/email.class.php");

$pv = new View($typeid);
  
 if(empty($dopost))
 {

  $info = TongYong::getProductInfo($aid,$typeid);
  $suitinfo = TongYong::getSuitInfo($suitid);


  if(!isset($info))
  {
     head404();
  }
  $info['series']=getSeries($info['id'],$typeid);//编号
  $info['usedate']=date('Y-m-d');
  $info['singleprice']=$suitinfo['ourprice'];
  if(!empty($suitinfo['dingjin']))$GLOBALS['condition']['_djsupport']=1;//是否支持定金
  if(!empty($suitinfo['jifentprice']))$GLOBALS['condition']['_has_jifentprice']=1;
  if(!empty($suitinfo['jifencomment']))$GLOBALS['condition']['_has_jifencomment']=1;
  if(!empty($suitinfo['jifenbook']))$GLOBALS['condition']['_has_jifenbook']=1;
  
  //如果用户是登陆状态,获取用户信息
  if($User->uid)
  {
	 $userinfo = $User->getInfoByMid($User->uid);//获取用户信息 
	 $info['linkman'] = $userinfo['truename'];
	 $info['linktel'] = $userinfo['mobile'];
	 $info['linkemail'] = $userinfo['linkemail'];
	 
  }

     if($info['jifentprice'])
     {
         $needjifen = $cfg_exchange_jifen * $info['jifentprice']; //所需积分
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

         $jifenpricemsg = " <span style='color:orange'>使用{$needjifen}积分抵现{$info['jifentprice']}元</span> ".$userstatus;
         $info['jifenpricemsg'] = $jifenpricemsg;
         $info['needjifen'] = $needjifen;
         $info['exopen'] = $exopen ;//优惠是否开启.
         $info['islogin'] = $islogin;
         $info['myjifen'] = $userinfo['jifen'];
     }

     $info['dingnum'] = isset($dingnum) ? Helper_Archive::pregReplace($dingnum,2) : 1;

     foreach ($info as $k => $v)
     {
         $pv->Fields[$k] = $v;
     }
     foreach ($suitinfo as $k => $v)
     {
         $pv->Fields[$k] = $v;
     }

     $pkname = get_par_value($info['kindlist'],$typeid);//上一级
 //获取上级开启了导航的目的地
  getTopNavDest($info['kindlist']);

  $pv->Fields['typeid'] = $typeid;
  $pv->Fields['modulename'] = $module_name;
  $pv->Fields['modulepinyin'] = $module_pinyin;

  $pv->SetTemplet(SLINETEMPLATE ."/".$cfg_df_style ."/" ."tongyong/" ."tongyong_booking.htm");

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
   $productaid = Helper_Archive::pregReplace($productaid,2);
   $suitid = Helper_Archive::pregReplace($suitid,2);
   $ordersn=get_order_sn($typeid);//订单号
   $memberid = $User->uid ? $User->uid : 0;
   $row=TongYong::getProductInfo($productaid,$typeid);
   $suitinfo = TongYong::getSuitInfo($suitid);
   $status = $paytype==1 ? 1 : 0;
   //'linktel'=>Helper_Archive::pregReplace($linktel,2);
   $arr = array(
           'ordersn'=>$ordersn,
		   'webid'=>$webid,
		   'typeid'=>$typeid,
		   'productautoid'=>$row['articleid'],
		   'productaid'=>$row['aid'],
		   'productname'=>$row['title'],
		   'price'=>$suitinfo['ourprice'],
		   'childprice'=>0,
		   'dingnum'=>Helper_Archive::pregReplace($dingnum,2),
		   'usedate'=>$usedate,
		   'childnum'=>0,
		   'linkman'=>Helper_Archive::pregReplace($linkman,5),
		   'linktel'=>Helper_Archive::pregReplace($linktel,2),
		   'linkemail'=>Helper_Archive::pregReplace($linkemail,5),
		   'linkqq'=>'',
		   'jifentprice'=>$suitinfo['jifentprice'],
		   'jifenbook'=>$suitinfo['jifenbook'],
		   'jifencomment'=>$suitinfo['jifencomment'],
		   'addtime'=>time(),
		   'memberid'=>$memberid,
		   'dingjin'=>Helper_Archive::pregReplace($dingjin,5),
           'paytype'=>$paytype,
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
               $url = $GLOBALS['cfg_basehost'].'/'.$module_pinyin.'/booking.php?dopost=payonline&id='.$orderid.'&paytype='.$choosepay;
           }
           else
           {
               
			   //是二次支付将跳转到订单咨询页面
			   //$url = "{$GLOBALS['cfg_basehost']}/".$module_pinyin."/show_{$arr['productaid']}.html";
			    $url = "{$GLOBALS['cfg_basehost']}/member/query.php?dopost=search&mobile=$linktel";
           }
	
	  
		 $mailto = $cfg_Email139;
		 $title   = $productname . "$module_name订单";
		 
		 $content = $linkman . "预定" . $usedate  . $row['title'] . "(价格:".$suitinfo['ourprice'].")".",数量:" . $dingnum . "张" ."联系电话:".$linktel."-----".$GLOBALS['cfg_webname'];
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
	  exit();   
   }


}
//在线支付
if($dopost == 'payonline')
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
        $url = "{$GLOBALS['cfg_basehost']}/{$module_pinyin}/show_{$order['productaid']}.html";
        header("location:$url");
        exit;
    }
    echo Helper_Archive::payOnline($order['ordersn'],$order['productname'],$price,$paytype);
}



?>

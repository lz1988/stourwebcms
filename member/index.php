<?php
/**
 * @version        $Id: index.php 1 8:24 2014年2月17日 netman $
 * @package        Smore.User
 */
require_once(dirname(__FILE__)."/config.php");


if(!$User->isLogin())
{
	header("Location: " . $cfg_cmsurl . "/member/login.php");
	exit;
}

$uid=empty($uid)? "" : RemoveXSS($uid);

$pv = new View(0);

//会员中心首页
if(!isset($dopost))
{
	
        Helper_Archive::loadModule('common');
	    $_model = new CommonModule('#@__member_order');
		$pv->Fields['unpinlun'] = $_model->getCount("memberid='$uid' and ispinlun=0 and status=2 and pid=0");//未评论订单数量
		$pv->Fields['unpay'] = $_model->getCount("memberid='$uid' and ispay=0 and pid=0");//未付款
		$pv->Fields['complete'] = $_model->getCount("memberid='$uid' and status=2 and pid=0");//已完成
	
	    $userinfo = $User->getInfoByMid($uid);
		
		foreach($userinfo as $key=>$value)
		{
		  $pv->Fields[$key] = $value;  
		}
		$pv->Fields['litpic'] = empty($pv->Fields['litpic']) ? $GLOBALS['cfg_templets_skin'].'/images/member_default.gif' : $pv->Fields['litpic'];
		$pv->SetTemplet(MEMBERTEMPLET . "index.htm");

		$pv->Display();
		
		exit();
	
} 
if($dopost == 'uploadfacepage')
{
	$pv->SetTemplet(MEMBERTEMPLET . "uploadface.htm");

	$pv->Display();
	
	exit();
	
}

/*-----------------------------
//用户资料设置

------------------------------*/
if($dopost == 'userinfo')
{
  $userinfo = $User->getInfoByMid($uid);
 
  $pagename = $dopost;//当前页面,用于左侧导航选中
   
  $pv->Fields['pagename'] = $pagename;
  $userinfo['face'] = getUploadFileUrl($userinfo['litpic']);

  $GLOBALS['condition']['_regphone']=$userinfo['regtype']==0?1:0;
  $GLOBALS['condition']['_regemail']=$userinfo['regtype']==1?1:0;
  
  foreach($userinfo as $key=>$value)
  {
	$pv->Fields[$key] = $value;  
  }

   
  $pv->SetTemplet(MEMBERTEMPLET . "userinfo.htm");
  $pv->Display();
  exit;
	
}
/*-----------------------------
//保存用户资料设置

------------------------------*/
if($dopost == 'saveuserinfo')
{
  helper_archive::loadmodule('common');
  $_model = new commonmodule('#@__member');
  $arr = array(
        'nickname'=>$nickname,
		'sex'=>$sex,
		'truename'=>$truename,
		'cardid'=>$cardid,
		'address'=>$address,
		'postcode'=>$postcode,
		'litpic'=>$litpic
  );
  $userinfo=$User->getInfoByMid($uid);
  if($userinfo['regtype']!=1)
  {
      $arr['email']=$email;
  }
  if($userinfo['regtype']!=0)
  {
      $arr['mobile']=$mobile;
  }

  $where = array('mid'=>$uid);
  $url = $globals['cfg_basehost'].'/member/index.php?dopost=userinfo';
  if($_model->update($arr,$where))
  {
	 helper_archive::showmsg('资料更新成功!',$url,1,3);
	 exit();   
  }
  
}
/*-----------------------------
//用户密码修改

-----------------*/
if($dopost == 'changepass')
{
  $userinfo = $User->getInfoByMid($uid);
 
  $pagename = $dopost;//当前页面,用于左侧导航选中
  foreach($userinfo as $key=>$value)
  {
	$pv->Fields[$key] = $value;  
  }
   
  $pv->Fields['pagename'] = $pagename;
  $pv->SetTemplet(MEMBERTEMPLET . "changepass.htm");
  $pv->Display();
  exit;	
}
/*-----------------------------
//用户新密码保存

-----------------*/
if($dopost == 'savenewpass')
{
  
 
  Helper_Archive::loadModule('common');
  $_model = new CommonModule('#@__member');
  $oldpwd = md5($oldpwd);
  $newpwd = md5($newpwd1);
  $usermid =$_model->getField('mid',"mid='$uid' and pwd='$oldpwd'");
  if($usermid == $uid)
  {
	  $arr = array(
        'pwd'=>$newpwd
		
	  );
	  $where = array('mid'=>$uid);
	  $url = $GLOBALS['cfg_basehost'].'/member/index.php';
	  if($_model->update($arr,$where))
	  {
		 ShowMsg('密码修改成功!',$url);
		 exit();   
	  }
	  
  }
  else
  {
	  ShowMsg('旧密码输入错误,请检查','-1');
	  exit();
  }
  
  
}
/*-----------------------------
//我的咨询管理
------------------------------*/
if($dopost == 'myquestion')
{
   $pagename = $dopost;//当前页面,用于左侧导航选中
   
   $pv->Fields['pagename'] = $pagename;
	
   $pv->SetTemplet(MEMBERTEMPLET."myquestion.htm");

   $pv->Display();
   
   exit();
	
}

/*
 *
 * 我的积分记录
 * */
if($dopost == 'jifenlog')
{
    $pagename = $dopost;//当前页面,用于左侧导航选中

    $pv->Fields['pagename'] = $pagename;

    $pv->SetTemplet(MEMBERTEMPLET."jifen.htm");

    $pv->Display();

    exit();
}



/*-----------------------------
//订单列表页面

------------------------------*/
if($dopost == 'orderlist')
{
  
   $pagename = $dopost;
   
   $ordername = getOrderName($typeid);
   
   $pv->Fields['ordername'] = $ordername;
   
   $pv->Fields['typeid'] = $typeid; //当前页面,用于左侧导航选中
   
   //$pv->Fields['pagename'] = $pagename;
	
   $pv->SetTemplet(MEMBERTEMPLET."order_list.htm");

   $pv->Display();
   
   exit();
}

/*-----------------------------
//查看订单详细

------------------------------*/

if($dopost == 'vieworder')
{
	$pagename = $dopost;
	Helper_Archive::loadModule('common');
	$_model = new CommonModule('#@__member_order');
	$orderinfo = $_model->getOne("id='$orderid'");

	$orderinfo['orderstatus'] = strip_tags(getOrderStatus($orderinfo['status'],$orderinfo['paytype']));//订单状态
    $orderinfo['dingjin'] = $orderinfo['dingjin'] * $orderinfo['dingnum'];
    if($orderinfo['typeid']==2)
    {
        $childOrder = M::getChildOrderInfo($orderinfo['id']);
        $totalprice = 0;
        $roomdinginfo = array();
        foreach($childOrder as $order)
        {
            $p = intval($order['dingnum'])*$order['price'];
            $totalprice+= $p;
            $roomdinginfo[]=array('usedate'=>$order['usedate'],'dingnum'=>$order['dingnum'],'totalprice'=>$p,'singleprice'=>$order['price']);

        }
        $orderinfo['totalprice'] = $totalprice;

    }
    else
    {
        $orderinfo['totalprice'] = $orderinfo['dingnum'] * $orderinfo['price'] + $orderinfo['childnum'] *   $orderinfo['childprice']+$orderinfo['oldnum']*$orderinfo['oldprice'];//总价格
    }

    $orderinfo['insuranceprice']=0;
    if($orderinfo['typeid']==1)
    {
        $_insuranceModel=new CommonModule('#@__insurance_booking');
        $_insuranceInfo=$_insuranceModel->getOne('bookordersn='.$orderinfo['ordersn']);
        if($_insuranceInfo)
        {
            $GLOBALS['condition']['_has_insurance']=1;
            $orderinfo['insuranceprice']=$_insuranceInfo['payprice'];
            $orderinfo['totalprice']+=$_insuranceInfo['payprice'];
        }
        $orderinfo['totalprice']+=$orderinfo['roombalance']*$orderinfo['roombalancenum'];
    }








	$userinfo = $User->getInfoByMid($uid);// 会员相关信息

	//是否存在赠送奖励(先取消)
    //$GLOBALS['condition']['_has_jiefenbook'] = $orderinfo['jifenbook'];
	//$GLOBALS['condition']['_has_jiefentprice'] = $orderinfo['jifentprice'];
	//$GLOBALS['condition']['_has_jiefencomment'] = $orderinfo['jifencomment'];
    $GLOBALS['condition']['_has_dingjin'] = $dingjin;
	foreach($orderinfo as $key=>$value)
		{
		  $pv->Fields[$key] = $value;  
		}
	foreach($userinfo as $key=>$value)
		{
		  $pv->Fields[$key] = $value;  
		}
	$pv->SetTemplet(MEMBERTEMPLET . 'order_detail.htm');

	$pv->Display();
	
	exit();
}

/*-----------------------------
//在线支付

------------------------------*/

if($dopost == 'payonline')
{
    $order = Helper_Archive::getOrderInfo($orderid);

    if($order['typeid']!=2)
    {
        if(empty($order['dingjin'])) //非订金支付
        {
            $price = intval($order['dingnum']) * $order['price'] +intval($order['childnum']) * $order['childprice'] + intval($order['oldnum']) * $order['oldprice'];
            if(!empty($order['usejifen']) && !empty($order['jifentprice']))
            {
                $price = $price-intval($order['jifentprice']);//减去积分抵现的价格.
            }
        }
        else //订金支付
        {
            $price = (intval($order['dingnum'])+intval($order['childnum'])+intval($order['oldnum'])) * $order['dingjin'];
            if(!empty($order['usejifen']) && !empty($order['jifentprice']))
            {
                $price = $price-intval($order['jifentprice']);//减去积分抵现的价格.
            }
        }
    }
    else //当为酒店时
    {

        $orderlist = Helper_Archive::getChildOrder($orderid);
        $price = 0;
        $totalnum = 0;
        foreach($orderlist as $row)
        {
            $price += intval($row['dingnum']) * intval($row['price']);
            $totalnum+=$row['dingnum'];

        }
        if(!empty($order['dingjin']))
        {
           $dingjin = $totalnum * $order['dingjin'];
        }
    }
    if($order['typeid']==1)
    {
        $insModel = new CommonModule('#@__insurance_booking');
        $insInfo=$insModel->getOne("bookordersn='{$order['ordersn']}'");
        if($insInfo['payprice'])
            $price+=$insInfo['payprice'];

        $price+=$order['roombalancenum']*$order['roombalance'];

    }

    $price = !empty($dingjin) ? $dingjin : $price;

    if(empty($price))
    {
        $url = "{$GLOBALS['cfg_basehost']}/member/";
        header("location:$url");
        exit;
    }
	echo Helper_Archive::payOnline($order['ordersn'],$order['productname'],$price,$choosepay);
}

if($dopost=='checkaccount')
{
    if($type=='phone')
    {
        $row=$dsql->GetOne("select count(*) as num from #@__member where mobile='$mobile' and mid!=$uid");
        if($row['num']>0)
            echo  json_encode("该手机号已使用");
        else
            echo  json_encode(true);
    }
    else if($type=='email')
    {
        $row=$dsql->GetOne("select count(*) as num from #@__member where email='$email' and mid!=$uid");
        if($row['num']>0)
            echo  json_encode("该邮箱已被使用");
        else
            echo  json_encode(true);
    }

}

Class M{
    public static function getChildOrderInfo($orderid)
    {
        global $dsql;
        $sql = "select * from sline_member_order where pid='$orderid'";
        $arr = $dsql->getAll($sql);
        return $arr;
    }
    public static function getRoomArr($orderarr)
    {
        $out = array();
        foreach($orderarr as $row)
        {
            $total = intval($row['dingnum']) * $row['price'];
            $out[]=array('usedate'=>$row['usedate'],'dingnum'=>$row['dingnum'],'totalprice'=>$total,'singleprice'=>$row['price']);

        }
        return $out;

    }

}









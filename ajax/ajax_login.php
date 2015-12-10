<?php
require_once(dirname(__FILE__)."/../include/common.inc.php");
require_once SLINEINC."/view.class.php";

//顶部用登陆状态
if($dopost=='LoginStatus')
{
    $prefix = Helper_Archive::getSysWebprefix();
    $domain = Helper_Archive::getBaseUrl();//顶级域名
    $url = 'http://'.$prefix.$domain;
   if($User->IsLogin())
		{
			
			 $userinfo=$User->getInfoByMid($User->uid);
			 $uname = cn_substr($userinfo['nickname'],10);//昵称
			 $jifen=!empty($userinfo['jifen']) ? $userinfo['jifen'] : 0;
			 //$face = !empty($userinfo['face']) ? $GLOBALS['cfg_templets_skin'].'/images/pic/defaultface.gif' : getUploadFileUrl($userinfo['face']);
			/* $face = $GLOBALS['cfg_templets_skin'].'/images/pic/defaultface.jpg';
			 $out='<div class="header_info_show">
                     <ul class="my_pro">
                       <li class="my_pro_item">
                        <span>我的积分:</span><a href="#" class="header_my_coin">'.$jifen.'</a><span>等级：<a href="#" class="header_my_level">LV.1</a></span>
</li>
                <li class="my_pro_msg">
                    
				     <a class="msg_notice" title="消息" href="javascript:void(0);">消息</a>
					 <ul class="pop_msg_notice" >
					  <li><a href="#">提到我的</a></li>
					  <li><a href="#">我的消息</a></li>
					 </ul>
                </li>
               <li class="my_pro_name clearfix">
			     <p>
				  <a class="mp_name" href="#">
				  <img src="'.$face.'" width="18" height="18"  class="my_pic18"/>'.$uname.'</a>
				 </p>
				 <ul class="pop_setting_menu">
				  <li><a href="javascript:;">我的主页</a></li>
				  <li><a href="/member/buy.php">购物车</a></li>
				  <li><a href="/member/order.php">我的订单</a> </li>
				  <li><a href="/member/index.php?dopost=userinfo">账户设置</a> </li>
				  <li><a href="/member/login.php?dopost=logout">退出</a> </li>
				 </ul>
				
              </li>
             </ul>
             </div>';*/
			 
			// $out.='<span>您好,'.$uname.'<a href="' . $GLOBALS['cfg_cmsurl'] . '/member/">我的订单</a>';
			// $out.='<a title="退出帐号" href="'.$GLOBALS['cfg_cmsurl'].'/member/login.php?dopost=logout" rel="nofollow">退出</a>';
			// $out.='</span>';



             $out.='您好,'.$uname;
             $out.=' <span class="my-booking bor_bag">';
             $out.='  <a class="mb-a" href="'. $url.'/member/">我的订单</a>
                <div class="mb-hide">
                    <a class="bk_ico1" href="'. $url.'/member/?chooseitem=unpay"><s></s>待付款</a>
                    <a class="bk_ico2" href="' . $url . '/member/"><s></s>订单中心</a>
                    <a class="bk_ico3" href="' . $url . '/member/?dopost=userinfo"><s></s>帐号资料</a>
                </div>';
             $out.='</span>';
            $out.='<a href="'.$url.'/member/query.php">订单查询</a>';
            $out.='<a href="'.$url.'/member/login.php?dopost=logout">退出</a>';
			
		}
		else //未登陆状态
		{
			
          $out = '<a href="' . $url . '/member/login.php">登录</a>' .
			       '<a href="' .$url . '/member/reg.php">注册</a>';
          $out.='<a href="'.$url.'/member/query.php">订单查询</a>';
		
		}
	
	echo $out;
	exit();

}

//检测是否登陆
if($dopost=='checkLogin')
{
	$flag=0;
	
	if($User->isLogin())
	{
		
	   $flag=1;	
	}
	echo $flag;
	exit;
	
}
if($dopost=='getUser')
{
	if($User->isLogin())
	{
	    $cuser['name']=$User->username;
		$cuser['id']=$User->uid;
		$cuser['status']=1;
	}
	else
	  $cuser['status']=0;
	echo json_encode($cuser);
	exit;  
}

//ajaxLogin
if($dopost=='ajaxLogin')
{
	$User=new Member(7*3600);
	$flag = $User->login($uname, $pwd);
	$arr=array();
	$arr['status']=$flag;
	echo  json_encode($arr);
	exit();
	
}
//ajaxReg
if($dopost=='ajaxReg')
{

	$pwd=md5($mobile);
	$jointime=time();
	$joinip=GetIP();
	$data=array();
	$jifen=empty($cfg_reg_jifen) ? 0 : $cfg_reg_jifen;//网上注册赠送积分 
	if(!_checkMobile($mobile)) //检测此手机号是否注册
	{
        $nickname=substr($mobile,0,5).'***';
		$sql="insert into #@__member(nickname,pwd,email,mobile,jointime,joinip,jifen) values('$nickname','$pwd','','$mobile','$jointime','$joinip','$jifen')";
		
	
		
		if($dsql->ExecuteNoneQuery($sql))
		{
			$content="尊敬的用户{$mobile}你好,你已经成功注册成为{$GLOBALS['cfg_webname']}会员,你的登陆名是:{$mobile},密码是:{$mobile},为了你的帐户安全,请尽快修改密码!";

            $msgInfo = Helper_Archive::getDefineMsgInfo(0);

            if(isset($msgInfo['isopen']))
            {
                $nickname = $mobile;
                $password = $mobile;
                $content = $msgInfo['msg'];
                $content = str_replace('{#LOGINNAME#}',$mobile,$content);
                $content = str_replace('{#PASSWORD#}',$mobile,$content);
                $content = str_replace('{#WEBNAME#}',$GLOBALS['cfg_webname'],$content);
                $content = str_replace('{#PHONE#}',$GLOBALS['cfg_phone'],$content);

                Helper_Archive::sendMsg($mobile,$mobile,$content);//注册短信
            }
			//sendMsg('',$content,$mobile,'','shortmsg');
			
			$User=new Member(7*3600);
			$status = $User->login($mobile, $mobile);
			
			$data['status']=1;
			
		}
	}
	else //已经注册
	{
	  
	  $data['status']='hasReg';	
	}
	echo json_encode($data);
	exit();
}

//弹出登陆框

if($dopost == 'getloginbox')
{
	$pv = new View(0);

    $pv->SetTemplet(SLINETEMPLATE ."/".$cfg_df_style ."/" ."member/" ."pop_login.htm");

    $pv->Display();
	
}
//功能函数
//检测手机号码
function _checkMobile($mobile)
{
  global $dsql;
  $flag=0;
  $sql="select count(*) as num from #@__member where mobile='$mobile'";
 
  $row=$dsql->GetOne($sql);
 
  if($row['num']==1)
  {
	$flag=1; 
  }
 return $flag;
}

 ?>
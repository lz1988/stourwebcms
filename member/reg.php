<?php

require_once(dirname(__FILE__)."/config.php");
$ucfile=SLINEDATA.'/ucenter.php';
if(file_exists($ucfile))
require_once($ucfile);
$dopost=empty($dopost) ? 'reg' : $dopost;
$pv = new View(0);
//用户注册页面
if($dopost=='reg')
{
    @session_start();
    if(!isset($_SESSION['last_access'])||(time()-$_SESSION['last_access'])>120)
    {
        $_SESSION['last_access'] = time();
        $token = md5(time());
        $_SESSION['csrf_token'] = $token;
    }

	$fromurl = $_SERVER['HTTP_REFERER'];//来源地址
    $msgInfo = Helper_Archive::getDefineMsgInfo2('reg_msgcode');
    if($msgInfo['isopen']==1)
    {
        $GLOBALS['condition']['_msgcode']=1; //短信验证码
        $GLOBALS['condition']['_txtcode']=0; //文字验证码
    }
    else
    {
        $GLOBALS['condition']['_msgcode']=0; //短信验证码
        $GLOBALS['condition']['_txtcode']=1; //文字验证码
    }

    $emailInfo=Helper_Archive::getEmailMsgConfig('reg_msgcode');
    if(!empty($emailInfo)&&$emailInfo['isopen']==1)
    {
        $GLOBALS['condition']['_emailcode']=1;
    }
    else
    {
        $GLOBALS['condition']['_emailtxtcode']=1;
    }


    $templet = Helper_Archive::getUseTemplet('member_reg');//获取使用模板
    $templet = !empty($templet) ? $templet : MEMBERTEMPLET.'reg.htm';
    $pv->Fields['stoken'] = $token;
	$pv->SetTemplet(MEMBERTEMPLET.'reg.htm');
    $pv->Display();
	exit();
}


//用户注册
if($dopost=='doreg')
{
    @session_start();
    $pwd=md5($password);
    $jointime=time();
    $joinip=GetIP();
    $jifen=empty($cfg_reg_jifen) ? 0 : $cfg_reg_jifen;//网上注册赠送积分
    $nickname=substr($mobile,0,5).'***';

    $validateResult=validatePhone();
    $_SESSION['mobilecode_'.$mobile]='';
    if($validateResult!==true)
    {
        Helper_Archive::showMsg('注册失败!'.$validateResult,'reg.php?dopost=reg',0);
        return;
    }
    $sql="insert into #@__member(mobile,pwd,jointime,joinip,jifen,nickname) values('$mobile','$pwd','$jointime','$joinip','$jifen','$nickname')";

    if(defined('UC_API') && @include_once SLINEROOT.'/uc_client/client.php')
    {
        $email = time()."@163.com";

        $uid = uc_user_register($mobile, $password, $email);
        if($uid <= 0)
        {

        }
        else
        {
            $ucsynlogin = uc_user_synlogin($uid);
        }
    }
    if($dsql->ExecuteNoneQuery($sql))
    {

        $User=new Member(7*3600);
        $User->login($mobile, $password);
        //增加积分记录
        if(!empty($jifen))
        {
            Helper_Archive::addJifenLog($User->uid,"注册赠送积分{$jifen}",$jifen,2);
        }
        $msg='';
        $fromurl = empty($fromurl) ? $GLOBAL['cfg_basehost'].'/member/' : $fromurl;
        $msgInfo = Helper_Archive::getDefineMsgInfo(0);
        if($msgInfo['isopen']==1) //如果开启
        {
            // $nickname = !empty($nickname) ? $nickname : $mobile;
            $content = $msgInfo['msg'];
            $content = str_replace('{#LOGINNAME#}',$mobile,$content);
            $content = str_replace('{#PASSWORD#}',$password,$content);
            $content = str_replace('{#WEBNAME#}',$GLOBALS['cfg_webname'],$content);
            $content = str_replace('{#PHONE#}',$GLOBALS['cfg_phone'],$content);
            Helper_Archive::sendMsg($mobile,$mobile,$content);//注册短信
        }
        if(strpos($fromurl, 'findpass') !== false || strpos($fromurl, 'reg')!== false || strpos($fromurl, 'login')!== false)
        {

            if(strpos($fromurl, 'login')!== false&&$_SESSION['login_referer'])
            {
                $fromurl=$_SESSION['login_referer'];
                $_SESSION['login_referer']='';
            }
            else
                $fromurl = $GLOBALS['cfg_basehost'];
        }
        Helper_Archive::showMsg('注册成功!'.$ucsynlogin,$fromurl,1);
    }
    else
    {
        Helper_Archive::showMsg('注册失败!请重试','reg.php?dopost=reg',0);
        return;
    }

}
if($dopost=='doemailreg')
{
    @session_start();
    $pwd=md5($password);
    $jointime=time();
    $joinip=GetIP();
    $jifen=empty($cfg_reg_jifen) ? 0 : $cfg_reg_jifen;//网上注册赠送积分
    $nickname=substr($email,0,strpos($email,'@')).'...';

    $validateResult=validateEmail();
    $_SESSION['emailcode_'.md5($email)]='';
    if($validateResult!==true)
    {
        Helper_Archive::showMsg('注册失败!'.$validateResult,'reg.php?dopost=reg',0);
        return;
    }
    $sql="insert into #@__member(email,pwd,jointime,joinip,jifen,nickname,regtype) values('$email','$pwd','$jointime','$joinip','$jifen','$nickname',1)";
    if(defined('UC_API') && @include_once SLINEROOT.'/uc_client/client.php')
    {

        $uid = uc_user_register($email, $password, $email);
        if($uid <= 0)
        {

        }
        else
        {
            $ucsynlogin = uc_user_synlogin($uid);
        }
    }

    if($dsql->ExecuteNoneQuery($sql))
    {

        $User=new Member(7*3600);
        $User->login($email, $password);
        //增加积分记录
        if(!empty($jifen))
        {
            Helper_Archive::addJifenLog($User->uid,"注册赠送积分{$jifen}",$jifen,2);
        }
        $msg='';
        $fromurl = empty($fromurl) ? $GLOBAL['cfg_basehost'].'/member/' : $fromurl;

        if(strpos($fromurl, 'findpass') !== false || strpos($fromurl, 'reg')!== false || strpos($fromurl, 'login')!== false)
        {
            if(strpos($fromurl, 'login')!== false&&$_SESSION['login_referer'])
            {
                $fromurl=$_SESSION['login_referer'];
                $_SESSION['login_referer']='';
            }
            else
                $fromurl = $GLOBALS['cfg_basehost'];
        }

        $emailInfo=Helper_Archive::getEmailMsgConfig('reg');
        if(!empty($emailInfo) && $emailInfo['isopen']==1)
        {
            $title='邮箱注册成功';
            $content =$emailInfo['msg'];
            $content = str_replace('{#PASSWORD#}',$password,$content);
            $content = str_replace('{#EMAIL#}',$email,$content);
            $content = str_replace('{#WEBNAME#}',$GLOBALS['cfg_webname'],$content);
            ordermaill($email,$title,$content);
        }

        Helper_Archive::showMsg('注册成功!'.$ucsynlogin,$fromurl,1);
    }
    else
    {
        Helper_Archive::showMsg('注册失败!请重试','reg.php?dopost=reg',0);
        return;
    }
}



//用户名检测
if($dopost=='checkusername')
{
  $sql="select count(*) as num from #@__member where uname='$username'";
  $row=$dsql->GetOne($sql);
  if($row['num']==0)
  {
	echo 'succeed';    
  }
  else
  {
	 echo '用户名重复,换一个用户名试试';  
  }
  	
}
//手机检测
else if($dopost=='checkmobile')
{
  $sql="select count(*) as num from #@__member where mobile='$mobile'";

  
  $flag = 'false';
  
  $row=$dsql->GetOne($sql);
 
  if($row['num']==0)
  {
	$flag = 'true'; 
  }
  echo $flag;
  	
}
//email检测
else if($dopost=='checkemail')
{
	$sql="select count(*) as num from #@__member where email='$email'";
	
  
  $row=$dsql->GetOne($sql);
  $flag = 'false';
  if($row['num']==0)
  {
	$flag = 'true';    
  }
  echo $flag;
}
//验证码检测
else if($dopost=='checkcode')
{
   $scode=strtolower(GetCkVdValue());
   $flag = 'false';
   if($scode==strtolower($checkcode))
   {
	  $flag = 'true';  
   }
  echo $flag;
	
}

//发送短信验证码

else if($dopost=='sendmsgcode')
{
    @session_start();
    $curtime=time();
    $ip = GetIP();


    if(strtolower(GetCkVdValue())!=strtolower($firstcode)||empty($firstcode))
    {
        echo json_encode(array('status'=>false,'msg'=>'验证码错误'));
        exit;
    }
    $_SESSION['total_value']='';

    if(empty($mobile))
    {
        echo json_encode(array('status'=>false,'msg'=>'手机号不能为空'));
        exit;
    }
    else
    {
           $sentNum=$_SESSION['sendnum_'.$mobile]; //已发验证码次数
           $lastSentTime=$_SESSION['senttime_'.$mobile];//上次发送时间
           $sentNum=empty($sentNum)?0:$sentNum;
           $lastSentTime=empty($lastSentTime)?0:$lastSentTime;

           if($sentNum<3&&$sentNum>0&&$lastSentTime>($curtime-60))
           {
               echo json_encode(array('status'=>false,'msg'=>'验证码发送过于频繁，请稍后再试'));
               exit;
           }

           if($sentNum>=3&&$lastSentTime>($curtime-60*15))
           {
               echo json_encode(array('status'=>false,'msg'=>'验证码发送过于频繁，15分钟后再试'));
               exit;
           }

            $code = getRandCode(5);//验证码
            $msgInfo = Helper_Archive::getDefineMsgInfo2('reg_msgcode');

            $content = $msgInfo['msg'];
            $content = str_replace('{#CODE#}',$code,$content);
            $content = str_replace('{#WEBNAME#}',$GLOBALS['cfg_webname'],$content);
            $content = str_replace('{#PHONE#}',$GLOBALS['cfg_phone'],$content);
            $flag = Helper_Archive::sendMsg($mobile,'',$content);

            if($flag->Success)//发送成功
            {
                $_SESSION['senttime_'.$mobile]=$curtime;
                $sentNum=$sentNum>=3?0:$sentNum+1;
                $_SESSION['sendnum_'.$mobile]=$sentNum;
                $_SESSION['mobilecode_'.$mobile]=$code;
                echo json_encode(array('status'=>true,'msg'=>'验证码发送成功'));
            }
            else
            {
                echo json_encode(array('status'=>false,'msg'=>'验证码发送失败，请重试'.$flag->Message));
            }

    }

}
//检测短信验证码是否正确
else if($dopost == 'ckcode')
{
        @session_start();
        echo $_SESSION['mobilecode_'.$mobile] == $msgcode ? 'true' : 'false';
}
else if($dopost=='sendemailcode')
{
    @session_start();
    $code = getRandCode(5);//验证码
    if(empty($email))
    {
        echo json_encode(array('status'=>true,'msg'=>'邮箱不能为空'));
        exit;
    }
    $title=$GLOBALS['cfg_webname'].'邮箱注册验证码';
    $emailInfo=Helper_Archive::getEmailMsgConfig('reg_msgcode');
    $content =$emailInfo['msg'];
    $content = str_replace('{#CODE#}',$code,$content);
    $content = str_replace('{#EMAIL#}',$email,$content);
    $content = str_replace('{#WEBNAME#}',$GLOBALS['cfg_webname'],$content);

    $status=ordermaill($email,$title,$content);
    if($status)
    {
        $_SESSION['emailcode_'.md5($email)]=$code;
        echo json_encode(array('status'=>true,'msg'=>'发送邮箱验证码成功'));
    }
    else
    {
        echo json_encode(array('status'=>false,'msg'=>'发送邮箱验证码失败'));
    }
}
else if($dopost=='checkemailcode')
{
    @session_start();
    if($_SESSION['emailcode_'.md5($email)]==$emailcode)
        echo 'true';
    else
        echo 'false';
}
//生成随机数
function getRandCode($num)
{
    $out='';
    for ($i=1; $i<=$num; $i++)
    {
        $out.=mt_rand(0,9);
    }
    @session_start();
    $_SESSION['msgcode'] = $out;

    return $out;

}
function validatePhone()
{

    global $dsql,$mobile,$password,$repassword,$checkcode,$msgcode;
    $msgInfo = Helper_Archive::getDefineMsgInfo2('reg_msgcode');
    if($msgInfo['isopen']==1)
    {
        if($_SESSION['mobilecode_'.$mobile]!= $msgcode)
        {
            return '验证码1错误';
        }
    }
    else
    {
        if(strtolower(GetCkVdValue())!=strtolower($checkcode)||empty($checkcode))
        {
            return '验证码错误';
        }
    }
    $phonePattern='/^1[3-8]+\d{9}$/';
    if(!preg_match($phonePattern,$mobile))
    {
        return '手机号码格式错误';
    }

    $row=$dsql->GetOne("select count(*) as num from #@__member where mobile='$mobile'");
    if($row['num']>0)
    {
       return '该手机号已经被注册';
    }

    if(strlen($password)<6)
    {
        return '密码长度不得小于6位';
    }
    if($password!=$repassword)
    {
        return '密码确认错误';
    }
    return true;
}
function validateEmail()
{
    global $dsql,$email,$emailcode,$checkcode,$password,$repassword;

    $isregcode=Helper_Archive::getEmailMsgConfig('reg_msgcode');


	$isregcode=$isregcode['isopen'];

    if( $isregcode==1&&(empty($emailcode)||$_SESSION['emailcode_'.md5($email)]!=$emailcode))
    {
        return '验证码错误';
		
    }
    else if( $isregcode!=1&&(empty($checkcode)||strtolower(GetCkVdValue())!=strtolower($checkcode)))
    {
        return '验证码错误';
		
    }

    $row=$dsql->GetOne("select count(*) as num from #@__member where email='$email'");
    if($row['num']>0)
    {
       return '该邮箱已经被注册';
    }
    $pattern = "/([a-z0-9]*[-_\.]?[a-z0-9]+)*@([a-z0-9]*[-_]?[a-z0-9]+)+[\.][a-z]{2,3}([\.][a-z]{2})?/i";
    if(!preg_match($pattern,$email))
    {
        return '邮箱格式错误';
    }
    if(strlen($password)<6)
    {
        return '密码长度不得小于6位';
    }
    if($password!=$repassword)
    {
        return '密码确认错误';
    }
    return true;
}



 ?>
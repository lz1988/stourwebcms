<?php
//@session_start();
require_once(dirname(__FILE__)."/config.php");
/**
 * @desc       找回密码
 * @author     netman
 */
 $step=!empty($step) ? $step : 1;
 $pv = new View(0);

 //找回密码第一步
 if($step==1)
 {
	$pv->SetTemplet(MEMBERTEMPLET . "findpass1.htm");
    $pv->Display();
	exit();
 }
  //找回密码第二步
 if($step==2)
 {
	$scode=GetCkVdValue();
	
	//验证码检测
	if(strtolower($scode)!=strtolower($checkcode))
	{
	   ShowMsg('验证码错误','-1',1);	
	}
	//用户名检测
	$arr=checkUname($loginname);

     $isPhone=strpos($loginname,'@')===false?true:false;
     $msgInfo = Helper_Archive::getDefineMsgInfo2('reg_findpwd');

     if(!empty($arr))
     {
         //短信找回密码是否开启
         if($msgInfo['isopen']==1&&$isPhone)
         {
                 $findtype = '手机找回';
                 //$code = getRandCode(5);//验证码
                 //$content = "尊敬的会员,请您在{$GLOBALS['cfg_webname']}中输入以下验证码:{$code},完成密码找回验证.";
                 //Helper_Archive::sendMsg($loginname,'',$content);
                 $templet = 'findpass2_msg.htm';
                 $pv->Fields['loginname'] = substr($arr['num'],0,3).'****'.substr($arr['num'],-4);

         }

       /*  else if(preg_match('/^[_.0-9a-z-]+@([0-9a-z][0-9a-z-]+.)+[a-z]{2,4}$/',$loginname))
         {
             $findtype = '邮箱找回';
             //sendMail($arr['mid']);
             $templet = 'findpass2_email.htm';
             $pv->Fields['loginname'] = substr($arr['email'],0,3).'****'.substr($arr['email'],-4);


         }*/
         else if(!empty($arr['email']))
         {
             $templet = 'findpass2_email.htm';

             sendMail($arr['mid']);

             $pv->Fields['loginname'] = substr($arr['email'],0,3).'****'.substr($arr['email'],-4);

         }
         else
         {
             ShowMsg('短信帐户余额不足,请联系管理员!','-1',1);
         }


         $pv->Fields['email']=$arr['email'];
         $pv->Fields['mobile']=$arr['num'];
         $pv->Fields['mid']=$arr['mid'];
         $pv->Fields['findtype'] = $findtype;

         $pv->SetTemplet(MEMBERTEMPLET . $templet);
         $pv->Display();


     }


	else
	{
	   ShowMsg('用户不存在','-1',1);	
	}
	 
 }
 
 //取回密码第三步(email找回)
 if($step==3)
 {
       ;
        if($findtype == 'email')
        {
            if(empty($actstr)) exit();
            if($_SESSION['getpass_status']==1) exit('此地址已过期,如果忘记密码,新重新找回密码');//如果已经使用过当前找回密码,则直接返回.
            $arr=explode('|',base64_decode($actstr));
            $loginname=$arr[0];
            $ar=checkUname($loginname);
        }
        else if($findtype == 'msg')
        {
            //if(empty($mobile)) exit();
            $sql = "select * from #@__member where mobile='$mobile'";
            $ar = $dsql->GetOne($sql);

        }

         if(!empty($ar['mid']))
         {
             $pv->Fields['mid']=$ar['mid'];
             $pv->SetTemplet(MEMBERTEMPLET . "findpass3.htm");
             $pv->Display();
         }
         else
         {
            //print_r(base64_decode($actstr));
         }
 }

 //取回密码第4步
 if($step==4)
 {
	 if(empty($mid))exit();
	 $pwd=md5($pwd1);
	 $sql="update #@__member set pwd='$pwd' where mid='$mid'";
	
	 if($dsql->ExecuteNoneQuery($sql))
	 {

	    $pv->SetTemplet(MEMBERTEMPLET . "findpass_success.htm");
		$_SESSION['getpass_status']=1;//置当前地址为已使用状态.


        $pv->Display();
		exit();
	 }
	 
	 
 }




//发送短信
 if($step=='sendcheckcode')
 {

     @session_start();
     $ip = GetIP();
     $ip_list = $_SESSION['findpwdipnum'];
     if(isset($ip_list[$ip]) && intval($ip_list[$ip])<=3)
     {
         $num = intval($ip_list[$ip])+1;
         $_SESSION['findpwdipnum'][$ip] = $num;
     }
     else if(!isset($ip_list[$ip]))
     {
         $_SESSION['findpwdipnum'][$ip] = 1;
     }
     else
     {
         exit();
     }
    $userinfo = Helper_Archive::getMemberInfo($_GET['uid']);
    $status = 'false';
    if(!empty($userinfo))
    {
        $code = getRandCode(5);//验证码
        $msgInfo = Helper_Archive::getDefineMsgInfo2('reg_findpwd');
        //$content = "尊敬的会员,请您在{$GLOBALS['cfg_webname']}中输入以下验证码:{$code},完成密码找回验证.";
        $content = $msgInfo['msg'];
        $content = str_replace('{#CODE#}',$code,$content);
        $content = str_replace('{#WEBNAME#}',$GLOBALS['cfg_webname'],$content);
        $content = str_replace('{#PHONE#}',$GLOBALS['cfg_phone'],$content);
        $flag = Helper_Archive::sendMsg($userinfo['mobile'],'',$content);
        if($flag->Success)//发送成功
        {
            $status = 'ok';
        }
        $status = 'ok';
    }

    echo $status;
 }


//检测短信验证码是否正确
if($step == 'ckcode')
{
    @session_start();

    echo $_SESSION['msgcode'] == $checkcode ? 'true' : 'false';

}
 
 function checkUname($loginname)
 {
	 global $dsql;
	 $sql="select mid,email,mobile as num from #@__member where mobile='$loginname' or email='$loginname'";
	 $arr=$dsql->GetOne($sql);
	 return $arr;
	 
	 
 }
 //发送邮件
 function sendMail($mid)
 {
	global $dsql;
	$arr=getUserInfo($mid);
	$code=md5($arr['nickname'].'+'.$arr['pwd'].$arr['mobile']);
	$actstr = base64_encode($arr['email']."|".$code);
	$title="{$GLOBALS['cfg_webname']}用户找回密码--{$GLOBALS['cfg_webname']}";
	$header="<html><body>";
	$content="<p>尊敬的会员：</p> 
<p>您好！欢迎使用邮箱验证找回密码!</p>
<p>请点击下面的链接找回你的登陆密码,如果验证邮箱链接无法正常打开，请直接将以下地址复制到地址栏:</p>
<p><a href='{$GLOBALS['cfg_basehost']}/member/findpass.php?step=3&findtype=email&actstr=$actstr'>{$GLOBALS['cfg_basehost']}/member/findpass.php?step=3&findtype=email&actstr=$actstr</a></p>";
   $footer="</body></html>";
   $html=$header.$content.$footer;
   $status=ordermaill($arr['email'],$title,$html);
 
   if($status)
   {
	   $_SESSION['getpass_status']=0; //使用邮箱找回密码地址使用状态,0未使用,1,使用.
	  return true;
   }
	 
 }
 function getUserInfo($mid)
{
	global $dsql;
	$sql="select * from #@__member where mid='$mid'";
	$arr=$dsql->GetOne($sql);
	return $arr;
	
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
    $_SESSION['msgcode'] = $out; //设置session值

    return $out;

}

 ?>
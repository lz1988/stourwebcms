<?php 
require_once(dirname(__FILE__)."/include/common.inc.php");
require_once(SLINEDATA."/webinfo.php");
@session_start();

$dopost = empty($dopost) ? 'add' : $dopost;
//添加问答

if($dopost=='add')
{
    
    $validate = isset($checkcode) ? strtolower(trim($checkcode)) : '';
    $svali = GetCkVdValue();//获取验证码
	
	if(strtolower($validate)!=$svali || $svali=='')
	{
		ResetVdValue();
		$url = $_SERVER['HTTP_REFERER'];
		Helper_Archive::showMsg('验证码错误!',$url,0);
		exit();
	}
	  //词汇过滤检查
    if( $cfg_notallowstr != '' )
    {
        if(preg_match("#".$cfg_notallowstr."#i", $leaveinfo))
        {
            $url = $_SERVER['HTTP_REFERER'];
			Helper_Archive::showMsg('问答内容含有禁用词汇!',$url,0);
            exit();
        }
    }
   $leaveinfo=RemoveXSS($question);
   $time=time();
   //判断用户是否登陆
   if(!empty($User->username))
   {
	   $nickname = $User->username;
	   $memberid = $User->uid;   
   }
   else
   {
	   $nickname = empty($nickname) ? '匿名' : $nickname;
	   $memberid = '';  
   }
   
    $ip=GetIP(); //ip地址
    $backurl = $_SERVER['HTTP_REFERER'];

    $nickname = Helper_Archive::pregReplace($nickname,1);//只能中文或者英文
    $productid = Helper_Archive::pregReplace($productid,2);
    $typeid =  Helper_Archive::pregReplace($typeid,2);
    $memberid =  Helper_Archive::pregReplace($memberid,2);
    $kindlist = Helper_Archive::getProductKindList($productid,$typeid);
   
   if(preg_match("/([\x81-\xfe][\x40-\xfe])/",$leaveinfo))  
   {
	   
	   $content=htmlspecialchars($leaveinfo);
       $sql="insert into #@__question(productid,content,typeid,nickname,ip,addtime,memberid,kindlist) values";
	   $sql.= "('$productid','$content','$typeid','$nickname','$ip','$time','$memberid','$kindlist')";
   
		if($dsql->ExecuteNoneQuery($sql))
		{
		  Helper_Archive::showMsg("你的问题提交成功,我们会尽快回复你!",$backurl,1);
		  exit();
		}
   }
   else
   {
	   $url = $_SERVER['HTTP_REFERER'];
	   Helper_Archive::showMsg("提问失败，内容中必须包含汉字",$url,0);
       exit();
   }

}




?>

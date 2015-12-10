<?php 
require_once(dirname(__FILE__)."/../include/common.inc.php");
@session_start();
$validate = isset($validate) ? strtolower(trim($validate)) : '';
$svali = GetCkVdValue();//获取验证码

if(strtolower($validate)!=$svali || $svali=='')
{
	ResetVdValue();
	ShowMsg('验证码错误!', '-1',1);
	exit();
}

$leavename = !isset($noname) ? $leavename : '匿名';
$ishidden = isset($noname) ? 0 : 1;
$time=time();
$musttime = isset($musttime) ? 1 : 0;

$leaveip=GetIP();

$aid=GetLastAid('#@__leave',0);

$title=RemoveXSS($title);
$email=RemoveXSS($email);
$qq=RemoveXSS($qq);
$msn=RemoveXSS($msn);
$leavename=RemoveXSS($leavename);
$telephone=RemoveXSS($telephone);
$content=RemoveXSS($content);
$sql="insert into #@__leave(webid,aid,leavename,qq,msn,email,title,content,leaveip,telephone,ishidden,addtime,ismust,typeid,postid) values('0','$aid','$leavename','$qq','$msn','$email','$title','$content','$leaveip','$telephone','$ishidden','$time','$musttime','$typeid','$postid')";

if(!$dsql->ExecuteNoneQuery($sql))
{
     $gerr = $dsql->GetError();
	 echo $gerr;
	 exit;
     ShowMsg("提问失败,请检查","-1",1);
     exit();
}
else
{
    ShowMsg("提问成功,已经通知管理员,请耐心等待..","-1",1);
    exit();

}
?>
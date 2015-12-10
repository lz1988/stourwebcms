<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/6/1 0001
 * Time: 16:19
 */

require_once(dirname(__FILE__) . "/../include/common.inc.php");
$file = SLINEDATA . "/autotitle.cache.inc.php"; //载入智能title配置
require_once(dirname(__FILE__) . "/question.func.php");
Helper_Archive::loadModule('common');


$leaveArr=array();
$leaveArr['title']=strip_tags(trim($_POST['title']));
$leaveArr['content']=strip_tags(trim($_POST['content']));
$leaveArr['webid']=$GLOBALS['sys_child_webid'];
$leaveArr['phone']=strip_tags(trim($_POST['phone']));
$leaveArr['email']=strip_tags(trim($_POST['email']));
$leaveArr['qq']=strip_tags(trim($_POST['qq']));
$leaveArr['weixin']=strip_tags(trim($_POST['weixin']));
$leaveArr['addtime']=time();
$leaveArr['nickname']=$_POST['ishidename']==1?'匿名':strip_tags($_POST['leavename']);
$leaveArr['nickname']=empty($leaveArr['nickname'])?'匿名':$leaveArr['nickname'];
$leaveArr['ip']=GetIP();
$leaveArr['questype']=1;
if($User->IsLogin()) {
    $leaveArr['memberid']=$User->uid;
}

$checkcode=GetCkVdValue();
try{
    if($checkcode!=$_POST['checkcode'])
        throw new Exception('验证码错误');
    $_SESSION['total_value']='';
    if(empty($leaveArr['title']))
    {
        throw new Exception('标题不能为空');
    }
    if(empty($leaveArr['content']))
    {
        throw new Exception('内容不能为空');
    }
    if(empty($leaveArr['qq'])&&empty($leaveArr['phone'])&&empty($leaveArr['email'])&&empty($leaveArr['weixin']))
    {
        throw new Exception('请至少填写一种联系方式');
    }
    $model = new CommonModule('sline_question');
    $result=$model->add($leaveArr);
    if(!$result)
    {
        throw new Exception('系统错误，请重试');

    }
    echo json_encode(array('status'=>true,'msg'=>'提交成功'));

}catch(Exception $excep)
{
    $msg=$excep->getMessage();
    echo json_encode(array('status'=>false,'msg'=>$msg));
}





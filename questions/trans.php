<?php

require_once(dirname(__FILE__) . "/../include/common.inc.php");

Helper_Archive::loadModule('common');
$_leaveModule = new CommonModule('sline_leave');
$questionModel=new CommonModule('sline_question');
$leaveAll=$_leaveModule->getAll();

foreach($leaveAll as $k=>$v)
{
   $_arr['title']=$v['title'];
   $_arr['content']=$v['content'];
   $_arr['replycontent']=$v['reply'];
   $_arr['replytime']=$v['retime'];
   $_arr['nickname']=$v['leavename'];
   $_arr['ip']=$v['ip'];
   $_arr['status']=$v['approval']?1:0;
   $_arr['addtime']=$v['addtime'];
   $_arr['qq']=$v['qq'];
    $_arr['webid']=$v['webid'];
    $_arr['weixin']=$v['weixin'];
    $_arr['email']=$v['email'];
    $_arr['phone']=$v['phone'];
    $questionModel->add($_arr);
}
<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/5/13 0013
 * Time: 14:31
 */
require_once(dirname(__FILE__)."/../include/common.inc.php");
$xmlStr=$_POST['XmlStr'];
$xmlObj=new SimpleXMLElement($xmlStr);
$isSuccess=(string)$xmlObj->IsSuccess;
if($isSuccess=='false')
{
    exit('fail');
}
$transrNo=(string)$xmlObj->TransrNo;
$row=$dsql->GetOne("select * from #@__insurance_booking where ordersn='$transrNo'");
if(empty($row))
    exit('not exist');


var_dump($row);
Helper_Archive::loadModule('common');
$curtime=time();
$model = new CommonModule('#@__insurance_booking');
$arr['status']=2;
$arr['insureno']=(string)$xmlObj->InsureNo;
$arr['policyno']=(string)$xmlObj->PolicyNo;
$arr['policyfileid']=(string)$xmlObj->PolicyFileId;
$arr['payedtime']=$curtime;
$result=$model->update($arr,array('id'=>$row['id']));

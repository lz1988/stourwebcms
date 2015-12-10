<?php
 require_once(dirname(__FILE__)."/../include/common.inc.php");
 require_once(dirname(__FILE__).'/../include/view.class.php');


 $starttime=strtotime($starttime);
 $addtime=time();
/*foreach($_GET as $key=>$value)
{
    $_GET[$key]=RemoveXSS($value);
}
foreach($_POST as $key=>$value)
{
  //$key=RemoveXSS($value);

}*/

 $dest = Helper_Archive::pregReplace($dest,5);
$starttime = Helper_Archive::pregReplace($starttime,5);
$startplace = Helper_Archive::pregReplace($startplace,5);
$days = Helper_Archive::pregReplace($days,2);
$adultnum = Helper_Archive::pregReplace($adultnum,2);
$childnum = Helper_Archive::pregReplace($childnum,2);
$planerank = Helper_Archive::pregReplace($planerank,3);
$hotelrank = Helper_Archive::pregReplace($hotelrank,3);
$room = Helper_Archive::pregReplace($room,3);

$food = Helper_Archive::pregReplace($food,3);
$sex = Helper_Archive::pregReplace($sex,3);
$address = Helper_Archive::pregReplace($address,5);
$phone = Helper_Archive::pregReplace($phone,5);
$email = Helper_Archive::pregReplace($email,5);

$contacttime = Helper_Archive::pregReplace($contacttime,5);
$content = Helper_Archive::pregReplace($content,5);
$contactname = Helper_Archive::pregReplace($contactname,5);

 $sql="insert into #@__customize(dest,starttime,startplace,days,adultnum,
 childnum,planerank,hotelrank,room,food,sex,address,phone,email,contacttime,addtime,content,contactname) values(
 '$dest','$starttime','$startplace','$days','$adultnum','$childnum','$planerank','$hotelrank',
 '$room','$food','$sex','$address','$phone','$email','$contacttime','$addtime','$content','$contactname')";
 
 $result=$dsql->ExecuteNoneQuery($sql);
  if($result)
    Helper_Archive::showMsg('提交成功','/customize/index.php',1,2);
  else
    Helper_Archive::showMsg('提交失败','/customize/index.php',0,2);	
	
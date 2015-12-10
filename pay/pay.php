<?php 
  require_once(dirname(__FILE__)."/../include/common.inc.php");


  if($dopost=='save')
  {
	  $addtime=time();
      $sql="insert into sline_dzorder (ordersn,title,dingjin,username,phone,description,travelnum,addtime) values ('$ordersn','$title','$dingjin','$username','$phone','$description','$travelnum','$addtime')";
	  $result=$dsql->ExecuteNoneQuery2($sql);
	  
	  if($result)
	    echo Helper_Archive::payOnline($ordersn,$title,$dingjin);
      else
	  {
		  header('location:/pay/pay.php');
	  }
	  exit;
  }

  require_once SLINEINC."/view.class.php";
  $pv = new View();

  $ordersn='dz'.date('YmdHs');
  
  if(empty($GLOBALS['cfg_pay_type'])||$GLOBALS['cfg_pay_type']==1)
    $template='pay_alipay.htm';
  else if($GLOBALS['cfg_pay_type']==2)
    $template='pay_99bill.htm';	
  
  
  $pv->SetTemplet(SLINETEMPLATE ."/".$cfg_df_style ."/pay/".$template);
  $pv->Display();
  exit();

?>

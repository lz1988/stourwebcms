<?php

require_once('api/quickpay_service.php');
require  dirname(__FILE__).'/../include/common.inc.php';
try {
    $response = new quickpay_service($_POST, quickpay_conf::RESPONSE);
    if ($response->get('respCode') != quickpay_service::RESP_SUCCESS) {
        $err = sprintf("Error: %d => %s", $response->get('respCode'), $response->get('respMsg'));
        throw new Exception($err);
    }

    $arr_ret = $response->get_args();

    //更新数据库，将交易状态设置为已付款
    //注意保存qid，以便调用后台接口进行退货/消费撤销

    //以下仅用于测试
    file_put_contents('notify.txt', var_export($arr_ret, true));
    $out_trade_no = $arr_ret['orderNumber'];//订单号
    $sql="select * from #@__member_order where ordersn='$out_trade_no'";
    $arr=$dsql->GetOne($sql);

    if(substr($out_trade_no,0,2)=='dz')
    {
        $updatesql="update sline_dzorder set status=2 where ordersn='{$out_trade_no}'";
        $ordertype = 'dz';
    }
    else
    {
        $ordertype = 'sys';
        $updatesql="update sline_member_order set status=2 where ordersn='{$out_trade_no}'"; //付款标志置为1,交易成功
        $dsql->ExecuteNoneQuery($updatesql);
    }
    if($ordertype !='dz')
    {
        $msgInfo = Helper_Archive::getDefineMsgInfo($arr['typeid'],3);
        $memberInfo = Helper_Archive::getMemberInfo($arr['memberid']);
        $nickname = !empty($memberInfo['nickname']) ? $memberInfo['nickname'] : $memberInfo['mobile'];
        if(isset($msgInfo['isopen'])) //等待客服处理短信
        {
            $content = $msgInfo['msg'];
            $totalprice = $arr['price'] * $arr['dingnum'];
            $content = str_replace('{#MEMBERNAME#}',$memberinfo['nickname'],$content);
            $content = str_replace('{#PRODUCTNAME#}',$arr['productname'],$content);
            $content = str_replace('{#PRICE#}',$arr['PRICE'],$content);
            $content = str_replace('{#NUMBER#}',$arr['dingnum'],$content);
            $content = str_replace('{#TOTALPRICE#}',$totalPrice,$content);
            Helper_Archive::sendMsg($memberInfo['mobile'],$nickname,$content);//发送短信.
        }
        //支付成功后添加预订送积分
        if(!empty($arr['jifenbook']))
        {
            $addjifen = intval($arr['jifenbook']);
            $sql = "update sline_member set jifen=jifen+{$addjifen} where mid='{$arr['memberid']}'";
            if($dsql->ExecuteNoneQuery($sql))
            {
                Helper_Archive::addJifenLog($arr['memberid'],"预订线路{$arr['productname']}获取得{$addjifen}",$addjifen,2);
            }
        }
		 //如果是酒店订单,则把子订单置为交易成功状态
							   $sql="select typeid,id from sline_member_order where ordersn='{$out_trade_no}'";
							   $ar = $dsql->GetOne($sql);
							   if($ar['typeid']==2)
							   {
								   $s = "update sline_member_order set ispay=1 where pid='{$ar['id']}'";
								   $dsql->ExecuteNoneQuery($s);
							   }

    }



}
catch(Exception $exp) {
    //后台通知出错
    file_put_contents('notify.txt', var_export($exp, true));
}

?>

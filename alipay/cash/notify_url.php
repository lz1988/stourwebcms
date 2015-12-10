<?php
/* *
 * 功能：支付宝服务器异步通知页面
 * 版本：3.3
 * 日期：2012-07-23
 * 说明：
 * 以下代码只是为了方便商户测试而提供的样例代码，商户可以根据自己网站的需要，按照技术文档编写,并非一定要使用该代码。
 * 该代码仅供学习和研究支付宝接口使用，只是提供一个参考。


 *************************页面功能说明*************************
 * 创建该页面文件时，请留心该页面文件中无任何HTML代码及空格。
 * 该页面不能在本机电脑测试，请到服务器上做测试。请确保外部可以访问该页面。
 * 该页面调试工具请使用写文本函数logResult，该函数已被默认关闭，见alipay_notify_class.php中的函数verifyNotify
 * 如果没有收到该页面返回的 success 信息，支付宝会在24小时内按一定的时间策略重发通知
 */

require_once("alipay.config.php");
require_once("lib/alipay_notify.class.php");
require_once(dirname(__FILE__)."/../../include/common.inc.php");


//计算得出通知验证结果
$alipayNotify = new AlipayNotify($alipay_config);
$verify_result = $alipayNotify->verifyNotify();


if($verify_result) {//验证成功

//logResult('ExecuteHere');	/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	//请在这里加上商户的业务逻辑程序代


	//——请根据您的业务逻辑来编写程序（以下代码仅作参考）——

    //获取支付宝的通知返回参数，可参考技术文档中服务器异步通知参数列表

	//商户订单号

	$out_trade_no = $_POST['out_trade_no'];

	$ordersn=$out_trade_no;


	//支付宝交易号

	$trade_no = $_POST['trade_no'];




	//交易状态
	$trade_status = $_POST['trade_status'];

    //logResult('交易状态:'.$trade_status);

    if($_POST['trade_status'] == 'TRADE_FINISHED') {
		//判断该笔订单是否在商户网站中已经做过处理
			//如果没有做过处理，根据订单号（out_trade_no）在商户网站的订单系统中查到该笔订单的详细，并执行商户的业务程序
			//如果有做过处理，不执行商户的业务程序

		//注意：
		//该种交易状态只在两种情况下出现
		//1、开通了普通即时到账，买家付款成功后。
		//2、开通了高级即时到账，从该笔交易成功时间算起，过了签约时的可退款时限（如：三个月以内可退款、一年以内可退款等）后。

        //调试用，写文本函数记录程序运行情况是否正常
        //logResult("这里写入想要调试的代码变量值，或其他运行的结果记录");

		//logResult('发送短信成功');
    }
    else if ($_POST['trade_status'] == 'TRADE_SUCCESS') {



		//判断该笔订单是否在商户网站中已经做过处理
			//如果没有做过处理，根据订单号（out_trade_no）在商户网站的订单系统中查到该笔订单的详细，并执行商户的业务程序
			//如果有做过处理，不执行商户的业务程序

		//注意：
		//该种交易状态只在一种情况下出现——开通了高级即时到账，买家付款成功后。

        //调试用，写文本函数记录程序运行情况是否正常
        //logResult("这里写入想要调试的代码变量值，或其他运行的结果记录");

		//logResult('sql:'.$sql);
       $sql="select * from #@__member_order where ordersn='$ordersn'";
   	   $arr=$dsql->GetOne($sql);


		//logResult('spotid:'.$arr['spotid']);
	//	if(!$arr)exit();

		if(substr($ordersn,0,2)=='dz')
		{
           $ordertype = 'dz';
		   $updatesql="update sline_dzorder set status=2 where ordersn='$ordersn'";
		}
		else
		{
           $ordertype = 'sys';
		   $updatesql="update #@__member_order set ispay=1,status=2 where ordersn='$ordersn'"; //付款标志置为1,交易成功

		  
		}
		$dsql->ExecuteNoneQuery($updatesql);
		//logResult('更新成功');

		//$subject='你成功预订'.$arr['productname'].'产品';
		//$text="尊敬的{$arr['linkman']},你已经成功在{$GLOBALS['cfg_webname']}预订{$arr['productname']},数量{$arr['dingnum']}.";
		//sendMsg($subject,$text,$arr['handletel'],$ordersn);

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
		   $sql="select typeid,id from sline_member_order where ordersn='$ordersn'";
		   $ar = $dsql->GetOne($sql);
		   if($ar['typeid']==2)
		   {
		       $s = "update sline_member_order set ispay=1 where pid='{$ar['id']}'";
			   $dsql->ExecuteNoneQuery($s);
		   }
        }



		//logResult('发送短信成功');

    }

	//——请根据您的业务逻辑来编写程序（以上代码仅作参考）——

	echo "success";		//请不要修改或删除

	/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
}
else {
    //验证失败
    echo "fail";

    //调试用，写文本函数记录程序运行情况是否正常
    //logResult("这里写入想要调试的代码变量值，或其他运行的结果记录");
}


?>
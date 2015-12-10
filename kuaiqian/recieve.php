<?php

 require  dirname(__FILE__).'/../include/common.inc.php';
	
	function kq_ck_null($kq_va,$kq_na){if($kq_va == ""){return $kq_va="";}else{return $kq_va=$kq_na.'='.$kq_va.'&';}}
	//人民币网关账号，该账号为11位人民币网关商户编号+01,该值与提交时相同。
	$kq_check_all_para=kq_ck_null($_REQUEST['merchantAcctId'],'merchantAcctId');

	//设置人民币网关密钥
	///区分大小写
	$key=$GLOBALS['cfg_bill_key'];


	//网关版本，固定值：v2.0,该值与提交时相同。
	$kq_check_all_para.=kq_ck_null($_REQUEST['version'],'version');
	//语言种类，1代表中文显示，2代表英文显示。默认为1,该值与提交时相同。
	$kq_check_all_para.=kq_ck_null($_REQUEST['language'],'language');
	//签名类型,该值为4，代表PKI加密方式,该值与提交时相同。
	$kq_check_all_para.=kq_ck_null($_REQUEST['signType'],'signType');
	//支付方式，一般为00，代表所有的支付方式。如果是银行直连商户，该值为10,该值与提交时相同。
	$kq_check_all_para.=kq_ck_null($_REQUEST['payType'],'payType');
	//银行代码，如果payType为00，该值为空；如果payType为10,该值与提交时相同。
	$kq_check_all_para.=kq_ck_null($_REQUEST['bankId'],'bankId');
	//商户订单号，,该值与提交时相同。
	$kq_check_all_para.=kq_ck_null($_REQUEST['orderId'],'orderId');
	//订单提交时间，格式：yyyyMMddHHmmss，如：20071117020101,该值与提交时相同。
	$kq_check_all_para.=kq_ck_null($_REQUEST['orderTime'],'orderTime');
	//订单金额，金额以“分”为单位，商户测试以1分测试即可，切勿以大金额测试,该值与支付时相同。
	$kq_check_all_para.=kq_ck_null($_REQUEST['orderAmount'],'orderAmount');
	// 快钱交易号，商户每一笔交易都会在快钱生成一个交易号。
	$kq_check_all_para.=kq_ck_null($_REQUEST['dealId'],'dealId');
	//银行交易号 ，快钱交易在银行支付时对应的交易号，如果不是通过银行卡支付，则为空
	$kq_check_all_para.=kq_ck_null($_REQUEST['bankDealId'],'bankDealId');
	//快钱交易时间，快钱对交易进行处理的时间,格式：yyyyMMddHHmmss，如：20071117020101
	$kq_check_all_para.=kq_ck_null($_REQUEST['dealTime'],'dealTime');
	//商户实际支付金额 以分为单位。比方10元，提交时金额应为1000。该金额代表商户快钱账户最终收到的金额。
	$kq_check_all_para.=kq_ck_null($_REQUEST['payAmount'],'payAmount');
	//费用，快钱收取商户的手续费，单位为分。
	$kq_check_all_para.=kq_ck_null($_REQUEST['fee'],'fee');
	//扩展字段1，该值与提交时相同
	$kq_check_all_para.=kq_ck_null($_REQUEST['ext1'],'ext1');
	//扩展字段2，该值与提交时相同。
	$kq_check_all_para.=kq_ck_null($_REQUEST['ext2'],'ext2');
	//处理结果， 10支付成功，11 支付失败，00订单申请成功，01 订单申请失败
	$kq_check_all_para.=kq_ck_null($_REQUEST['payResult'],'payResult');
	//错误代码 ，请参照《人民币网关接口文档》最后部分的详细解释。
	$kq_check_all_para.=kq_ck_null($_REQUEST['errCode'],'errCode');

	$kq_check_all_para.=kq_ck_null($key,"key");

	$kq_check_all_para=substr($kq_check_all_para,0,strlen($kq_check_all_para)-1);
	
	$merchantSignMsg= md5($kq_check_all_para);
	
	//获取加密签名串
	$signMsg=trim($_REQUEST['signMsg']);
	
	//初始化结果及地址
	$rtnOk=0;
	$rtnUrl="";

	//商家进行数据处理，并跳转会商家显示支付结果的页面
///首先进行签名字符串验证
if(strtoupper($signMsg)==strtoupper($merchantSignMsg)){

		switch($_REQUEST['payResult']){
				case '10':
						//此处做商户逻辑处理
						
						if(substr($_REQUEST['orderId'],0,2)=='dz')
						{
						   $updatesql="update sline_dzorder set status=2 where ordersn='{$_REQUEST['orderId']}'";	
						}
						else
                        {
                            $updatesql="update sline_member_order set status=2 where ordersn='{$_REQUEST['orderId']}'"; //付款标志置为1,交易成功
                            $dsql->ExecuteNoneQuery($updatesql);
                            $sql="select * from #@__member_order where ordersn='{$_REQUEST['orderId']}'";
                            $arr=$dsql->GetOne($sql);
                            $msgInfo = Helper_Archive::getDefineMsgInfo($arr['typeid'],3);
                            $memberInfo = Helper_Archive::getMemberInfo($arr['memberid']);
                            $nickname = !empty($memberInfo['nickname']) ? $memberInfo['nickname'] : $memberInfo['mobile'];
                            if(isset($msgInfo['isopen'])) //等待客服处理短信
                            {
                                $content = $msgInfo['msg'];
                                $totalprice = $arr['price'] * $arr['dingnum'];
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

                        }

						
						
						
						$rtnOK=1;
						//以下是我们快钱设置的show页面，商户需要自己定义该页面。
						$rtnUrl=$GLOBALS['cfg_basehost']."/kuaiqian/show.php?msg=success";
						break;
				default:
						$rtnOK=1;
						//以下是我们快钱设置的show页面，商户需要自己定义该页面。
						$rtnUrl=$GLOBALS['cfg_basehost']."/kuaiqian/show.php?msg=false";
						break;	
		
		}

	}else{
						$rtnOK=1;
						//以下是我们快钱设置的show页面，商户需要自己定义该页面。
						$rtnUrl=$GLOBALS['cfg_basehost']."/kuaiqian/show.php?msg=error";
							
	}



?>

<result><?PHP echo $rtnOK; ?></result> <redirecturl><?PHP echo $rtnUrl; ?></redirecturl>
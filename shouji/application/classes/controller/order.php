<?php defined('SYSPATH') or die('No direct script access.');
class Controller_Order extends Stourweb_Controller{

    public function before()
    {
        parent::before();
    }
     


    //订单创建(post提数参数)
    //(id=>'产品id';suitid=>'套餐id';dateid=>'价格id或linux出行时间';ordertype=>'产品的类型';dingnum=>'大人数量或产品数量';childnum=>'小孩数量，没有填0';linkman=>'联系人';linktel=>'联系人电话')
	public function action_create(){

		$id = Arr::get($_POST,'id');
		$suitid = Arr::get($_POST,'suitid');//套餐id
        $tmpdateid = Arr::get($_POST,'dateid');
        $dateid = is_numeric($tmpdateid) ? $tmpdateid : strtotime($tmpdateid);//价格id
        $typeid = Arr::get($_POST,'ordertype');//订单类型
        $linktel = Arr::get($_POST,'linktel');//手机号
        $remark = Arr::get($_POST,'remark');//备注信息
        if(empty($linktel))
        {
            Common::showMsg('手机号不能为空',-1);
        };
        if(empty($id)||empty($typeid)){
        	$this->request->redirect('page/404/');
        }
        switch ($typeid) {
        	//线路
        	case '1':
	        	$info = ORM::factory('line')->where("id=$id")->find()->as_array();
	        	$suitarr = ORM::factory('line_suit')->where("id=$suitid")->find()->as_array();
	        	$datearr = ORM::factory('line_suit_price')->where("day=$dateid and suitid=$suitid")->find()->as_array();
                if($suitarr['paytype']=='3')//这里补充一个当为二次确认时,修改订单为未处理状态.
                {
                    $info['status'] = 0;
                }
                else
                {
                    $info['status'] = 1;
                }
	        	$info['name']= $info['title']."({$suitarr['suitname']})";
	        	$info['litpic']= $info['litpic'];
	        	$info['paytype']=$suitarr['paytype'];
	            $info['dingjin']=intval($suitarr['dingjin']);
	        	$info['jifentprice']=intval($suitarr['jifentprice']);
	            $info['jifenbook']=intval($suitarr['jifenbook']);
	            $info['jifencomment']=intval($suitarr['jifencomment']);
	            $info['ourprice']=intval($datearr['adultprice']);
	            $info['childprice']=intval($datearr['childprice']);
	            $info['usedate']=date('Y-m-d',$datearr['day']);

        		break;
        	//酒店
        	case '2':
	        	$info = ORM::factory('hotel')->where("id=$id")->find()->as_array();
	        	$suitarr = ORM::factory('hotel_room')->where("id=$suitid")->find()->as_array();
	        	$datearr = ORM::factory('hotel_room_price')->where("day=$dateid and suitid=".$suitid)->find()->as_array();
                if($suitarr['paytype']=='3')//这里补充一个当为二次确认时,修改订单为未处理状态.
                {
                    $info['status'] = 0;
                }
                else
                {
                    $info['status'] = 1;
                }
	        	$info['name']= $info['title']."({$suitarr['roomname']})";
	        	$info['litpic']= $info['litpic'];
	        	$info['paytype']=$suitarr['paytype'];
	            $info['dingjin']=intval($suitarr['dingjin']);
	        	$info['jifentprice']=intval($suitarr['jifentprice']);
	            $info['jifenbook']=intval($suitarr['jifenbook']);
	            $info['jifencomment']=intval($suitarr['jifencomment']);
	            $info['ourprice']=intval($datearr['price']);
	            $info['childprice']=0;
	            $info['usedate']=date('Y-m-d',$datearr['day']);
        		break;
        	//租车
        	case '3':
        	    $info = ORM::factory('car')->where("id=$id")->find()->as_array();
	        	$suitarr = ORM::factory('car_suit')->where("id=$suitid")->find()->as_array();
	        	$datearr = ORM::factory('car_suit_price')->where("day=".$dateid." and suitid=".$suitid)->find()->as_array();
                if($suitarr['paytype']=='3')//这里补充一个当为二次确认时,修改订单为未处理状态.
                {
                    $info['status'] = 0;
                }
                else
                {
                    $info['status'] = 1;
                }
	        	$info['name']= $info['title']."({$suitarr['suitname']})";;
	        	$info['litpic']= $info['litpic'];
	        	$info['paytype']=$suitarr['paytype'];
	            $info['dingjin']=intval($suitarr['dingjin']);
	        	$info['jifentprice']=intval($suitarr['jifentprice']);
	            $info['jifenbook']=intval($suitarr['jifenbook']);
	            $info['jifencomment']=intval($suitarr['jifencomment']);
	            $info['ourprice']=intval($datearr['adultprice']);
	            $info['childprice']=0;
	            $info['usedate']=date('Y-m-d',$datearr['day']);
        		break;
        	//景点门票
        	case '5':
        		$info = ORM::factory('spot')->where("id=$id")->find()->as_array();
	        	$suitarr = ORM::factory('spot_ticket')->where("id=$suitid")->find()->as_array();
                if($suitarr['paytype']=='3')//这里补充一个当为二次确认时,修改订单为未处理状态.
                {
                    $info['status'] = 0;
                }
                else
                {
                    $info['status'] = 1;
                }
	        	$info['name']= $info['title']."({$suitarr['title']})";;
	        	$info['litpic']= $info['litpic'];
	        	$info['paytype']=$suitarr['paytype'];
	            $info['dingjin']=intval($suitarr['dingjin']);
	            $info['ourprice']=intval($suitarr['ourprice']);
	            $info['childprice']=0;
	        	$info['jifentprice']=intval($suitarr['jifentprice']);
	            $info['jifenbook']=intval($suitarr['jifenbook']);
	            $info['jifencomment']=intval($suitarr['jifencomment']);
        		break;
        	//签证
        	case '8':
        		$info = ORM::factory('visa')->where("id=$id")->find()->as_array();
                $info['name']=$info['title'];
        		$info['ourprice']=intval($info['price']);
        		$info['childprice']=0;
        		break;
        	//团购
        	case '13':
        		$info = ORM::factory('tuan')->where("id=$id")->find()->as_array();
        		$info['childprice']=0;
                $info['name'] = $info['title'];
                $info['suitid'] = 0;
                $info['ourprice']=$info['price'];


        		break;
        	default:
        		# 调用错误页面
        		break;
        }
        $order_prefix = $typeid<10 ? '0'.$typeid : $typeid;
        $ordersn = Common::getOrderSn($order_prefix);
        if(!isset($GLOBALS['userinfo']['mid']))//如果未登陆
        {

            $sql = "select * from sline_member where mobile='$linktel' limit 1";
            $row = DB::query(1,$sql)->execute()->as_array();
            if(!empty($row[0]['mid']))
            {
                $mid = $row[0]['mid'];
            }
            else //如果不存在则创建新用户
            {
                $model = ORM::factory('member');
                $model->mobile = $linktel;
                $model->pwd = md5($linktel);
                $model->nickname = substr_replace($linktel,'***',3,3);
                $model->save();
                if($model->saved()) //注册成功
                {
                   $mid = $model->mid;
                }
                else
                {
                   $mid = 0;

                }
            }



        }
        else
        {
            $mid = $GLOBALS['userinfo']['mid'];
        }
        $arr = array(
            'ordersn'=>$ordersn,
            'webid'=>0,
            'typeid'=>$typeid,
            'productautoid'=>$id,
            'productaid'=>$info['aid'],
            'productname'=>$info['name'],
            'litpic'=>$info['litpic'],
            'price'=>$info['ourprice'],
            'childprice'=>$info['childprice'],
            'jifentprice'=>$info['jifentprice'],
            'jifenbook'=>$info['jifenbook'],
            'jifencomment'=>$info['jifencomment'],
            'paytype'=>$info['paytype'],
            'dingjin'=>$info['dingjin'],
            'usedate'=>$info['usedate'],
            'addtime'=>time(),
            'memberid'=>$mid,
            'dingnum'=>Arr::get($_POST,'dingnum'),
            'childnum'=>Arr::get($_POST,'childnum'),
            'oldprice'=>Arr::get($_POST,'oldprice'),
            'oldnum'=>Arr::get($_POST,'oldnum'),
            'linkman'=>Arr::get($_POST,'linkman'),
            'linktel'=>Arr::get($_POST,'linktel'),
            'suitid'=> Arr::get($_POST,'suitid'),
            'remark'=> $remark,
            'status'=>$info['status'] ? $info['status'] : 0
        );

        if(Common::addOrder($arr))
        {
           /* $totalPrice = $info['ourprice'] * Arr::get($_POST,'dingnum')+$info['childprice']*Arr::get($_POST,'childnum');
            if($info['paytype']=='3') //二次确认支付
            {
                $msgInfo = Common::getDefineMsgInfo($typeid,1);
                if(isset($msgInfo['isopen'])) //等待客服处理短信
                {
                    $content = $msgInfo['msg'];
                    $content = str_replace('{#MEMBERNAME#}',$linktel,$content);
                    $content = str_replace('{#PRODUCTNAME#}',$info['name'],$content);
                    $content = str_replace('{#PRICE#}',$info['ourprice'],$content);
                    $content = str_replace('{#NUMBER#}',Arr::get($_POST,'dingnum'),$content);
                    $content = str_replace('{#TOTALPRICE#}',$totalPrice,$content);
                    Common::sendMsg($linktel,'',$content);//发送短信.
                }

            }
            else //全款支付/订金支付
            {
                $msgInfo = Common::getDefineMsgInfo($typeid,2);
                if(isset($msgInfo['isopen']))
                {
                    $content = $msgInfo['msg'];
                    $content = str_replace('{#MEMBERNAME#}',$linktel,$content);
                    $content = str_replace('{#PRODUCTNAME#}',$info['name'],$content);
                    $content = str_replace('{#PRICE#}',$info['ourprice'],$content);
                    $content = str_replace('{#NUMBER#}',Arr::get($_POST,'dingnum'),$content);
                    $content = str_replace('{#TOTALPRICE#}',$totalPrice,$content);
                    Common::sendMsg($linktel,'',$content);//发送短信.
                }


            }*/

            //订单邮件提醒
            $mailto = Common::getSysConf('value','cfg_Email139',0);
             
            $title   = $arr['productname'].'预订成功';
             
            $content = $arr['linkman'] . "预定" . $arr['usedate']  . $arr['productname'] . "(单价:".$arr['price'].")".",数量:" . $arr['dingnum'] . "人" . ";联系电话:".$arr['linktel']."-----".$GLOBALS['cfg_webname'];

            if(!empty($mailto))Common::ordermaill($mailto,$title,$content);

            $ar = DB::query(1,"select id from sline_member_order where ordersn='$ordersn'")->execute()->as_array();

            $this->request->redirect('page/pay/orderid/'.$ar[0]['id']);
        }
	}
	 
}

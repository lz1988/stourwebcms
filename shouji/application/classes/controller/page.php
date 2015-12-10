<?php defined('SYSPATH') or die('No direct script access.');
class Controller_Page extends Stourweb_Controller{

    public function before()
    {
        parent::before();

    }
    //404页面
	public function action_404()
    {
         header('HTTP/1.1 404 Not Found');
         header("status: 404 Not Found");
         $this->display('public/404');
	}
    /*
     * 付款选择页面
     * */
    public function action_pay()
    {
        $orderid = $this->params['orderid'];
        $model = new Model_Member_Order();
        $info = $model->getOrderDetail($orderid);
        $totalprice = $info['price'] * $info['dingnum']+$info['childprice']*$info['childnum']+$info['oldprice']*$info['oldnum'];
        $info['depoist'] = $info['dingjin']*($info['dingnum']+$info['childnum']+$info['oldnum']);
        $info['totalprice'] = $totalprice;
        $cfg_pay_type=Common::getSysPara('cfg_pay_type');
        $pay_arr=explode(',',$cfg_pay_type);
        if(in_array(6,$pay_arr))
          $this->assign('isXianxia',1);
		$this->assign('paytypes',$pay_arr);
        $this->assign('info',$info);
        $this->display('public/fukuan');

    }
    /*
     * 进行支付页面
     * */
    public function action_dopay()
    {
       $orderid = Arr::get($_POST,'orderid');
       $paytype = Arr::get($_POST,'paytype');
       $info = ORM::factory('member_order',$orderid)->as_array();
        if(intval($info['dingjin'])>0){
            $totalprice = $info['dingjin']*($info['dingnum']+$info['childnum']+$info['oldnum']);
        }else{
            $totalprice = $info['price'] * $info['dingnum']+$info['childnum']*$info['childprice']+$info['oldnum']*$info['oldprice'];
        }
       if($paytype==0)
       {
           header('Location:'.$GLOBALS['cfg_cmspath'].'user/orderlist');
           exit;
      }
       echo Common::payOnline($info['ordersn'],$info['productname'],$totalprice,$paytype);

    }
    /*
     *
     * 评论公共显示列表
     * */
    public function action_pinlun()
    {
        $articleid = $this->params['id'];
        $typeid = $this->params['typeid'];
        $action = $this->params['action'];
        $page = $this->params['page'];
        $table_arr = array(
            '1'=>'line',
            '2'=>'hotel',
            '3'=>'car',
            '5'=>'spot',
            '8'=>'visa',
            '13'=>'tuan'
        );

        $module = $table_arr[$typeid];
        $row =ORM::factory($module)->where("id=$articleid")->find()->as_array();
        $row['score'] = Model_Comment::getScore($articleid,$typeid);
        $row['commentnum'] = Model_Comment::getPinLunCount($articleid,$typeid);
        $page = $page ? $page : 1;
        $pagesize = 10;
        $offset = ($page-1)*$pagesize;
        $sql = "select * from sline_comment where articleid='$articleid' and typeid='$typeid' limit {$offset},{$pagesize}";
        $pl = DB::query(1,$sql)->execute()->as_array();
        foreach($pl as $key=>$v)
        {
            $score = $pl[$key]['score1']*20;
            $memberinfo = Common::getMemberInfo($v['memberid']);
            $pl[$key]['memberico']= $memberinfo['litpic'] ? $memberinfo['litpic'] : Common::getDefaultImage();
            $pl[$key]['membername'] = $memberinfo['nickname'];
            $pl[$key]['membercore'] = $score.'%';
        }

        if($action == 'ajax')
        {
            echo json_encode($pl);
            exit();
        }
        $this->assign('pinlunlist',$pl);
        $this->assign('info',$row);
        $this->assign('typeid',$typeid);
        $this->display('public/pinlun');
    }

    //支付成功页面
    public function action_paysuccess()
    {
        $this->display('public/success');
    }

    public function action_query()
    {
        $this->display('public/query_order');
    }

    //订单查询页面
    public function action_queryorder()
    {
        $mobile = Common::pregReplace(Arr::get($_POST,'mobile'),2);
        if(empty($mobile))
        {
            Common::showMsg('请填写手机号进行查询',-1);
        }

        $model = new Model_Member_Order();
        $order = $model->getOrderListByMobile($mobile);
        $this->assign('orderlist',$order);
        $this->display('public/query_order');

    }


	 



}

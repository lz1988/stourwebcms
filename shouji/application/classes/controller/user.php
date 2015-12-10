<?php defined('SYSPATH') or die('No direct script access.');
class Controller_User extends Stourweb_Controller{

    private $user = null;
    private $mid = null;

    public function before()
    {
        parent::before();
        $refer_url = $_SERVER['HTTP_REFERER'] ? $_SERVER['HTTP_REFERER'] : $GLOBALS['cfg_cmsurl'];
        $this->assign('backurl',$refer_url);
        $this->user = $GLOBALS['userinfo'];
        $this->mid = $this->user['mid'] ? $this->user['mid'] : 0;


    }

    /*用户注册页面*/
    public function action_register()
    {
        if(isset($GLOBALS['userinfo']['mid']))
        {
            
            $this->request->redirect('/');

        }
        $forwardurl = Arr::get($_GET,'forwardurl');
        if(!empty($forwardurl)){
            $this->assign('backurl',$forwardurl); 
        }
       
        $this->display('user/register');
    }

    /*执行用户注册*/
    public function action_doreg()
    {
        $mobile = Arr::get($_POST,'mobile');
        $pwd = Arr::get($_POST,'password');

        $checkcode = Arr::get($_POST,'checkcode');
        $backurl = Arr::get($_POST,'backurl');
        //验证码
        $checkcode=strtolower($checkcode);
        $flag = Model_Member::checkExist('mobile',$mobile);
        if(!$flag)
        {
            Common::showMsg('手机号码重复,请重新填写','-1');
        }

        if(!Captcha::valid($checkcode))
        {
            Common::showMsg('验证码错误','-1');
        }
        $model = ORM::factory('member');
        $model->mobile = $mobile;
        $model->pwd = md5($pwd);
		$model->logintime = time();
        $model->nickname = substr_replace($mobile,'***',3,3);
        $model->save();
        if($model->saved()) //注册成功
        {
            Model_Member::login($mobile,$pwd);
            Common::showMsg('注册成功',$backurl);
        }
        else
        {

            //Common::showMsg('注册失败,请联系网站管理员','-1');
        }




    }

    /*
     * 用户登陆页面
     * */
    public function action_login()
    {
        
        if(!empty($GLOBALS['userinfo']['mid']))
        {
            header("location:{$_SERVER['HTTP_REFERER']}");
            exit();
        }
        $forwardurl = Arr::get($_GET,'forwardurl');
        $this->assign('forwardurl',$forwardurl);
        $this->display('user/login');
    }

    public function action_dologin()
    {
        $mobile = Arr::get($_POST,'mobile');
        $pwd = Arr::get($_POST,'password');
        $backurl = Arr::get($_POST,'backurl');
        $forwardurl = Arr::get($_POST,'forwardurl');
        $userinfo = Model_Member::login($mobile,$pwd);
        if(!empty($userinfo['mid']))
        {
            $redirecturl = !empty($forwardurl) ? $forwardurl : $backurl;
            Common::showMsg('',$redirecturl);
        }
        else
        {
            Common::showMsg('登陆失败,请检查用户名或密码是否正确','-1');
        }
    }

    /*
     * 用户中心首页
     * */
    public function action_index()
    {

        self::checkMid();
        $this->display('user/index');
    }

    /*
     * 订单列表
     * */
    public function action_orderlist()
    {
      self::checkMid();
      $model = new Model_Member_Order();
      $this->assign('status',Model_Member_Order::$statusNames);
      $order = $model->getOrderList($this->mid);
      $this->assign('orderlist',$order);
      $this->assign('page',1);
      $this->display('user/order_list');
    }

    //订单查看更多
    public function action_ajax_order_more()
    {
        $out = array();
        $page = Arr::get($_POST,'page');//当前页数
        $model = new Model_Member_Order();
        $order = $model->getOrderList($this->mid,5,$page);

        if(!empty($order))
        {
            $out['status'] = 'success';
            $out['orderlist'] = $order;
        }
        else
        {
            $out['status'] = 'failure';
        }
        echo json_encode($out);
        exit;

    }

    //订单详情
    public function action_order_detail()
    {
        $orderid = $this->params['orderid'];
        $model = new Model_Member_Order();
        $order = $model->getOrderDetail($orderid);
        $this->assign('order',$order);
        $this->display('user/order_detail');
    }

    //评论列表
    public function action_pinlunlist()
    {
        self::checkMid();
        $pinlunlist = array();
        $model = new Model_Member_Order();
        $orderlist = $model->getOrderList($this->mid,5,1,1);
        foreach($orderlist as $order )
        {

            $pinlun = $model->getOrderPinlun($order['id']);

            if(isset($pinlun['id']))
            {
                $order['pinlun'] = $pinlun;
                array_push($pinlunlist,$order);

            }
        }
        $this->assign('orderlist',$pinlunlist);
        $this->display('user/pinlun_list');

    }

    //评论查看更多
    public function action_ajax_pinlun_more()
    {
        $out = array();
        $page = Arr::get($_POST,'page');//当前页数
        $model = new Model_Member_Order();
        $order = $model->getOrderList($this->mid,1,$page,1);
        $pinlunlist = array();
        if(!empty($order))
        {
            foreach($order as $o)
            {
                $pinlun = $model->getOrderPinlun($o['id']);

                if(isset($pinlun['id']))
                {
                    $o['pinlun'] = $pinlun;
                    array_push($pinlunlist,$o);
                }

            }
            $out['status'] = 'success';
            $out['orderlist'] = $pinlunlist;
        }
        else
        {
            $out['status'] = 'failure';
        }

        echo json_encode($out);
        exit;

    }

   /*
    * 点评某个订单
    * */
    public function action_pinlun()
    {
        $orderid = $this->params['orderid'];
        $model = new Model_Member_Order();
        $order = $model->getOrderDetail($orderid);
        $this->assign('order',$order);
        $this->display('user/order_writepl');
    }
    /*
     * ajax保存点评
     * */
    public function action_ajax_save_pl()
    {

        $leavemsg = Arr::get($_POST,'leavemsg');
        $orderid = Arr::get($_POST,'orderid');
        $articleid = Arr::get($_POST,'articleid');
        $typeid = Arr::get($_POST,'typeid');
        $score = Arr::get($_POST,'score');
        $model = ORM::factory('comment');
        $model->memberid = $this->mid;
        $model->orderid = $orderid;
        $model->content = $leavemsg;
        $model->score1 = $score;
        $model->articleid = $articleid;
        $model->typeid = $typeid;
        $model->save();
        if($model->saved())
        {
            $status = 'success';
            $order_m = ORM::factory('member_order',$orderid);
            $order_m->ispinlun = 1;
            $order_m->save();
        }
        else
        {
            $status = 'failure';
        }
        echo json_encode(array('status'=>$status));
    }

    /*
     * 退出登陆
     * */
    public function action_loginout()
    {
        $session = Session::instance();
        $session->delete('mobile');
        Cookie::delete('mobile');
        Common::showMsg('',$GLOBALS['cfg_cmspath']);


    }

    private function checkMid()
    {
        if(empty($this->mid))
         $this->request->redirect('index');
    }
     




}

<?php defined('SYSPATH') or die('No direct script access.');
class Controller_Tuan extends Stourweb_Controller{

    public function before()
    {
        parent::before();

    }
    public function action_index()
    {
        $this->request->redirect('tuan/list');
    }

    //团购首页
    public function action_list()
    {
        $action=$this->params['action'];
        $kindid=$this->params['kindid'] ? $this->params['kindid'] : 0 ;
        $attrid=$this->params['attrid'] ? $this->params['attrid'] : 0;
        $page=$this->params['page'] ? $this->params['page'] : 1 ;
        $order=$this->params['order'];
        $w="a.id is not null and a.ishidden=0";
        $w.=empty($kindid)?'':" and find_in_set($kindid,a.kindlist)";
        $w.=empty($attrid)?'':" and find_in_set($attrid,a.attrid)";
 
        //排序
        $orderby = empty($order)?'order by a.modtime desc':"order by a.modtime $order";

        //当前页数信息
        $page = empty($page)?'1':$page;
        //每页记录数
        $pagesize= 10;

        //开始记录数字
        $starnum = ($page-1)*$pagesize;
        //结速记录数字
        $endnum = $pagesize;

        $limit = $starnum.','.$endnum;

        if(empty($kindid))
        {
          $sql="select a.* from sline_tuan as a left join sline_allorderlist b on (a.id=b.aid and b.typeid=13) where $w $orderby limit $limit";
        }
        else
        {
           $sql="select a.* from sline_tuan as a left join sline_kindorderlist as b on (b.classid=$kindid and a.id=b.aid and b.typeid=13)  where $w $orderby limit $limit";
            
        }



        $list=DB::query(Database::SELECT,$sql)->execute()->as_array();
        foreach($list as $key=>$v)
        {
            $litpic = $list[$key]['litpic'];
            $list[$key]['litpic'] = empty($litpic) ? Common::getDefaultImage() : $litpic;
        }

        if($action=="ajax"){
            echo json_encode($list);
            exit;
        }
        //目的地列表
        if(empty($kindid))
        {
            $pid = 0;
            $kindname = "目的地"; 
            $sqlkind="select b.id,b.kindname from sline_tuan_kindlist as a left join sline_destinations b on (a.kindid=b.id) where b.pid=0 and b.isopen=1 order by a.displayorder asc";
            $kindlist=DB::query(Database::SELECT,$sqlkind)->execute()->as_array(); //最顶级目的地

        }
        else
        {
            $pidkind =ORM::factory('destinations')->where("id=$kindid")->find()->as_array();
            $kindname = $pidkind['kindname'];
            $pid = $kindid;
            $sqlkind="select b.id,b.kindname from sline_tuan_kindlist as a left join sline_destinations b on (a.kindid=b.id) where b.pid=".$kindid." and b.isopen=1 order by a.displayorder asc";
            $kindlist=DB::query(Database::SELECT,$sqlkind)->execute()->as_array();
            if(empty($kindlist)) //如果下级为空则读取同级.
            {
                $sqlkind="select b.id,b.kindname from sline_tuan_kindlist as a left join sline_destinations b on (a.kindid=b.id) where b.pid=".intval($pidkind['pid'])." and b.isopen=1 order by a.displayorder asc";
                $kindlist=DB::query(Database::SELECT,$sqlkind)->execute()->as_array();
            }
        }

        //属性列表
        if(empty($attrid))
        {
            $attrname = '类别';
            $attrlist =ORM::factory('tuan_attr')->where("pid=0 and isopen=1")->order_by("displayorder","ASC")->get_all();

        }
        else
        {
            $thisattr =ORM::factory('tuan_attr')->where("id=$attrid")->find()->as_array();
            $attrname = $thisattr['attrname'];
            $pid = $thisattr['pid'];
            $attrlist=ORM::factory('tuan_attr')->where("pid=".$attrid)->order_by("displayorder",'asc')->get_all();
            if(empty($attrlist))
            {
                $attrlist=ORM::factory('tuan_attr')->where("pid=".$pid)->order_by("displayorder",'asc')->get_all();
            }

        }
        //列表传递
        $this->assign('kindlist',$kindlist);
        $this->assign('attrlist' ,$attrlist);
        //参数传递
        $this->assign('kindid',$kindid);
        $this->assign('attrid',$attrid);
        $this->assign('order',$order);
        $this->assign('kindname',$kindname);
        $this->assign('attrname',$attrname);
        $this->assign('pid',$pid);
        $this->assign('list',$list);
        $this->display('tuan/search');
    }

     //团购详情
    public function action_show()
    {
        $id=$this->params['id'];
        $tel=Common::getSysPara('cfg_phone');
        //详细信息
        $row =ORM::factory('tuan')->where("id=$id")->find()->as_array();
        $row['picturelist'] = Model_Tuan::handlePicture($row['piclist']);
        $row['score'] = Model_Comment::getScore($row['id'],13);
        $this->assign('tuan',$row);
        $this->assign('phone',$tel);
        $this->display('tuan/show');
    }

    //团购评论列表
    public function action_pinlun()
    {





    }


    //预订页面
    public function action_order()
    {
        $id=$this->params['orderid'];
       /* if(!isset($GLOBALS['userinfo']['mid']))
        {
            $forwardurl = URL::site('tuan/order/orderid/'.$id);
            $this->request->redirect('user/login?forwardurl='.$forwardurl);

        }*/
        //详细信息
        $info =ORM::factory('tuan')->where("id=$id")->find()->as_array();
        $this->assign('info',$info);
        $this->display('tuan/order');
    }

    //保存订单
    public function action_order_add()
    {
        $id = Arr::get($_POST,'tuanid');
        $typeid = 13;
        $info = ORM::factory('tuan')->where("id=$id")->find()->as_array();
        $ordersn = Common::getOrderSn($typeid);
        $arr = array(
            'ordersn'=>$ordersn,
            'webid'=>0,
            'typeid'=>$typeid,
            'productautoid'=>$info['id'],
            'productaid'=>$info['aid'],
            'productname'=>$info['title'],
            'litpic'=>$info['litpic'],
            'price'=>$info['ourprice'],
            'dingnum'=>Arr::get($_POST,'dingnum'),
            'linkman'=>Arr::get($_POST,'linkman'),
            'linktel'=>Arr::get($_POST,'linktel'),
            'jifentprice'=>$info['jifentprice'],
            'jifenbook'=>$info['jifenbook'],
            'jifencomment'=>$info['jifencomment'],
            'addtime'=>time(),
            'memberid'=>$GLOBALS['userinfo']['mid'],
            'paytype'=>$info['paytype'],
            'dingjin'=>$info['dingjin']

        );

        if(Common::addOrder($arr))
        {
            $ar = DB::query(1,"select id from sline_member_order where ordersn='$ordersn'")->execute()->as_array();
            $this->request->redirect('page/pay/orderid/'.$ar[0]['id']);
        }
    }






}
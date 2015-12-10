<?php defined('SYSPATH') or die('No direct script access.');
class Controller_Photo extends Stourweb_Controller{

    public function before()
    {
        parent::before();
    }
    //首页
    public function action_index()
    {
        $this->request->redirect('photo/list');
    }

    public function action_list()
    {
        $action=$this->params['action'];
        $kindid=$this->params['kindid'] ? $this->params['kindid'] : 0 ;
        $attrid=$this->params['attrid'] ? $this->params['attrid'] : 0;
        $page=$this->params['page'] ? $this->params['page'] : 1 ;
        $typeid = 6;

        $w="a.ishidden=0";
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

         /*if(empty($kindid))
         {
             $sql="select a.* from sline_photo as a left join sline_allorderlist b on (a.id=b.aid and b.typeid=$typeid) where $w $orderby limit $limit";
         }
         else
         {
            $sql="select a.* from sline_article as a left join sline_kindorderlist as b on (b.classid=$kindid and a.id=b.aid and b.typeid=$typeid)  where $w $orderby limit $limit";
         }*/
        $sql="select a.* from sline_photo as a left join sline_allorderlist b on (a.id=b.aid and b.typeid=$typeid) where $w $orderby limit $limit";

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
            $sqlkind="select b.id,b.kindname from sline_photo_kindlist as a left join sline_destinations b on (a.kindid=b.id) where b.pid=0 and b.isopen=1 order by a.displayorder asc";
            $kindlist=DB::query(Database::SELECT,$sqlkind)->execute()->as_array(); //最顶级目的地

        }
        else
        {
            $pidkind =ORM::factory('destinations')->where("id=$kindid")->find()->as_array();
            $kindname = $pidkind['kindname'];
            $pid = $kindid;
            $sqlkind="select b.id,b.kindname from sline_photo_kindlist as a left join sline_destinations b on (a.kindid=b.id) where b.pid=".$kindid." and b.isopen=1 order by a.displayorder asc";
            $kindlist=DB::query(Database::SELECT,$sqlkind)->execute()->as_array();
            if(empty($kindlist)) //如果下级为空则读取同级.
            {
                $sqlkind="select b.id,b.kindname from sline_photo_kindlist as a left join sline_destinations b on (a.kindid=b.id) where b.pid=".intval($pidkind['pid'])." and b.isopen=1 order by a.displayorder asc";
                $kindlist=DB::query(Database::SELECT,$sqlkind)->execute()->as_array();
            }
        }

        //属性列表
        if(empty($attrid))
        {
            $attrname = '类别';

        }
        else
        {
            $thisattr =ORM::factory('photo_attr')->where("id=$attrid")->find()->as_array();
            $attrname = $thisattr['attrname'];

        }
        $attrlist =ORM::factory('photo_attr')->where("pid!=0 and isopen=1")->order_by("displayorder","ASC")->get_all();

        //列表传递
        $this->assign('kindlist',$kindlist);
        $this->assign('attrlist',$attrlist);

        //参数传递
        $this->assign('kindid',$kindid);
        $this->assign('attrid',$attrid);
        $this->assign('kindname',$kindname);
        $this->assign('attrname',$attrname);

        $this->assign('list',$list);
        $this->display('photo/search');
    }

     //相册详情面页
    public function action_show(){
        $id=$this->params['id'];
        if(empty($id))exit();
        //详细信息
        $row =ORM::factory('photo')->where("id=$id")->find()->as_array();
        $picturelist = Model_Photo::handlePicture($row['id']);
        $this->assign('info',$row);
        $this->assign('picturelist',$picturelist);
        $this->display('photo/show');
    }
}
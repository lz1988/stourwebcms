<?php defined('SYSPATH') or die('No direct script access.');
class Controller_Raider extends Stourweb_Controller{

    public function before()
    {
        parent::before();
        $this->assign('seoinfo',Common::getChannelSeo(4));
        $this->assign('cmsurl', URL::site());
    }

    //目的地列表
    public function action_index(){

        //带图片的文章
        $articlelist1 =  ORM::factory('article')->where("litpic is not NULL and litpic<>'' and ishidden=0")->limit(4)->get_all();
        //推荐文章
        $articlelist2 =  ORM::factory('article')->where("ishidden=0")->limit(3)->get_all();
        //去掉html标记
        if(!empty($articlelist2)){
           foreach ($articlelist2 as $key => $value) {
              $articlelist2[$key]['content'] = Common::cutstr_html($value['content'],30);
            } 
        }

        //定位开启了首页显示的目的地
        $sql="select b.id,b.kindname from sline_article_kindlist as a left join sline_destinations b on (a.kindid=b.id) where a.isnav=1 and b.isopen=1 order by a.displayorder asc";

        $data = DB::query(Database::SELECT,$sql)->execute()->as_array();

        if(!empty($data)){
            foreach ($data as $key => $value) {
                $temarr =  ORM::factory('article')->where("find_in_set(".$value['id'].",kindlist) and ishidden=0")->limit('0,3')->get_all();
                //去掉html标记
               foreach ($temarr as $key1 => $value1) {
                if(empty($value1['litpic'])){
                    $temarr[$key1]['litpic'] = Common::getDefaultImage();
                }
                  $temarr[$key1]['content'] = Common::cutstr_html($value1['content'],30);
                } 
                $data[$key]['list'] = $temarr;
               
            }

            foreach ($data as $key => $value) {
                if(empty($value['list'])){
                    unset($data[$key]);
                }
            }
        }

        //热门目的地
        $sql="select b.id,b.kindname from sline_article_kindlist as a left join sline_destinations b on (a.kindid=b.id) where a.ishot=1 and b.isopen=1 order by a.displayorder asc";

        $hotlist = DB::query(Database::SELECT,$sql)->execute()->as_array();

        //数据压入
        $this->assign('rows1',$articlelist1);
        $this->assign('rows2',$articlelist2);
        $this->assign('citylist',$data);
        $this->assign('hotlist',$hotlist);
        $this->display('raider/index');
    }

    //目的地
    public function action_list(){
        $action=$this->params['action'];
        $kindid=$this->params['id'];
        $attrid=$this->params['attrid'];
        $page=$this->params['page'];
        $order=$this->params['order'];
        $w="a.id is not null and ishidden=0";
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
        $limit = $starnum.','.$pagesize;
        

        if(empty($kindid))
        {
          $sql="select a.id,a.litpic,a.aid,a.title,a.attrid,a.kindlist,a.litpic,a.content,a.webid,a.addtime,a.ishidden,a.themelist,a.iconlist,b.isjian,b.displayorder,b.isding,a.modtime from sline_article as a left join sline_allorderlist b on (a.id=b.aid and b.typeid=4) where $w $orderby limit $limit";
        }
        else
        {
           $sql="select a.id,a.litpic,a.aid,a.title,a.attrid,a.kindlist,a.litpic,a.content,a.webid,a.addtime,a.ishidden,a.themelist,a.iconlist,b.isjian,b.displayorder,b.isding,a.modtime from sline_article as a left join sline_kindorderlist as b on (b.classid=$kindid and a.id=b.aid and b.typeid=4)  where $w $orderby limit $limit";
            
        }

        $list=DB::query(Database::SELECT,$sql)->execute()->as_array();

        //去掉html标记
        if(!empty($list)){
           foreach ($list as $key => $value) {
            if(empty($value['litpic'])){
                $list[$key]['litpic'] = Common::getDefaultImage();
            }
              $list[$key]['content'] = Common::cutstr_html($value['content'],40);
            } 
        }

        if($action=="ajaxline"){
            echo json_encode($list);
            exit;
        }
        //目的地列表
        if(empty($kindid)){
            $pid = 0;
            $kindname = "目的地"; 
            $sqlkind="select b.id,b.kindname from sline_article_kindlist as a left join sline_destinations b on (a.kindid=b.id) where b.pid=".$pid." and b.isopen=1 order by a.displayorder asc";
            $kindlist=DB::query(Database::SELECT,$sqlkind)->execute()->as_array();
        }else{
            $pidkind =ORM::factory('destinations')->where("id=$kindid")->find()->as_array();
            $kindname = $pidkind['kindname'];
            $pid = $kindid;
            $sqlkind="select b.id,b.kindname from sline_article_kindlist as a left join sline_destinations b on (a.kindid=b.id) where b.pid=".$kindid." and b.isopen=1 order by a.displayorder asc";
            $kindlist=DB::query(Database::SELECT,$sqlkind)->execute()->as_array();
            if(empty($kindlist)){
                $sqlkind="select b.id,b.kindname from sline_article_kindlist as a left join sline_destinations b on (a.kindid=b.id) where b.pid=".intval($pidkind['pid'])." and b.isopen=1 order by a.displayorder asc";
                $kindlist=DB::query(Database::SELECT,$sqlkind)->execute()->as_array();
            }
        }

        //属性列表
        if(empty($attrid)){
            $attrname = '类别';
            $travellist = ORM::factory('article_attr')->where("webid=0  and isopen=1 and pid=0")->get_all();
        }else{
            $thisattr =ORM::factory('article_attr')->where("id=$attrid")->find()->as_array();
            $attrname = $thisattr['attrname'];
            $travellist = ORM::factory('article_attr')->where("webid=0 and isopen=1 and pid=".$attrid)->get_all();
            if(empty($travellist)){
                 $temattr =ORM::factory('article_attr')->where("id=".$attrid)->find()->as_array();
                 $travellist = ORM::factory('article_attr')->where("webid=0 and isopen=1 and pid=".intval($temattr['pid']))->get_all();
            }
        }
        

        //列表传递
        $this->assign('kindlist',$kindlist);
        $this->assign('attrlist',$travellist);

        //参数传递
        $this->assign('kindid',empty($this->params['id'])?"0":$this->params['id']);
        $this->assign('kindname',$kindname);
        $this->assign('attrname',$attrname);
        $this->assign('pid',$pid);
        $this->assign('attrid',$this->params['attrid']);
        $this->assign('order',$order);

        $this->assign('list',$list);
        $this->display('raider/search');
    }

     //攻略详情
    public function action_show(){
        $id=$this->params['id'];

        //详细信息
        $row =ORM::factory('article')->where("id=$id")->find()->as_array();
        if(empty($row['litpic'])){
            $row['litpic'] = Common::getDefaultImage();
        }
        
        //print_r($row);
        $this->assign('row',$row);
        $this->display('raider/show');
    }
}
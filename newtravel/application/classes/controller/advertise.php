<?php defined('SYSPATH') or die('No direct script access.');
class Controller_Advertise extends Stourweb_Controller{
    /*
     * 广告总控制器
     * */
    public static $rollAd=array(
        'IndexSpotRollingAd',
        'HotelRollingAd',
        'PerformRollingAd',
        'ProductRollingAd',
        'SelftripRollingAd',
        'SpotRollingAd',
        'SpotSuitAd',
        'IndexRollingAd',
        'LineRollingAd',
        'NewsRollingAd'
        );
    public function before()
    {
        parent::before();
        $action = $this->request->action();
        if($action == 'index')
        {
            $param = $this->params['action'];
            $right = array(
                'read'=>'slook',
                'save'=>'smodify',
                'delete'=>'sdelete',
                'update'=>'smodify'
            );
            $user_action = $right[$param];
            if(!empty($user_action))
                Common::getUserRight('advertise',$user_action);
        }
        if($action == 'add')
        {
            Common::getUserRight('advertise','sadd');
        }
        if($action == 'edit')
        {
            Common::getUserRight('advertise','smodify');
        }
        if($action == 'ajax_save')
        {
            Common::getUserRight('advertise','smodify');
        }
        $this->assign('cmsurl', URL::site());
        $this->assign('parentkey',$this->params['parentkey']);
        $this->assign('itemid',$this->params['itemid']);
        $this->assign('weblist',Common::getWebList());

    }

    public function action_index()
    {

        $action=$this->params['action'];
        if(empty($action))  //显示列表
        {
            $this->display('stourtravel/advertise/list');
        }
        else if($action=='read')    //读取列表
        {
            $start=Arr::get($_GET,'start');
            $limit=Arr::get($_GET,'limit');
            $keyword=Arr::get($_GET,'keyword');
            $webid = Arr::get($_GET,'webid');
            $adtype = Arr::get($_GET,'adtype');
            $sort=json_decode(Arr::get($_GET,'sort'),true);

            $order='order by a.addtime desc';
            if($sort[0]['property'])
            {
                if($sort[0]['property']=='displayorder')
                    $prefix='';
                $order='order by '.$prefix.$sort[0]['property'].' '.$sort[0]['direction'].',a.addtime desc';
            }
            $w = "where a.id is not null";
            if(!empty($keyword))
            {
                $w .=" and (a.adposition like '%{$keyword}%' or a.linktext like '%{$keyword}%' or a.tagname like '%{$keyword}%')";
            }
            $w.=!empty($webid) ? " and a.webid=$webid" : '';
            $w.=!empty($adtype) ? " and a.adtype=$adtype" : '';

            $sql="select a.*,ifnull(a.displayorder,9999) as displayorder  from sline_advertise as a $w $order limit $start,$limit";
            //echo $sql;


            $totalcount_arr=DB::query(Database::SELECT,"select count(*) as num from sline_advertise a $w ")->execute()->as_array();
            $list=DB::query(Database::SELECT,$sql)->execute()->as_array();
            $new_list=array();
            foreach($list as $k=>$v)
            {

                $new_list[] = $v;
            }
            $result['total']=$totalcount_arr[0]['num'];
            $result['lists']=$new_list;
            $result['success']=true;

            echo json_encode($result);
        }
        else if($action=='save')   //保存字段
        {

        }
        else if($action=='delete') //删除某个记录
        {
            $rawdata=file_get_contents('php://input');
            $data=json_decode($rawdata);
            $id=$data->id;

            if(is_numeric($id)) //
            {
                $model=ORM::factory('advertise',$id);
                $model->delete();
            }
        }
        else if($action=='update')//更新某个字段
        {
            $id=Arr::get($_POST,'id');
            $field=Arr::get($_POST,'field');
            $val=Arr::get($_POST,'val');

            if(is_numeric($id))
            {
                $model=ORM::factory('advertise')->where('id','=',$id)->find();

            }

            if($model->id)
            {
                $model->$field=$val;

                $model->update();
                if($model->saved())
                    echo 'ok';
                else
                    echo 'no';
            }
        }
    }

    /*
     * 添加广告
     * */
    public function action_add()
    {
        $this->assign('action','add');
        $this->assign('position','添加广告');
        $this->display('stourtravel/advertise/edit');

    }
    /*
     * 修改广告
     * */
    public function action_edit()
    {
        $id = $this->params['id'];
        $info = ORM::factory('advertise',$id)->as_array();
        $this->assign('info',$info);
        $this->assign('action','edit');
        $this->assign('position','修改广告');
        $this->display('stourtravel/advertise/edit');

    }

    /*
     * ajax保存广告
     * */
    public function action_ajax_save()
    {
        $action = Arr::get($_POST,'action');//当前操作
        $id = Arr::get($_POST,'id');
        $status = false;
        $adwidth = Arr::get($_POST,'adwidth');
        $adheight = Arr::get($_POST,'adheight');
        $linkurl = Arr::get($_POST,'linkurl');
        $linktext = Arr::get($_POST,'linktext');
        $adposition = Arr::get($_POST,'adposition');
        $webid = Arr::get($_POST,'webid');
        $m = new Model_Advertise();

        //如果不是轮播,则删除以前的.
        if(!in_array($adposition,self::$rollAd))
        {
            //$m->deleteRepeat($webid,$adposition);
        }

        //添加操作
        if($action == 'add' && empty($id))
        {

            $model = ORM::factory('advertise');
            $model->addtime = time();


        }
        else
        {
            $model = ORM::factory('advertise')->where('id','=',$id)->find();



        }
        $model->webid = Arr::get($_POST,'webid');
        $model->picurl = Arr::get($_POST,'litpic');
        $model->linktext = $linktext;
        $model->linkurl = $linkurl;
        $model->adtype = Arr::get($_POST,'adtype');
        $model->adposition = Arr::get($_POST,'adposition');
        $model->tagname = Arr::get($_POST,'tagname');
        $picurl = BASEPATH. Arr::get($_POST,'litpic');
        $imginfo=getimagesize($picurl);
        $height=$imginfo[1];//获取高度
        $width=$imginfo[0];//获取宽度.


        if($adwidth!="")
        {
            $width=((intval($width)> intval($adwidth))&& $adwidth!=0) ? $adwidth : $width;
            $adwidth="width=\"".$width."\"";
        }

        if($adheight!="")
        {
            $height=((intval($height)> intval($adheight)) && $adheight!=0) ? $adheight : $height;
            $adheight="height=\"".$height."\"";
        }


        $weburl=Common::getWebUrl();//获取站点url
        $imageurl=$weburl.Arr::get($_POST,'litpic');
        $normalbody="<a href='$linkurl' style=\"margin-bottom:10px;\" class=\"fl clearfix\">"."<img src=\"$imageurl\" alt=\"{$linktext}\" {$adwidth} {$adheight} />"."</a>";

        $model->normalbody = $normalbody;

        if($action=='add' && empty($id))
        {
            $model->create();
        }
        else
        {
            $model->update();
        }

        if($model->saved())
        {
            if($action=='add')
            {
                $productid = $model->id; //插入的产品id

            }
            else
            {
                $productid =null;
            }

            $status = true;
        }
        echo json_encode(array('status'=>$status,'productid'=>$productid));
    }


    /*
     * 广告位管理
     * */
    public function action_config()
    {



        $action=$this->params['action'];
        if(empty($action))  //显示列表
        {
            $this->display('stourtravel/advertise/config_list');
        }
        else if($action=='read')    //读取列表
        {
            $start=Arr::get($_GET,'start');
            $limit=Arr::get($_GET,'limit');
            $keyword=Arr::get($_GET,'keyword');


            if(!empty($keyword))
            {
                $w =" where (a.position like '%{$keyword}%'  or a.tagname like '%{$keyword}%')";
            }


            $sql="select a.*  from sline_advertise_type as a $w order by a.position asc  limit $start,$limit";


            $totalcount_arr=DB::query(Database::SELECT,"select count(*) as num from sline_advertise_type a {$w} ")->execute()->as_array();
            $list=DB::query(Database::SELECT,$sql)->execute()->as_array();
            $new_list=array();
            foreach($list as $k=>$v)
            {

                $new_list[] = $v;
            }
            $result['total']=$totalcount_arr[0]['num'];
            $result['lists']=$new_list;
            $result['success']=true;

            echo json_encode($result);
        }
        else if($action=='save')   //保存字段
        {

        }
        else if($action=='delete') //删除某个记录
        {
            $rawdata=file_get_contents('php://input');
            $data=json_decode($rawdata);
            $id=$data->id;

            if(is_numeric($id)) //
            {
                $model=ORM::factory('advertise_type',$id);
                $model->delete();
            }
        }
        else if($action=='update')//更新某个字段
        {
            $id=Arr::get($_POST,'id');
            $field=Arr::get($_POST,'field');
            $val=Arr::get($_POST,'val');

            if(is_numeric($id))
            {
                $model=ORM::factory('advertise_type')->where('id','=',$id)->find();

            }

            if($model->id)
            {
                $model->$field=$val;

                $model->update();
                if($model->saved())
                    echo 'ok';
                else
                    echo 'no';
            }
        }

    }

    /*
    * 添加广告位
    * */
    public function action_config_add()
    {
        $this->assign('action','add');
        $this->display('stourtravel/advertise/config_edit');
    }
    /*
     * 修改广告位
     * */
    public function action_config_edit()
    {
        $id = $this->params['id'];//会员id.
        $this->assign('action','edit');
        $info = ORM::factory('advertise_type',$id)->as_array();
        $this->assign('info',$info);
        $this->display('stourtravel/advertise/config_edit');
    }

    /*
     * 添加广告位保存
     * */
    public function action_ajax_addconfig_save()
    {
        $action = Arr::get($_POST,'action');//当前操作
        $id = Arr::get($_POST,'id');

        $status = false;


        //添加操作
        if($action == 'add' && empty($id))
        {
            $model = ORM::factory('advertise_type');
            $model->addtime = time();

        }
        else
        {
            $model = ORM::factory('advertise_type')->where('id','=',$id)->find();
        }
        $model->position = Arr::get($_POST,'position');
        $model->tagname = Arr::get($_POST,'tagname');
        $model->width = Arr::get($_POST,'width') ? Arr::get($_POST,'width') : 0;
        $model->height = Arr::get($_POST,'height') ? Arr::get($_POST,'height') : 0;
        $model->type = Arr::get($_POST,'type');
        $model->webid = Arr::get($_POST,'webid');

        if($action=='add' && empty($id))
        {

            $model->create();
        }
        else
        {
            $model->update();
        }

        if($model->saved())
        {
            if($action=='add')
            {
                $productid = $model->id;

            }
            else
            {
                $productid =null;
            }

            $status = true;
        }
        echo json_encode(array('status'=>$status,'productid'=>$productid));
    }

    /*
    * ajax检测是否存在
    * */
    public function action_ajax_check()
    {
        $field = $this->params['type'];

        $val = Arr::get($_POST,'val');//值
        $id = Arr::get($_POST,'id');


        $flag = Model_Advertise_Type::checkExist($field,$val,$id);
        echo $flag;
    }

    /*
     * 获取广告位置列表
     * */
    public function action_ajax_getadpostion()
    {
        $adtype = Arr::get($_POST,'adtype');

        $model = ORM::factory('advertise_type');

        if(!empty($adtype)) $model->where('type','=',$adtype);

        $arr = $model->get_all();



        echo json_encode($arr);

    }

    public function genNormalBody()
    {

    }




}
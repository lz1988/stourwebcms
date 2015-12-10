<?php defined('SYSPATH') or die('No direct script access.');
class Controller_Module extends Stourweb_Controller{

    //右模块控制器
    public function before()
    {
        parent::before();
        $action = $this->request->action();

        if($action == 'store')
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
                Common::getUserRight('module',$user_action);


        }
        if($action == 'index')
        {
            Common::getUserRight('module','slook');
        }
        if($action == 'list')
        {
            Common::getUserRight('module','slook');
        }
        if($action == 'add')
        {
            Common::getUserRight('module','smodify');
        }
        if($action == 'ajax_add_save' || $action=='ajax_edit_save')
        {
            Common::getUserRight('module','smodify');
        }
        $this->assign('parentkey',$this->params['parentkey']);
        $this->assign('itemid',$this->params['itemid']);
        $weblist = Common::getWebList();
        $this->assign('weblist',$weblist);
    }

    /*
     * 模块设置页
     * */
	public function action_index()
	{
        //$addmodule = ORM::factory('model')->where("id>13")->get_all();
        $addmodule = Model_Model::getAllModule();
        $this->assign('addmodule',$addmodule);
        $this->display('stourtravel/module/index');
	}

    /*
     * 模块列表
     * */
    public function action_list()
    {
        $this->display('stourtravel/module/list');
    }
    /*
     * store操作
     * */
    public function action_store()
    {
        $action=$this->params['action'];
        if(empty($action))  //显示线路列表页
        {
            $this->display('stourtravel/module/list');
        }
        else if($action=='read')    //读取列表
        {
            $start=Arr::get($_GET,'start');
            $limit=Arr::get($_GET,'limit');
            $webid=Arr::get($_GET,'webid');
            $keyword=Arr::get($_GET,'keyword');
            $w = "where id is not null";
            $w.=!empty($keyword) ? " and modulename like '%$keyword%'" : ''  ;
            $w.=$webid==-1 ? "" : " and webid='$webid'";

            $sql = "select a.id,a.aid,a.modulename,a.webid,a.issystem from sline_module_list a $w order by a.modulename asc limit $start,$limit";

            $totalcount_arr=DB::query(Database::SELECT,"select count(*) as num from sline_module_list a $w")->execute()->as_array();
            $list=DB::query(Database::SELECT,$sql)->execute()->as_array();
            $new_list=array();
            foreach($list as $k=>$v)
            {
                $new_list[]=$v;
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
            //$rawdata=file_get_contents('php://input');
            //$data=json_decode($rawdata);
           // $id=$data->id;
            $id = ARR::get($_GET,'id');

            if(is_numeric($id)) //
            {
                $model=ORM::factory('module_list',$id);
                $model->delete();

            }
        }

    }

    /*
     * 添加模块
     * */
    public function action_add()
    {
        $webid = $this->params['webid'];
        $this->assign('webid',$webid);
        $this->assign('action','ajax_add_save');
        $this->display('stourtravel/module/edit');
    }
    /*
     * 添加模块保存
     * */
    public function action_ajax_add_save()
    {
        $webid = ARR::get($_POST,'webid');
        $model = ORM::factory('module_list');
        $model->modulename = ARR::get($_POST,'modulename');
        $model->body = ARR::get($_POST,'body');
        $model->webid = $webid;
        $model->aid = Common::getLastAid('sline_module_list',$webid);
        $model->create();
        $flag = false;
        if($model->saved())
        {
           $flag = true;
        }
        echo json_encode(array('status'=>$flag));
    }

    /*
     * 模块修改页面
     * */
    public function action_edit()
    {
        $id = $this->params['id'];
        $info = ORM::factory('module_list',$id)->as_array();
        $this->assign('info',$info);
        $this->assign('action','ajax_edit_save');
        $this->display('stourtravel/module/edit');
    }
    /*
     * 模块修改保存
     * */
    public function action_ajax_edit_save()
    {
        $articleid = ARR::get($_POST,'articleid');
        $model = ORM::factory('module_list',$articleid);
        $model->modulename = ARR::get($_POST,'modulename');
        $model->body = ARR::get($_POST,'body');
        $model->update();
        $flag = false;
        if($model->saved())
        {
            $flag = true;
        }
        echo json_encode(array('status'=>$flag));
    }
    /*
     * 获取页面
     * */

    public function action_ajax_getpagelist()
    {
        $webid = ARR::get($_POST,'webid');

        $typeid = ARR::get($_POST,'typeid');
        $model = new Model_Module_Config();
        $arr = $model->getPageList($webid,$typeid);
        echo json_encode($arr);
    }
    /*
     * 获取选择的模块列表
     * */
    public function action_ajax_getselect()
    {
        $webid = Arr::get($_POST,'webid');
        $pageid = Arr::get($_POST,'aid');
        $model = new Model_Module_Config();
        $arr = $model->getSelectItem($pageid,$webid);
        $out = array();
        $out['selectlist'] = $arr;
        $out['pageid'] = $pageid;
        echo json_encode($out);

    }
    /*
     *获取全部模块
     * */
    public function action_ajax_getallmodule()
    {
        $webid = ARR::get($_POST,'webid');
        $arr = ORM::factory('module_list')->where('webid','=',0)->get_all();
        echo json_encode($arr);
    }

    /*
     * 更新排序
     * */
    public function action_ajax_updatesort()
    {
        $webid = ARR::get($_POST,'webid');
        $pageid =ARR::get($_POST,'pageid');
        $orderlist = ARR::get($_POST,'orderlist');
        $model = ORM::factory('module_config')->where('webid','=',$webid)
                                              ->and_where('aid','=',$pageid)
                                              ->find();
        $model->moduleids = $orderlist;
        $model->save();
        echo $model->saved();


    }

}
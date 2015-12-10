<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Created by PhpStorm.
 * User: netman
 * QQ: 87482723
 * Time: 15-1-26 下午7:53
 * @description:模型管理控制器
 */
class Controller_Model extends Stourweb_Controller{

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
            {
                Common::getUserRight('model',$user_action);
            }
        }
        if($action == 'list')
        {
            Common::getUserRight('model','slook');
        }
        if($action == 'add')
        {
            Common::getUserRight('model','smodify');
        }
        if($action == 'ajax_add_save' || $action=='ajax_edit_save')
        {
            Common::getUserRight('model','smodify');
        }
        $this->assign('parentkey',$this->params['parentkey']);
        $this->assign('itemid',$this->params['itemid']);


    }
    public function action_index()
    {
        $action=$this->params['action'];
        if(empty($action))  //列表
        {
            $this->display('stourtravel/model/list');
        }
        else if($action=='read')    //读取列表
        {
            $start=Arr::get($_GET,'start');
            $limit=Arr::get($_GET,'limit');

            $sql = "select a.* from sline_model a order by a.modulename asc limit $start,$limit";

            $total=DB::query(Database::SELECT,$sql)->execute();

            $list=DB::query(Database::SELECT,$sql)->execute()->as_array();
            $new_list=array();
            foreach($list as $k=>$v)
            {
                $new_list[]=$v;
            }
            $result['total']=$total->count();
            $result['lists']=$new_list;
            $result['success']=true;

            echo json_encode($result);
        }
        else if($action=='save')   //保存字段
        {


        }
        else if($action=='update')
        {
            $id=Arr::get($_POST,'id');
            $field=Arr::get($_POST,'field');
            $val=Arr::get($_POST,'val');
            $kindid=Arr::get($_POST,'kindid');
            $model=ORM::factory('model',$id);
            if($model->id)
            {
                $model->$field=$val;
                $model->save();
                if($field=='isopen')
                {
                    Model_Model::updateNav($id,$val);
                }
                if($model->saved())
                    echo 'ok';
                else
                    echo 'no';
            }



        }
        else if($action=='delete') //删除某个记录
        {
            $rawdata=file_get_contents('php://input');
            $data=json_decode($rawdata);
            $id=$data->id;

            if(is_numeric($id))
            {
                $typdinfo=ORM::factory('model',$id);

                if($typdinfo->loaded())
                {
                    Model_Model::deleteModel($typdinfo);
                }
            }
        }

    }

    /*
     * 添加模型
     * */
    public function action_add()
    {
       $this->display('stourtravel/model/edit');
    }
    /*
     * 拼音检查是否重复
     * */
    public function action_ajax_pinyin_check()
    {
        $py = Arr::get($_POST,'pinyin');
        $model = ORM::factory('model')->where("pinyin='$py'")->find();
        if(!isset($model->id))//没有找到就通过
        {
            $flag = 'true';
        }
        echo $flag;

    }

    /*
     * 模型保存
     * */
    public function action_ajax_model_save()
    {
        $arr = array(
            'modulename'=>Arr::get($_POST,'modulename'),
            'pinyin'=>Arr::get($_POST,'pinyin')
        );
        $status = Model_Model::createModel($arr);
        echo json_encode(array('status'=>$status));
    }






}


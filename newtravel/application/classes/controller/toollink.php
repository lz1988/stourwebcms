<?php defined('SYSPATH') or die('No direct script access.');
class Controller_Toollink extends Stourweb_Controller{

    /*
     * 智能链接控制器
     *
     */
    private $link = null;
    public function before()
    {
        parent::before();
        $this->assign('parentkey',$this->params['parentkey']);
        $this->assign('itemid',$this->params['itemid']);
        $this->link =  new Model_Tool_Link;


    }

    public function action_index()
    {
        $action=$this->params['action'];
        if(empty($action))  //显示列表
        {
            $this->display('stourtravel/tools/link_list');
        }
        else if($action=='read')    //读取列表
        {
            $start=Arr::get($_GET,'start');
            $limit=Arr::get($_GET,'limit');
            $keyword=Arr::get($_GET,'keyword');
            $keywordtype = ARR::get($_GET,'keywordtype');

            $order='order by a.addtime desc';
            $w = "where a.id is not null";

            if(!empty($keyword))
            {
                $w.=" and a.title like '%{$keyword}%'";
            }
            //关键词类型
            if(!empty($keywordtype))
            {
                $w.=" and type='{$keywordtype}'";
            }


            $sql="select a.*  from sline_tool_link as a $w $order limit $start,$limit";
            //echo $sql;


            $totalcount_arr=DB::query(Database::SELECT,"select count(*) as num from sline_tool_link a ")->execute()->as_array();
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
                $model=ORM::factory('tool_link',$id);
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
                $model=ORM::factory('tool_link')->where('id','=',$id)->find();

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
     * 添加
     * */
    public function action_add()
    {
        $this->assign('action','add');
        $this->display('stourtravel/tools/link_edit');
    }
    /*
     * 修改
     * */
    public function action_edit()
    {
        $id = $this->params['id'];//会员id.
        $this->assign('action','edit');
        $info = ORM::factory('tool_link',$id)->as_array();
        $this->assign('info',$info);
        $this->display('stourtravel/tools/edit');
    }
    /*
     * 保存
     * */
    public function action_ajax_save()
    {
        $action = ARR::get($_POST,'action');//当前操作
        $id = ARR::get($_POST,'id');

        $status = false;


        //添加操作
        if($action == 'add' && empty($id))
        {
            $model = ORM::factory('tool_link');
            $model->addtime = time();

        }
        else
        {
            $model = ORM::factory('tool_link')->where('id','=',$id)->find();

        }

        $model->title = ARR::get($_POST,'title');
        $model->type = ARR::get($_POST,'type');
        $model->linkurl = ARR::get($_POST,'linkurl');


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
     * 生成页面
     * */
    public function action_gen()
    {
        $this->display('stourtravel/tools/link_gen');
    }

    /*
     * 获取数量
     * */

    public function action_gettotal()
    {
        set_time_limit(0);

        $channel = ARR::get($_POST,'channel');



        $total = $this->link->getTotalNum($channel);

        $this->link->clearKeywordLink($channel);

        echo json_encode(array('total'=>$total));
    }
    /*
     * 分段执行
     * */
    public function action_mutido()
    {
        $keywordtype = Arr::get($_POST,'keywordtype');
        $channel = Arr::get($_POST,'channel');
        $offset = Arr::get($_POST,'offset');

        $flag = $this->link->keywordReplace($keywordtype,$channel,$offset);
        echo json_encode(array('offset'=>10));

    }


    /*
    * ajax检测是否存在
    * */
    public function action_ajax_check()
    {
        $field = $this->params['type'];
        $val = ARR::get($_POST,'val');//值
        $id = ARR::get($_POST,'id');//会员id

        $flag = Model_Tool_Link::checkExist($field,$val,$id);
        echo $flag;
    }



}
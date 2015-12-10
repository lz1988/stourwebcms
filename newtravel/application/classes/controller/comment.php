<?php defined('SYSPATH') or die('No direct script access.');
class Controller_Comment extends Stourweb_Controller{

    /*
     * 评论总控制器
     * @author:netman
     * @data:2014-07-22
     * */

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
                Common::getUserRight('pinlun',$user_action);


        }
        else if($action == 'view')
        {
            Common::getUserRight('pinlun','sadd');
        }
        else if($action == 'ajax_save')
        {
            Common::getUserRight('pinlun','smodify');
        }
        $this->assign('parentkey',$this->params['parentkey']);
        $this->assign('itemid',$this->params['itemid']);

    }
    public function action_index()
    {



        $action=$this->params['action'];
        if(empty($action))  //显示问答列表
        {
            $this->display('stourtravel/comment/list');
        }
        else if($action=='read')    //读取列表
        {
            $start=Arr::get($_GET,'start');
            $limit=Arr::get($_GET,'limit');
            $keyword=Arr::get($_GET,'keyword');

            $order='order by a.addtime desc';


            $sql="select a.*  from sline_comment as a  $order limit $start,$limit";
            //echo $sql;


            $totalcount_arr=DB::query(Database::SELECT,"select count(*) as num from sline_comment a ")->execute()->as_array();
            $list=DB::query(Database::SELECT,$sql)->execute()->as_array();
            $new_list=array();
            foreach($list as $k=>$v)
            {

                $v['productname'] = ORM::factory('question')->getProductName($v['articleid'],$v['typeid']);
                $v['nickname'] = Model_Comment::getMemberName($v['memberid']);
                $v['modulename'] = Model_Comment::getPinlunModule($v['typeid']);
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
                $model=ORM::factory('comment',$id);
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
                $model=ORM::factory('comment',$id);
            }
            if($model->id)
            {
                $model->$field=$val;
                $model->save();
                if($model->saved())
                    echo 'ok';
                else
                    echo 'no';
            }
        }

    }





}
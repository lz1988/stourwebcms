<?php defined('SYSPATH') or die('No direct script access.');
class Controller_Hotsearch extends Stourweb_Controller{

    /*
     * 热搜词总控制器
     *
     */
    public function before()
    {
        parent::before();
        $this->assign('parentkey',$this->params['parentkey']);
        $this->assign('itemid',$this->params['itemid']);

    }

    public function action_index()
    {
        $action=$this->params['action'];
        if(empty($action))  //显示列表
        {
            $this->display('stourtravel/tools/hotsearch_list');
        }
        else if($action=='read')    //读取列表
        {
            $start=Arr::get($_GET,'start');
            $limit=Arr::get($_GET,'limit');
            $keyword=Arr::get($_GET,'keyword');

            $order='order by a.displayorder asc';

            if(!empty($keyword))
            {
                $w ="where a.keyword like '%{$keyword}%'";
            }


            $sql="select a.*  from sline_search_keyword as a $w $order limit $start,$limit";
            //echo $sql;


            $totalcount_arr=DB::query(Database::SELECT,"select count(*) as num from sline_search_keyword a ")->execute()->as_array();
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
                $model=ORM::factory('search_keyword',$id);
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
                $model=ORM::factory('search_keyword')->where('id','=',$id)->find();

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




}
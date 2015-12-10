<?php defined('SYSPATH') or die('No direct script access.');
class Controller_Tagword extends Stourweb_Controller{

    /*
     * tag词管理总控制器
     *
     */

    private $channelArr = array(
        '1'=>array('channelname'=>'线路','table'=>'sline_line','typeid'=>1,'fieldname'=>'title'),
        '2'=>array('channelname'=>'酒店','table'=>'sline_hotel','typeid'=>2,'fieldname'=>'title'),
        '3'=>array('channelname'=>'租车','table'=>'sline_car','typeid'=>3,'fieldname'=>'title'),
        '4'=>array('channelname'=>'攻略','table'=>'sline_article','typeid'=>4,'fieldname'=>'title'),
        '5'=>array('channelname'=>'景点','table'=>'sline_spot','typeid'=>5,'fieldname'=>'title'),
        '6'=>array('channelname'=>'相册','table'=>'sline_photo','typeid'=>6,'fieldname'=>'title'),
        '8'=>array('channelname'=>'签证','table'=>'sline_visa','typeid'=>8,'fieldname'=>'title'),
        '13'=>array('channelname'=>'团购','table'=>'sline_tuan','typeid'=>12,'fieldname'=>'title'),
    );
    public function before()
    {
        parent::before();
        $this->assign('parentkey',$this->params['parentkey']);
        $this->assign('itemid',$this->params['itemid']);
        $this->assign('channelArr',json_encode($this->channelArr));


    }

    public function action_index()
    {
        $action=$this->params['action'];

        if(empty($action))  //显示列表
        {
            $this->display('stourtravel/tools/tagword_list');
        }
        else if($action=='read')    //读取列表
        {
            $start=Arr::get($_GET,'start');
            $limit=Arr::get($_GET,'limit');
            $keyword=ARR::get($_GET,'keyword');
            $channelid = ARR::get($_GET,'channelid');
            $channelid = empty($channelid) ? 1 : $channelid;
            $type = ARR::get($_GET,'type');
            $type = empty($type) ? 0 : $type;


            $fieldname = $this->channelArr[$channelid]['fieldname'];

            $tablename = $this->channelArr[$channelid]['table'];
            $w = "where id > 0 ";
            $w.= $type ? "and (tagword is  NULL or tagword = '')" : "";
            $w.= $keyword ? " and tagword like '%{$keyword}%'" : '';

            $sql="select id, aid, {$fieldname} as title,tagword  from  {$tablename} $w limit $start,$limit";


            $totalcount_arr=DB::query(Database::SELECT,"select count(*) as num  from  {$tablename} $w ")->execute()->as_array();
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

        else if($action=='update')//更新某个字段
        {
            $id=Arr::get($_POST,'id');
            $field=Arr::get($_POST,'field');
            $val=Arr::get($_POST,'val');
            $channelid = $this->params['channelid'];
            $tablename = $this->channelArr[$channelid]['table'];
            $modelname = str_replace('sline_','',$tablename);
            if(is_numeric($id))
            {
                $model=ORM::factory($modelname)->where('id','=',$id)->find();

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
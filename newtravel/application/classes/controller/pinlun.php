<?php defined('SYSPATH') or die('No direct script access.');
class Controller_Pinlun extends Stourweb_Controller{

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
		   $this->display('stourtravel/pinlun/list');
		}
		else if($action=='read')    //读取列表
		{
			$start=Arr::get($_GET,'start');
			$limit=Arr::get($_GET,'limit');
			$keyword=Arr::get($_GET,'keyword');

			$order='order by a.addtime desc';

			$w="a.id is not null";
			$w.=empty($keyword)?'':" and a.title like '%{$keyword}%'";
			$sql="select a.*  from sline_question as a where $w $order limit $start,$limit";
            //echo $sql;


			$totalcount_arr=DB::query(Database::SELECT,"select count(*) as num from sline_question a where $w")->execute()->as_array();
			$list=DB::query(Database::SELECT,$sql)->execute()->as_array();
			$new_list=array();
			foreach($list as $k=>$v)
			{

                $v['productname'] = ORM::factory('question')->getProductName($v['productid'],$v['typeid']);
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
		    $model=ORM::factory('question',$id);
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
					$model=ORM::factory('question',$id);
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

    /*
     * 查看问答
     * */
    public function action_view()
    {
        $id = $this->params['id'];
        $info = ORM::factory('question',$id)->as_array();
        $info['productname'] = ORM::factory('question')->getProductName($info['productid'],$info['typeid']);
        $info['addtime'] = Common::myDate('Y-m-d',$info['addtime']);
        $this->assign('info',$info);
        $this->display('stourtravel/question/show');


    }
    /*
     * 回复问答
     * */
    public function action_ajax_save()
    {
        $flag = false;
        $id = ARR::get($_POST,'questionid');
        $reply = ARR::get($_POST,'replycontent');
        $model = ORM::factory('question',$id);
        if(!empty($reply))
        {
            $model->replytime = time();
            $model->replycontent = $reply;
            $model->update();
            if($model->saved())
            {
                $flag = true;
            }
        }
        echo json_encode(array('status'=>$flag));
    }



    /*
     * 针对数据结构一致公共保存方法
     * @param $factory ,模型
     * @param $data ,data
     * */
    public function commonSave($factory,$data)
    {

        $kindname = ARR::get($data,'kindname');

        $displayorder = ARR::get($data,'displayorder');

        $newname = ARR::get($data,'newname');
        $newdisplayorder = ARR::get($data,'newdisplayorder');

        $id = ARR::get($data,'id');
        for($i=0;isset($kindname[$i]);$i++)
        {
            $obj = ORM::factory($factory)->where('id','=',$id[$i])->find();
            $obj->kindname = $kindname[$i];
            $obj->displayorder = $displayorder[$i];
            $obj->update();
            $obj->clear();
        }
        for($i=0;isset($newname[$i]);$i++)
        {
            $model= ORM::factory($factory);
            $model->kindname = $newname[$i];
            $model->displayorder = $newdisplayorder[$i];
            $model->create();
            $model->clear();
        }

    }
    /*
     * 针对数据结构一致的公共获取数据方法
     * */
    public function commonGetList($factory)
    {
        $model =  ORM::factory($factory);
        $arr = $model->order_by('displayorder','asc')->get_all();

        $out = array();
        foreach($arr as $row)
        {

            $out[] =array('displayorder'=>$row['displayorder'],'kindname'=>$row['kindname'],'id'=>$row['id']);

        }
        return $out;
    }

    /*
     * 公共删除数据方法
     * */
    public function commonDel($factory,$id)
    {
        $model = ORM::factory($factory,$id);
        $model->delete();
        $out = array();
        if(!$model->loaded())
        {
            $out['status'] = true;
        }
        else
        {
            $out['status'] = false;
        }
        return $out;
    }
}
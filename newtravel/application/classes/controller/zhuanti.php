<?php defined('SYSPATH') or die('No direct script access.');
class Controller_Zhuanti  extends Stourweb_Controller{
    public function before()
    {
        parent::before();
        $action = $this->request->action();
        if($action == 'list')
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
                Common::getUserRight('theme',$user_action);


        }
        if($action == 'add')
        {
            Common::getUserRight('theme','sadd');
        }
        if($action == 'edit')
        {
            Common::getUserRight('theme','smodify');
        }
        if($action == 'ajax_save')
        {
            Common::getUserRight('theme','smodify');
        }
        $this->assign('parentkey',$this->params['parentkey']);
        $this->assign('itemid',$this->params['itemid']);
        $this->assign('weblist',Common::getWebList());
        $this->assign('templetlist',Common::getUserTemplteList('zhuanti_show'));//获取上传的用户模板

    }
	public function action_list()
	{
		$action=$this->params['action'];
		if(empty($action))  //显示线路列表页
		{
		    $this->display('stourtravel/zhuanti/list');
		}
		else if($action=='read')    //读取列表
		{
			$start=Arr::get($_GET,'start');
			$limit=Arr::get($_GET,'limit');
            $keyword=Arr::get($_GET,'keyword');
			$sort=json_decode(Arr::get($_GET,'sort'));
			if($sort[0]->property)
			{
				if($sort[0]->property=='displayorder')
				{
					$order='order by displayorder '.$sort[0]->direction;
				}
				else if($sort[0]->property=='addtime')
				{
					$order='order by addtime '.$sort[0]->direction;
				}
			}
			$w="id is not null";
            $w.= !empty($keyword) ? " and ztname like '%$keyword%'" : '';
			$sql="select *,ifnull(displayorder,9999) as displayorder from sline_theme where $w $order limit $start,$limit ";
			$totalcount_arr=DB::query(Database::SELECT,"select count(*) as num from sline_theme  where $w")->execute()->as_array();
			$list=DB::query(Database::SELECT,$sql)->execute()->as_array();
			
			$result['total']=$totalcount_arr[0]['num'];
			$result['lists']=$list;
			$result['success']=true;
			echo json_encode($result);
		}
		else if($action=='save')   //保存字段
		{
		   
		}
		else if($action=='create')
		{
		 
		}
		else if($action=='delete') //删除某个记录
		{
		   
		   $rawdata=file_get_contents('php://input');
		   $data=json_decode($rawdata);
		   $id=$data->id;   
		   if(is_numeric($id)) 
		   {
		    $model=ORM::factory('theme',$id);
		    $model->deleteClear();
		   } 
		}
		else if($action=='update')//更新某个字段
		{
			$id=Arr::get($_POST,'id');
			$field=Arr::get($_POST,'field');
			$val=Arr::get($_POST,'val');
			
			$model=ORM::factory('theme',$id);
			$model->$field=$val;
			$model->save();
			if($model->saved())
			  echo 'ok';
			else
			  echo 'no';  	
		}
	}
	/*
	 *修改专题
	*/
	public function action_edit()
	{
	    $themeid = $this->params['themeid'];
        $this->assign('action','edit');
        $info = ORM::factory('theme',$themeid)->as_array();
        $this->assign('info',$info);
        $this->assign('position','修改专题');
        $this->display('stourtravel/zhuanti/edit');
	}
	
	/*
	*
	*/
	public function action_add()
	{
		$this->assign('action','add');
        $this->assign('position','添加专题');
        $this->display('stourtravel/zhuanti/edit');
	}
	
	public function action_ajax_save()
	{
		$themeid=Arr::get($_POST,'themeid');

        $data_arr=array();
        $data_arr['ztname']=Arr::get($_POST,'ztname');
        $data_arr['shortname']=Arr::get($_POST,'shortname');
        $data_arr['logo']=Arr::get($_POST,'logo');
		$data_arr['bgcolor']=Arr::get($_POST,'bgcolor');
		$data_arr['shownum']=Arr::get($_POST,'shownum')?Arr::get($_POST,'shownum'): 0;
		$data_arr['jieshao']=Arr::get($_POST,'jieshao');
		$data_arr['bgimage']=Arr::get($_POST,'bgimage');
		
        $data_arr['seotitle']=Arr::get($_POST,'seotitle');
        $data_arr['keyword']=Arr::get($_POST,'keyword');
        $data_arr['description']=Arr::get($_POST,'description');

        $data_arr['templet'] = Arr::get($_POST,'templet');

        if($themeid)
        {
            $model=ORM::factory('theme',$themeid);
			$model->modtime=time();
        }
        else
        {
            $model=ORM::factory('theme');
            $model->addtime=time();
			$model->modtime=time();
        }
        foreach($data_arr as $k=>$v)
        {
            $model->$k=$v;
        }
        $model->save();
        if($model->saved())
        {
            $model->reload();
            $id=$model->id;
            echo $id;
        }
        else
            echo 'no';
		
	}
}
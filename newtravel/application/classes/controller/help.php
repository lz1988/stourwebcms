<?php defined('SYSPATH') or die('No direct script access.');
class Controller_Help  extends Stourweb_Controller{
	public $type_arr=array(0=>'首页',14=>'私人定制',12=>'目的地');
    public static $pos_arr=array(0=>'首页',1=>'线路',2=>'酒店',3=>'租车',5=>'景点',6=>'相册',4=>'攻略',8=>'签证',10=>'问答',13=>'团购',12=>'目的地');
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
                Common::getUserRight('help',$user_action);
        }
        else if($action == 'add')
        {
            Common::getUserRight('help','sadd');
        }
        else if($action == 'edit')
        {
            Common::getUserRight('help','smodify');
        }
        else if($action == 'ajax_save')
        {
            Common::getUserRight('help','smodify');
        }
        else if($action == 'kind')
        {
            $op = $this->params['action'];
            if($op == 'add')
            {
                Common::getUserRight('helpattr','sadd');
            }
            else if($op == 'save')
            {
                Common::getUserRight('helpattr','smodify');
            }
            else if($op =='del')
            {
                Common::getUserRight('helpattr','sdelete');
            }
            else
            {
                Common::getUserRight('helpattr','slook');
            }
        }


        $this->assign('parentkey',$this->params['parentkey']);
        $this->assign('itemid',$this->params['itemid']);
        $this->assign('weblist',Common::getWebList());

        $allmodule = ORM::factory('Model')->get_all();
        foreach($allmodule as $item)
        {
            $this->type_arr[$item['id']]=$item['modulename'];
        }
    }
     /*
	文章列表  
	 */
	public function action_list()
	{
		$action=$this->params['action'];
		if(empty($action))  //显示线路列表页
		{
            $posArr=$this->geneHtmlPosarr();
            $this->assign('posArr',$posArr);
            $kindlist=json_encode(ORM::factory('help_kind')->where("webid=0")->get_all());
            $this->assign('kindmenu',Common::getConfig('menu_sub.helpkind'));//分类设置项
			$this->assign('kindlist',$kindlist);
		    $this->display('stourtravel/help/list');
		}
		else if($action=='read')    //读取列表
		{
			$start=Arr::get($_GET,'start');
			$limit=Arr::get($_GET,'limit');
			$keyword=Arr::get($_GET,'keyword');
			$kindid=Arr::get($_GET,'kindid');
			$sort=json_decode(Arr::get($_GET,'sort'),true);
			if($sort[0]['property'])
			{
                //print_r($sort[0]->property);
				if($sort[0]['property']=='displayorder')
				{
					$order='order by displayorder '.$sort[0]['direction'];
				}
				else if($sort[0]['property']=='modtime')
				{
					$order='order by modtime '.$sort[0]['direction'];
				}
			}
            else
            {
                $order = 'order by modtime desc';
            }
			$w="id is not null";
			$w.=empty($keyword)?'':" and title like '%{$keyword}%'";
			$w.=empty($kindid)?'':" and kindid=$kindid";
			$sql="select *,ifnull(displayorder,9999) as displayorder from sline_help where $w $order limit $start,$limit ";
			$totalcount_arr=DB::query(Database::SELECT,"select count(*) as num from sline_help  where $w")->execute()->as_array();
			$list=DB::query(Database::SELECT,$sql)->execute()->as_array();
			foreach($list as $k=>$v)
            {
                $list[$k]['modtime'] = Common::myDate('Y-m-d',$list[$k]['modtime']);
            }

			$result['total']=$totalcount_arr[0]['num'];
			$result['lists']=$list;
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
		   if(is_numeric($id)) 
		   {
		    $model=ORM::factory('help',$id);
		    $model->deleteClear();
		   }
		}
		else if($action=='update')//更新某个字段
		{
			$id=Arr::get($_POST,'id');
			$field=Arr::get($_POST,'field');
			$val=Arr::get($_POST,'val');
			
			$model=ORM::factory('help',$id);
			$model->$field=$val;
			$model->save();
			if($model->saved())
			  echo 'ok';
			else
			  echo 'no';  
			
			
		}

	}
	 /*
     * 添加页面
     * */
    public function action_add()
    {
		$kindlist=ORM::factory('help_kind')->get_all();
		$this->assign('kindlist',$kindlist);
		$this->assign('typearr',$this->type_arr);
        $this->assign('position','添加帮助');
        $this->assign('action','add');
        $this->display('stourtravel/help/edit');
    }
	/*
	 * 编辑页面
	 */
	public function action_edit()
	{
		$helpid=$this->params['helpid'];
		$kindlist=ORM::factory('help_kind')->get_all();	
		$info=ORM::factory('help',$helpid)->as_array();
		$this->assign('typearr',$this->type_arr);
		$this->assign('info',$info);
		$this->assign('kindlist',$kindlist);
		$this->assign('position','修改'.$info['title']);
        $this->assign('action','edit');
        $this->display('stourtravel/help/edit');
	}
	
	/*
	* 保存帮助
	*/
	public function action_ajax_save()
	{
		$helpid=Arr::get($_POST,'helpid');
		
		
		$data_arr=array();
		$data_arr['title']=Arr::get($_POST,'title');
		$data_arr['body']=Arr::get($_POST,'body');
		$data_arr['kindid']=Arr::get($_POST,'kindid');
		$data_arr['type_id']=implode(',',Arr::get($_POST,'typeid'));
		
		if($helpid)
		{
			$model=ORM::factory('help',$helpid);
			$model->modtime=time();
		}
		else
		{
		    $model=ORM::factory('help');
            $model->aid = Common::getLastAid('sline_help',0);
			$model->addtime=time();
			$model->modtime=time();
            $model->webid = 0;
		}
		foreach($data_arr as $k=>$v)
		{
			$model->$k=$v;
		}
		$model->save();
		if($model->saved())
		{
			$model->reload();
			echo $model->id;
		}
		else
		    echo 'no';
		
	}
	/*
	  分类
	*/
	public function action_kind()
	{	
	    $action=$this->params['action'];
        if(empty($action))
        {
			$list=ORM::factory('help_kind')->where("webid=0")->get_all();
			$this->assign('list',$list);
			$this->display('stourtravel/help/kind');
		}
		else if($action=='add')
		{
			$model=ORM::factory('help_kind');
			$model->create();
			echo $model->id;
		}
		else if($action=='save')
		{
			$kindname_arr=Arr::get($_POST,'kindname');
			$displayorder_arr=Arr::get($_POST,'displayorder');
		    $isopen_arr=Arr::get($_POST,'isopen');	
		
            $newkindname_arr=Arr::get($_POST,'newkindname');
			$newdisplayorder_arr=Arr::get($_POST,'newdisplayorder');
			$newisopen_arr=Arr::get($_POST,'newisopen');	

            foreach($kindname_arr as $k=>$v)
            {
                $model=ORM::factory('help_kind',$k);
                if($model->id)
                {
                    $model->kindname=$v;
                    $model->webid = 0;
					$model->displayorder=$displayorder_arr[$k];
					$model->isopen=empty($isopen_arr[$k])?0:1;
                    $model->save();
                }
			}
            foreach($newkindname_arr as $k=>$v)
            {
                $model=ORM::factory('help_kind');
                $model->webid = 0;
                $model->displayorder=$newdisplayorder_arr[$k];
				$model->isopen=empty($newisopen_arr[$k])?0:1;
				$model->kindname=$v;
                $model->save();
            }

            echo 'ok';
		}
		else if($action=='del')
        {
            $id=Arr::get($_POST,'id');
            $model=ORM::factory('help_kind',$id);
            $model->delete();
            echo 'ok';
        }
	}
    public function action_ajax_setkindicon()
    {
        $id=$_POST['id'];
        $img=$_POST['img'];
        $kindModel=ORM::factory('help_kind',$id);

        if($kindModel->loaded())
        {
            $kindModel->litpic=$img;
            $kindModel->save();
        }
        echo json_encode(array('status'=>true,'msg'=>'保存成功'));

    }
    public function action_ajax_delkindicon()
    {
        $id=$_POST['id'];
        $kindModel=ORM::factory('help_kind',$id);

        if($kindModel->loaded())
        {
            $kindModel->litpic='';
            $kindModel->save();
        }
        echo json_encode(array('status'=>true,'msg'=>'保存成功'));
    }
    private function getExtendTypes()
    {
        $list=ORM::factory('model')->where('issystem','=',0)->and_where('pinyin','!=','insurance')->get_all();
        $arr=array();
        foreach($list as $v)
        {
            $arr[$v['id']]=$v['modulename'];
        }
        return $arr;
    }
    private function geneHtmlPosarr(){
        $posArr=self::$pos_arr;
        $extendArr=$this->getExtendTypes();
        $posArr=array_merge($posArr,$extendArr);
        $list=array();
        foreach($posArr as $k=>$v)
        {
            $list['type'.$k]=$v;
        }
        return $list;
    }
}
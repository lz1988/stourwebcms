<?php defined('SYSPATH') or die('No direct script access.');
class Controller_Friendlink  extends Stourweb_Controller{
	public $type_arr=array(1=>'线路',2=>'酒店',3=>'租车',4=>'攻略',5=>'景点',6=>'相册',8=>'签证',10=>'问答',13=>'团购',12=>'目的地');
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
                'update'=>'smodify',
                'create'=>'sadd'
            );
            $user_action = $right[$param];
            if(!empty($user_action))
                Common::getUserRight('flink',$user_action);


        }
        if($action == 'add')
        {
            Common::getUserRight('flink','sadd');
        }
        if($action == 'edit')
        {
            Common::getUserRight('flink','smodify');
        }
        if($action == 'ajax_save')
        {
            Common::getUserRight('flink','smodify');
        }
        $this->assign('parentkey',$this->params['parentkey']);
        $this->assign('itemid',$this->params['itemid']);
        $this->assign('weblist',Common::getWebList());

    }
     /*
	链接列表  
	 */
	public function action_list()
	{
		$action=$this->params['action'];
		if(empty($action))  //显示线路列表页
		{

            $posArr=$this->geneHtmlPosarr();
            $this->assign('posArr',$posArr);
		    $this->display('stourtravel/friendlink/list');
		}
		else if($action=='read')    //读取列表
		{
			$start=Arr::get($_GET,'start');
			$limit=Arr::get($_GET,'limit');
			$kindid=Arr::get($_GET,'typeid');
			$webid=Arr::get($_GET,'webid');
            $webid = empty($webid) ? '-1' : $webid;
            $keyword = Arr::get($_GET,'keyword');
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
            $w.=$webid=='-1' ? '' : " and webid=$webid";
			$w.=empty($typeid)?'':" and find_in_set($typeid,address)";
            $w.=empty($keyword)?'':" and sitename like '%$keyword%'";
			$sql="select *,ifnull(displayorder,9999) as displayorder from sline_yqlj where $w $order limit $start,$limit ";
			$totalcount_arr=DB::query(Database::SELECT,"select count(*) as num from sline_yqlj  where $w")->execute()->as_array();
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
		   $model=ORM::factory('yqlj');
		   $siteurl=Arr::get($_POST,'siteurl');
		   if(strpos($siteurl,'http://')===FALSE)
		      $siteurl='http://'.trim($siteurl);   
		   $model->sitename=Arr::get($_POST,'sitename');
		   $model->siteurl=$siteurl;
		   $model->address="0";
		   $model->webid=Arr::get($_POST,'webid');
		   $model->save();
		   $model->reload();
		   $res=array();
		   $res['success'] = true;
           $res['message'] = "Created new User"; 
           $res['data']=$model->as_array();
		   echo json_encode($res);
		}
		else if($action=='delete') //删除某个记录
		{
		   
		   $rawdata=file_get_contents('php://input');
		   $data=json_decode($rawdata);
		   $id=$data->id;   
		   if(is_numeric($id)) 
		   {
		    $model=ORM::factory('yqlj',$id);
		    $model->delete();
		   }
		   
		}
		else if($action=='update')//更新某个字段
		{
			
			$id=Arr::get($_POST,'id');
			$field=Arr::get($_POST,'field');
			$val=Arr::get($_POST,'val');
			
			$model=ORM::factory('yqlj',$id);
			$model->$field=$val;
			$model->save();
			if($model->saved())
			  echo 'ok';
			else
			  echo 'no';  
			
			
		}

	}
    public function action_dialog_addlink()
    {
        $weblist=Common::getWebList();
        $this->assign('weblist',$weblist);
        $this->display('stourtravel/friendlink/dialog_addlink');
    }
    public function action_dialog_setpos()
    {
        $posArr=self::$pos_arr;
        $id=$_GET['id'];
        $types=$_GET['types'];
        $typeArr=$types!==null&&$types!==''?explode(',',$types):array();
        $extendArr=$this->getExtendTypes();
        foreach($extendArr as $k=>$v)
        {
            $posArr[$k]=$v;
        }
        $this->assign('id',$id);
        $this->assign('typeArr',$typeArr);
        $this->assign('posArr',$posArr);
        $this->display('stourtravel/friendlink/dialog_setpos');
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
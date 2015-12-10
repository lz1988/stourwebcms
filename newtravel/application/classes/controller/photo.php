<?php defined('SYSPATH') or die('No direct script access.');
class Controller_Photo  extends Stourweb_Controller{

     /*
      * 相册总控制器
	 */
    public function before()
    {
        parent::before();
        $action = $this->request->action();

        if($action == 'photo')
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
                Common::getUserRight('photo',$user_action);


        }
        else if($action == 'add')
        {
            Common::getUserRight('photo','sadd');
        }
        else if($action == 'edit')
        {
            Common::getUserRight('photo','smodify');
        }



        else if($action == 'ajax_photosave')
        {
            Common::getUserRight('photo','smodify');
        }

        $this->assign('parentkey',$this->params['parentkey']);
        $this->assign('itemid',$this->params['itemid']);
        $this->assign('weblist',Common::getWebList());

    }
	public function action_photo()
	{
		$action=$this->params['action'];
		if(empty($action))  //显示线路列表页
		{
           $this->assign('kindmenu',Common::getConfig('menu_sub.photokind'));//分类设置项
		   $this->display('stourtravel/photo/list');
		}
		else if($action=='read')    //读取列表
		{
			$start=Arr::get($_GET,'start');
			$limit=Arr::get($_GET,'limit');
			$keyword=Arr::get($_GET,'keyword');
			$kindid=Arr::get($_GET,'kindid');
			$attrid=Arr::get($_GET,'attrid');
			$sort=json_decode(Arr::get($_GET,'sort'),true);
			$order='order by a.modtime desc';
            $webid=Arr::get($_GET,'webid');
            $webid = empty($webid) ? 0 : $webid;
            $keyword = Common::getKeyword($keyword);
            $specOrders=array('attrid','kindlist','iconlist','themelist');
			if($sort[0]['property'])
			{
                if($sort[0]['property']=='displayorder')
                    $prefix='';
                else if($sort[0]['property']=='ishidden')
                {
                    $prefix='a.';
                }
                else if($sort[0]['property']=='modtime')
                {
                    $prefix='a.';
                }
                else if(in_array($sort[0]['property'],$specOrders))
                {
                    $prefix='order_';
                }
                $order='order by '.$prefix.$sort[0]['property'].' '.$sort[0]['direction'].',a.modtime desc';

			}
			$w="a.id is not null";
			$w.=empty($keyword)?'':" and a.title like '%{$keyword}%'";
			$w.=empty($kindid)?'':" and find_in_set($kindid,a.kindlist)";
			$w.=empty($attrid)?'':" and find_in_set($attrid,a.attrid)";
            $w.=$webid=='-1' ? '' : " and a.webid=$webid";
			
			if(empty($kindid))
			{
			   $sql="select a.id,a.aid,a.title,a.litpic,a.headimgid,a.title,a.kindlist,a.attrid,a.webid,a.themelist,if(length(ifnull(a.attrid,''))=0,0,1) as order_attrid,if(length(ifnull(a.kindlist,''))=0,0,1) as order_kindlist,if(length(ifnull(a.themelist,''))=0,0,1) as order_themelist,
a.addtime,a.modtime,a.ishidden,b.isjian,ifnull(b.displayorder,999999) as displayorder,b.isding from sline_photo as a left join sline_allorderlist b on (a.id=b.aid and b.typeid=6) where $w $order limit $start,$limit";
			}
			else
			{
			   $sql="select a.id,a.aid,a.title,a.litpic,a.headimgid,a.title,a.kindlist,a.attrid,a.webid,a.themelist,a.addtime,a.modtime,a.ishidden,b.isjian,if(length(ifnull(a.attrid,''))=0,0,1) as order_attrid,if(length(ifnull(a.kindlist,''))=0,0,1) as order_kindlist,if(length(ifnull(a.themelist,''))=0,0,1) as order_themelist,ifnull(b.displayorder,999999) as displayorder,b.isding from sline_photo as a left join sline_kindorderlist as b on (b.classid=$kindid and a.id=b.aid and b.typeid=6) where $w $order limit $start,$limit";
				
			}
			$totalcount_arr=DB::query(Database::SELECT,"select count(*) as num from sline_photo a where $w")->execute()->as_array();
			$list=DB::query(Database::SELECT,$sql)->execute()->as_array();
		
			$new_list=array();
			foreach($list as $k=>$v)
			{
				
				$v['kindname']=Model_Destinations::getKindnameList($v['kindlist']);
			    $v['attrname']=Model_Article_Attr::getAttrnameList($v['attrid']);
                $v['modtime']=Common::myDate('Y-m-d',$v['modtime']);
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
		   $rawdata=file_get_contents('php://input');
		   $data=json_decode($rawdata);
		   $id=$data->id;
		   
		   if(is_numeric($id)) 
		   {
		    $model=ORM::factory('photo',$id);
		    $model->deleteClear();
		   }
		  
		   
		}
		else if($action=='update')//更新某个字段
		{
			$id=Arr::get($_POST,'id');
			$field=Arr::get($_POST,'field');
			$val=Arr::get($_POST,'val');
			$kindid=Arr::get($_POST,'kindid');
			
			
			if($field=='displayorder')  //如果是排序
			{ 
			    $displayorder=empty($val)?9999:$val;
			    if(is_numeric($id))//
				{
				    if(empty($kindid))  //全局排序
				   {
					 $order=ORM::factory('allorderlist');
					 $order_mod=$order->where("aid='$id' and typeid=6 and webid=0")->find();
					
					 if($order_mod->id)  //如果已经存在
					 {
					   $order_mod->displayorder=$displayorder;
					 }
					 else   //如果这个排序不存在
					 {
						$order_mod->displayorder=$displayorder;
						$order_mod->aid=$id;
						$order_mod->webid=0;
						$order_mod->typeid=6;
					 }
					 $order_mod->save();
					 if($order_mod->saved())
					 {
						 echo 'ok';
					 }
					 else
					     echo 'no';
				   }
				   else  //按目的地排序
				   {
					  $kindorder=ORM::factory('kindorderlist');
					  $kindorder_mod=$kindorder->where("aid='$id' and typeid=6 and classid=$kindid")->find();
					  if($kindorder_mod->id)
					  {
					   $kindorder_mod->displayorder=$displayorder;
					  }
					  else
					  {
						$kindorder_mod->displayorder=$displayorder;
						$kindorder_mod->aid=$id;
						$kindorder_mod->classid=$kindid;
						$kindorder_mod->typeid=6;
					  }
					  $kindorder_mod->save();
					  if($kindorder->saved())
					     echo 'ok';
					  else
					     echo 'no';	  
					   
				   }
				}
				
				
			}
			else  //如果不是排序字段
			{
				if(is_numeric($id))
				{
					$model=ORM::factory('photo',$id);
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
    /*
	*  添加相册
	*/
    public function action_add()
    {
        $weblist=ORM::factory('weblist')->get_all();
        $this->assign('weblist',$weblist);
        $this->assign('webid',0);
        $this->assign('action','add');
        $this->assign('position','添加相册');
        $this->display('stourtravel/photo/edit');

    }
    /*
   * 修改相册
   */
    public function action_edit()
    {
        $weblist=ORM::factory('weblist')->get_all();
        $photoid=$this->params['photoid'];
        $info=ORM::factory('photo',$photoid)->as_array();
        $info['kindlist_arr']=Model_Destinations::getKindlistArr($info['kindlist']);
        $info['attrlist_arr']=Common::getSelectedAttr(6,$info['attrid']);
        $info['piclist_arr'] = json_encode(Model_Photo_Picture::getPicturesByPid($info['id']));//图片数组
        $extendinfo = Common::getExtendInfo(6,$info['id']);
        $this->assign('extendinfo',$extendinfo);//扩展信息

        $this->assign('weblist',$weblist);
        $this->assign('action','edit');
        $this->assign('info',$info);
        $this->assign('position','修改相册'.$info['title']);
        $this->display('stourtravel/photo/edit');
    }
    /*
     *
     * 保存
     */
    public function action_ajax_photosave()
    {
        $photoid=Arr::get($_POST,'photoid');
        $webid = Arr::get($_POST,'webid');
        $kindlist = Arr::get($_POST,'kindlist');
        if($webid!=0)//自动添加子站目的地属性
        {
            if(is_array($kindlist))
            {
                if(!in_array($webid,$kindlist))
                {
                    array_push($kindlist,$webid);
                }
            }
            else
            {
                $kindlist = array($webid);//如果为空则直接加webid
            }

        }
        $data_arr=array();
        $data_arr['title']=Arr::get($_POST,'title');
        $data_arr['attrid']=implode(',',Arr::get($_POST,'attrlist'));
        $data_arr['webid']=Arr::get($_POST,'webid');
        $data_arr['webid']=empty($data_arr['webid'])?0:$data_arr['webid'];
        $data_arr['seotitle']=Arr::get($_POST,'seotitle');
        $data_arr['keyword']=Arr::get($_POST,'keyword');
        $data_arr['description']=Arr::get($_POST,'description');
        $data_arr['kindlist']=implode(',',$kindlist);
        $data_arr['author']=Arr::get($_POST,'author');

        $data_arr['content']=Arr::get($_POST,'content');
        $data_arr['tagword']=Arr::get($_POST,'tagword');
        $data_arr['ishidden'] = Arr::get($_POST,'ishidden')?Arr::get($_POST,'ishidden'):0;//显示隐藏


        if($photoid)
        {
            $model=ORM::factory('photo',$photoid);
            if($model->webid != $data_arr['webid']) //如果更改了webid重新生成aid
            {
                $aid = Common::getLastAid('sline_photo',$data_arr['webid']);
                $model->aid = $aid;
            }
            $model->addtime=time();
        }
        else
        {
            $model=ORM::factory('photo');
            $model->aid=Common::getLastAid('sline_photo',$data_arr['webid']);
            $model->modtime=time();
        }
        foreach($data_arr as $k=>$v)
        {
            $model->$k=$v;
        }
        $model->save();
        Common::saveExtendData(6,$photoid,$_POST);//扩展信息保存
        if($model->saved())
        {
            $model->reload();
            $id=$model->id;
            $webid=$model->webid;

            //图片处理
            $org_images=ORM::factory('photo_picture')->where("pid=$id")->find_all()->as_array();
            foreach($org_images as $v)
            {
                $v->delete();
            }

            $images_arr=Arr::get($_POST,'images');
            $imagestitle_arr=Arr::get($_POST,'imagestitle');
            $headimgindex=Arr::get($_POST,'imgheadindex');
            foreach($images_arr as $k=>$v)
            {
                $picture=ORM::factory('photo_picture');
                $picture->pid=$id;
                $picture->litpic=$v;
                $picture->description=$imagestitle_arr[$k];
                $picture->save();
                if($headimgindex==$k)
                {
                    $model->litpic=$v;
                    $model->save();
                }
            }




            echo $id;
        }
        else
            echo 'no';
    }
	

}
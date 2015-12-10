<?php defined('SYSPATH') or die('No direct script access.');
class Controller_Jieban extends Stourweb_Controller{
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
                Common::getUserRight('jieban',$user_action);


        }

        $status = array(
            array('status'=>0,'statusname'=>'未审核'),
            array('status'=>1,'statusname'=>'已开启'),
            array('status'=>2,'statusname'=>'已成团')
        );

        $this->assign('parentkey',$this->params['parentkey']);
        $this->assign('itemid',$this->params['itemid']);
        $this->assign('typeid',11);
        $this->assign('statuslist',json_encode($status));


    }
     /*
	结伴列表
	 */
	public function action_index()
	{
		$action=$this->params['action'];
        $typeid = 11;
		if(empty($action))  //显示线路列表页
		{
           $this->assign('kindmenu',Common::getConfig('menu_sub.jiebankind'));//分类设置项
		   $this->display('stourtravel/jieban/list');
		}
		else if($action=='read')    //读取列表
		{
			$start=Arr::get($_GET,'start');
			$limit=Arr::get($_GET,'limit');
			$kindid=Arr::get($_GET,'kindid');
			$attrid=Arr::get($_GET,'attrid');

			$sort=json_decode(Arr::get($_GET,'sort'),true);
			$order='order by a.addtime desc';
            $specOrders=array('attrid','kindlist','iconlist','themelist');
			if($sort[0]['property'])
			{
                if($sort[0]['property']=='displayorder')
                    $prefix='';
                else if($sort[0]['property']=='ishidden')
                {
                    $prefix='a.';
                }
                else if(in_array($sort[0]['property'],$specOrders))
                {
                    $prefix='order_';
                }
                $order='order by '.$prefix.$sort[0]['property'].' '.$sort[0]['direction'].',a.addtime desc';
			}
			$w="a.id is not null";
			$w.=empty($kindid)?'':" and find_in_set($kindid,a.kindlist)";
			$w.=empty($attrid)?'':" and find_in_set($attrid,a.attrid)";


			$sql="select a.*,if(length(ifnull(a.attrid,''))=0,0,1) as order_attrid,if(length(ifnull(a.kindlist,''))=0,0,1) as order_kindlist,if(length(ifnull(a.iconlist,''))=0,0,1) as order_iconlist,ifnull(b.displayorder,9999) as displayorder from sline_jieban as a left join sline_allorderlist b on (a.id=b.aid and b.typeid=$typeid)  where $w $order limit $start,$limit";


			$totalcount_arr=DB::query(Database::SELECT,"select count(*) as num from sline_jieban a where $w")->execute()->as_array();
			$list=DB::query(Database::SELECT,$sql)->execute()->as_array();
			$new_list=array();
			foreach($list as $k=>$v)
			{
				$v['kindname']=Model_Destinations::getKindnameList($v['kindlist']);
			    $v['attrname']=Model_Jieban_Attr::getAttrnameList($v['attrid']);
                $v['title']= Model_Jieban::genTitle($v,$v['day']);
                $memberinfo = ORM::factory('member',$v['memberid'])->as_array();
                $v['membername'] = $memberinfo['nickname'];
                $v['membermobile'] = $memberinfo['mobile'];
                $v['joinnum'] = Model_Jieban::getJoinNum($v['id']);

                $iconname = Model_Icon::getIconName($v['iconlist']);
                $name = '';
                foreach($iconname as $icon)
                {
                    if(!empty($icon))
                        $name.='<span style="color:red">['.$icon.']</span>';
                }

                $v['iconname'] = $name;

                $v['series'] = Common::getSeries($v['id'],$typeid);//编号
                $v['addtime'] = Common::myDate('Y-m-d',$v['addtime']);

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
		   
		   if(is_numeric($id)) //租车
		   {
		    $model=ORM::factory('jieban',$id);
		    $model->delete();
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
			    if(is_numeric($id))//如果是景点
				{
				    if(empty($kindid))  //全局排序
				   {
					 $order=ORM::factory('allorderlist');
					 $order_mod=$order->where("aid='$id' and typeid=$typeid and webid=0")->find();
					
					 if($order_mod->id)  //如果已经存在
					 {
					   $order_mod->displayorder=$displayorder;
					 }
					 else   //如果这个排序不存在
					 {
						$order_mod->displayorder=$displayorder;
						$order_mod->aid=$id;
						$order_mod->webid=0;
						$order_mod->typeid=11;
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

				   }
				}
				
			}
			else  //如果不是排序字段
			{
				if(is_numeric($id))
				{
					$model=ORM::factory('jieban',$id);
				}
				if($model->id)
				{
                    $model->$field=$val;
                    if($field=='kindlist') {
                        $model->$field = implode(',', Model_Destinations::getParentsStr($val));
                    }
                    else if($field=='attrid')
                    {
                        $model->$field=implode(',',Model_Attrlist::getParentsStr($val,11));
                    }
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
   * 修改团购
   */
    public function action_view()
    {
        $jiebanid=$this->params['id'];
        $info=ORM::factory('jieban',$jiebanid)->as_array();
        $info['destlist']=Model_Destinations::getKindnameList($info['kindlist']);
        $info['attrname']=Model_Spot_Attr::getAttrnameList($info['attrid']);
        $info['title']= Model_Jieban::genTitle($info,$info['day']);
        $memberinfo = ORM::factory('member',$info['memberid'])->as_array();
        $info['membername'] = $memberinfo['nickname'];
        $info['membermobile'] = $memberinfo['mobile'];
        $info['joinnum'] = Model_Jieban::getJoinNum($jiebanid);
        $info['joinlist'] = ORM::factory('jieban_join')->where("jiebanid=".$info['id'])->get_all();

        $line = ORM::factory('line',$info['lineid'])->as_array();
        $info['lineinfo'] = "<a href='/lines/show_{$line['aid']}.html' target='_blank'>{$line['title']}</a>";


        $this->assign('info',$info);

        $this->display('stourtravel/jieban/view');
    }

}
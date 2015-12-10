<?php defined('SYSPATH') or die('No direct script access.');
class Controller_Car  extends Stourweb_Controller{
    public function before()
    {
        parent::before();
        $action = $this->request->action();

        if($action == 'car')
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
                Common::getUserRight('car',$user_action);

        }
        else if($action == 'add')
        {
            Common::getUserRight('car','sadd');
        }
        else if($action == 'edit')
        {
            Common::getUserRight('car','smodify');
        }
        else if($action == 'kind')
        {
            $param = $this->params['action'];
            $right = array(
                'add'=>'sadd',
                'save'=>'smodify',
                'del'=>'sdelete'
            );
            $user_action = $right[$param] ? $right[$param] : 'slook';
            if(!empty($user_action))
                Common::getUserRight('cartype',$user_action);

        }
        else if($action == 'price')
        {
            $param = $this->params['action'];
            $right = array(
                'add'=>'sadd',
                'save'=>'smodify',
                'del'=>'sdelete'
            );
            $user_action = $right[$param] ? $right[$param] : 'slook';
            if(!empty($user_action))
                Common::getUserRight('carprice',$user_action);

        }
        else if($action == 'ajax_carsave')
        {
            Common::getUserRight('car','smodify');
        }

        $this->assign('parentkey',$this->params['parentkey']);
        $this->assign('itemid',$this->params['itemid']);
        $this->assign('weblist',Common::getWebList());
        $this->assign('carkindidlist',ORM::factory('car_kind')->where('webid=0')->get_all());

        $this->assign('templetlist',Common::getUserTemplteList('car_show'));//获取上传的用户模板
    }
     /*
	租车列表 
	 */
	public function action_car()
	{
		$action=$this->params['action'];
		if(empty($action))  //显示线路列表页
		{
           $this->assign('kindmenu',Common::getConfig('menu_sub.carkind'));//分类设置项
		   $this->display('stourtravel/car/list');
		}
		else if($action=='read')    //读取列表
		{
			$start=Arr::get($_GET,'start');
			$limit=Arr::get($_GET,'limit');
			$keyword=Arr::get($_GET,'keyword');
			$kindid=Arr::get($_GET,'kindid');
			$attrid=Arr::get($_GET,'attrid');
			$carkindid=Arr::get($_GET,'carkindid');
			$webid=Arr::get($_GET,'webid');
			$sort=json_decode(Arr::get($_GET,'sort'),true);
			$order='order by a.modtime desc';
            $webid = empty($webid) ? -1 : $webid;
            $keyword = Common::getKeyword($keyword);

            $specOrders=array('attrid','kindlist','iconlist','themelist');
			if($sort[0]['property'])
			{
                $prefix='';
				if($sort[0]['property']=='displayorder')
				{
					$prefix='';
				}
			    else if($sort[0]['property']=='ishidden')
				{
                    $prefix='a.';
				}
                else if($sort[0]['property']=='suitday')
                {
                    $prefix='e.';
                }
                else if($sort[0]['property']=='seatnum')
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
            $w.=empty($keyword)?'':" and (a.title like '%{$keyword}%' or a.id like '%{$keyword}%')";
			$w.=empty($kindid)?'':" and find_in_set($kindid,a.kindlist)";
			$w.=empty($attrid)?'':" and find_in_set($attrid,a.attrid)";
			$w.=empty($brandid)?'':" and a.carbrandid='$brandid'";
			$w.=empty($carkindid)?'':" and a.carkindid='$carkindid'";
            $w.=$webid=='-1' ? '' : " and a.webid=$webid";
			if(empty($kindid))
			{
			   $sql="select  a.id,a.webid,a.aid,a.title,a.supplierlist,a.seatnum,a.carkindid,a.kindlist,a.attrid,a.iconlist,a.themelist,if(length(ifnull(a.attrid,''))=0,0,1) as order_attrid,if(length(ifnull(a.kindlist,''))=0,0,1) as order_kindlist,if(length(ifnull(a.iconlist,''))=0,0,1) as order_iconlist,if(length(ifnull(a.themelist,''))=0,0,1) as order_themelist
,a.ishidden,d.kindname as carkindname,IFNULL(b.displayorder,9999) as displayorder,ifnull(e.suitday,0) as suitday from sline_car as a left join sline_allorderlist b on (a.id=b.aid and b.typeid=3)  left join sline_car_kind d on (a.carkindid=d.id) left join (select c.carid,c.id,min(c.suitday) as suitday from(select a.carid,a.id,max(b.day) as suitday
 from sline_car_suit a left join sline_car_suit_price b on a.id=b.suitid  group by a.id) c group by c.carid) e on a.id=e.carid where $w $order limit $start,$limit";
			}
			else
			{
				$sql="select  a.id,a.webid,a.aid,a.title,a.supplierlist,a.seatnum,a.carkindid,a.kindlist,a.attrid,a.iconlist,a.themelist,if(length(ifnull(a.attrid,''))=0,0,1) as order_attrid,if(length(ifnull(a.kindlist,''))=0,0,1) as order_kindlist,if(length(ifnull(a.iconlist,''))=0,0,1) as order_iconlist,if(length(ifnull(a.themelist,''))=0,0,1) as order_themelist
,a.ishidden,b.isjian,b.isding,b.istejia,ifnull(b.displayorder,9999) as displayorder ,d.kindname as carkindname,ifnull(e.suitday,0) as suitday from sline_car as a left join sline_kindorderlist as b on (a.id=b.id and b.classid=$kindid and b.typeid=3) left join sline_car_kind d on (a.carkindid=d.id) left join (select c.carid,c.id,min(c.suitday) as suitday from(select a.carid,a.id,max(b.day) as suitday
 from sline_car_suit a left join sline_car_suit_price b on a.id=b.suitid  group by a.id) c group by c.carid) e on a.id=e.carid where FIND_IN_SET($kindid,a.kindlist)   order by a.modtime desc";
			}
			$totalcount_arr=DB::query(Database::SELECT,"select count(*) as num from sline_car a where $w")->execute()->as_array();
			$list=DB::query(Database::SELECT,$sql)->execute()->as_array();
		
			$new_list=array();
			foreach($list as $k=>$v)
			{
				
				$v['kindname']=Model_Destinations::getKindnameList($v['kindlist']);
			    $v['attrname']=Model_Car_Attr::getAttrnameList($v['attrid']);
                $v['series'] = Common::getSeries($v['id'],'03');//编号
                $v['url'] = Common::getBaseUrl($v['webid']).'/cars/show_'.$v['aid'].'.html';

                //供应商信息
                $supplier = ORM::factory('supplier')->where("id='{$v['supplierlist']}'")->find()->as_array();
                $v['suppliername'] = $supplier['suppliername'];
                $v['linkman'] = $supplier['linkman'];
                $v['mobile'] = $supplier['mobile'];
                $v['address'] = $supplier['address'];
                $v['qq'] = $supplier['qq'];
			
				$suits=ORM::factory('car_suit')->where("carid={$v['id']}")->get_all();
                $suittypes=ORM::factory('car_suit_type')->where("carid={$v['id']}")->get_all();

                $suitOrder=$sort[0]['property']=='suitday'?'order by suitday '.$sort[0]['direction']:'';
                $suitSql="select a.*,ifnull(max(b.day),0) as suitday from sline_car_suit a left join sline_car_suit_price b on a.id=b.suitid where a.carid={$v['id']}  group by a.id $suitOrder";
                $suits=DB::query(Database::SELECT,$suitSql)->execute()->as_array();

				
				if(!empty($suits))
				   $v['tr_class']='parent-product-tr';
				$new_list[]=$v;
				
				foreach($suits as $key=>$val)
				{
				   $val['title']=$val['suitname'];
				   $val['id']='suit_'.$val['id'];
                   $val['suittypes']=$suittypes;
				   if($key!=count($suits)-1)
				     $val['tr_class']='suit-tr';
				   $new_list[]=$val;
				}
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
		    $model=ORM::factory('car',$id);
		    $model->deleteClear();
		   }
		   else if(strpos($id,'suit')!==FALSE)
		   {
			   $suitid=substr($id,strpos($id,'_')+1);
			   $suit=ORM::factory('car_suit',$suitid);
               $carid=$suit->carid;
			   $suit->deleteClear();
               Model_Car::updateMinPrice($carid);
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
			    if(is_numeric($id))//如果是酒店
				{
				    if(empty($kindid))  //全局排序
				   {
					 $order=ORM::factory('allorderlist');
					 $order_mod=$order->where("aid='$id' and typeid=3 and webid=0")->find();
					
					 if($order_mod->id)  //如果已经存在
					 {
					   $order_mod->displayorder=$displayorder;
					 }
					 else   //如果这个排序不存在
					 {
						$order_mod->displayorder=$displayorder;
						$order_mod->aid=$id;
						$order_mod->webid=0;
						$order_mod->typeid=3;
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
					  $kindorder_mod=$kindorder->where("aid='$id' and typeid=3 and classid=$kindid")->find();
					  if($kindorder_mod->id)
					  {
					   $kindorder_mod->displayorder=$displayorder;
					  }
					  else
					  {
						$kindorder_mod->displayorder=$displayorder;
						$kindorder_mod->aid=$id;
						$kindorder_mod->classid=$kindid;
						$kindorder_mod->typeid=3;
					  }
					  $kindorder_mod->save();
					  if($kindorder->saved())
					     echo 'ok';
					  else
					     echo 'no';	  
					   
				   }
				}
				else if(strpos($id,'suit')!==FALSE)
				{
				   $suitid=substr($id,strpos($id,'_')+1);
			       $suit=ORM::factory('car_suit',$suitid);
				   $suit->displayorder=$displayorder;
				   if($suit->id)
				   {
				      $suit->save();
					  if($suit->saved())
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
					$model=ORM::factory('car',$id);
				}
				else if(strpos($id,'suit')!==FALSE)
				{
					$suitid=substr($id,strpos($id,'_')+1);
					$model=ORM::factory('car_suit',$suitid);
				}
				if($model->id)
				{
                    $model->$field=$val;
                    if($field=='kindlist') {
                        $model->$field = implode(',', Model_Destinations::getParentsStr($val));
                    }
                    else if($field=='attrid')
                    {
                        $model->$field=implode(',',Model_Attrlist::getParentsStr($val,3));
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
	 * 租车价格范围
	*/
	public function action_price()
    {
        $action=$this->params['action'];
        if(empty($action))
        {
            $list=ORM::factory('car_pricelist')->get_all();
            $this->assign('list',$list);
            $this->display('stourtravel/car/price');
        }
		else if($action=='add')
		{
		   $model=ORM::factory('car_pricelist'); 
		   $model->create();
		   echo $model->id;
		}
        else if($action=='save')
        {
            $lowerprice=Arr::get($_POST,'min');
            $highprice=Arr::get($_POST,'max');
           

            foreach($lowerprice as $k=>$v)
            {
                $model=ORM::factory('car_pricelist',$k);
                if($model->id)
                {
                    $model->min=$v;
                    $model->max=$highprice[$k];
                    $model->save();
                }
            }

           

            echo 'ok';
        }
        else if($action=='del')
        {
            $id=Arr::get($_POST,'id');
            $model=ORM::factory('car_pricelist',$id);
            $model->delete();
            echo 'ok';
        }
    }
	/*
	*  租车类型
	*/
	public function action_kind()
	{
		$action=$this->params['action'];
        if(empty($action))
        {
            $list=ORM::factory('car_kind')->get_all();
            $this->assign('list',$list);
            $this->display('stourtravel/car/kind');
        }
		else if($action=='add')
		{
		   $model=ORM::factory('car_kind'); 
		   $model->create();
		   echo $model->id;
		}
		else if($action=='save')
		{
			$kindname_arr=Arr::get($_POST,'kindname');
            $title_arr=Arr::get($_POST,'title');
			$displayorder_arr=Arr::get($_POST,'displayorder');
			
           
			

            foreach($kindname_arr as $k=>$v)
            {
                $model=ORM::factory('car_kind',$k);
                if($model->id)
                {
                    $model->kindname=$v;
                    $model->title=$title_arr[$k];
					$model->displayorder=$displayorder_arr[$k];
					$model->webid =0;
                    $model->save();
                }
            }

          
            echo 'ok';
		}
		else if($action=='del')
        {
            $id=Arr::get($_POST,'id');
            $model=ORM::factory('car_kind',$id);
            $model->delete();
            echo 'ok';
        }
	}


	/*
	*  添加租车 
	*/
	public function action_add()
    {
        $this->assign('action','add');
        $columns=ORM::factory('car_content')->where("(webid=0 and isopen=1) or columnname='tupian'")->order_by('displayorder','asc')->get_all();
        $this->assign('columns',$columns);
        $this->display('stourtravel/car/edit');
    }

    /*
     * 修改租车
     */
    public function action_edit()
    {

        $carid=$this->params['carid'];
        $info=ORM::factory('car',$carid)->as_array();
        $info['kindlist_arr']=Model_Destinations::getKindlistArr($info['kindlist']);
        $info['attrlist_arr']=Common::getSelectedAttr(3,$info['attrid']);
        $info['iconlist_arr']=Common::getSelectedIcon($info['iconlist']);
        $info['supplier_arr']=ORM::factory('supplier',$info['supplierlist'])->as_array();
        $info['piclist_arr'] =  json_encode(Common::getUploadPicture($info['piclist']));//图片数组
        $columns=ORM::factory('car_content')->where("(webid=0 and isopen=1) or columnname='tupian'")->order_by('displayorder','asc')->get_all();

        $extendinfo = Common::getExtendInfo(3,$info['id']);

        $this->assign('columns',$columns);
        $this->assign('extendinfo',$extendinfo);//扩展信息
        $this->assign('action','edit');
        $this->assign('info',$info);
        $this->display('stourtravel/car/edit');
    }

    /*
     * 保存租车
     */
	public function action_ajax_carsave()
    {
        $carid=Arr::get($_POST,'carid');
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
        $attrids =implode(',',Arr::get($_POST,'attrlist'));//属性
        if(!empty($attrids))
        {
            $attrmode = ORM::factory("car_attr")->where("id in ($attrids)")->group_by('pid')->get_all();
            foreach ($attrmode as $k => $v)
            {
                $attrids = $v['pid'].','.$attrids;
            }
        }

        $data_arr=array();
        $data_arr['title']=Arr::get($_POST,'title');
        $data_arr['sellpoint']=Arr::get($_POST,'sellpoint') ? Arr::get($_POST,'sellpoint') : '';
        $data_arr['seatnum']=Arr::get($_POST,'seatnum') ? Arr::get($_POST,'seatnum') : 0;
        $data_arr['maxseatnum']=Arr::get($_POST,'maxseatnum')? Arr::get($_POST,'maxseatnum') : 0;
        $data_arr['usedyears']=Arr::get($_POST,'usedyears')?Arr::get($_POST,'usedyears'): 0;
        $data_arr['phone']=Arr::get($_POST,'phone') ? Arr::get($_POST,'phone') : 0;
        $link = new Model_Tool_Link();
        $data_arr['content']=$link->keywordReplaceBody(Arr::get($_POST,'content'),3);
        //$data_arr['content']=Arr::get($_POST,'content');
        $data_arr['notice']=Arr::get($_POST,'notice');
        $data_arr['recommendnum']=$_POST['recommendnum'];

        $data_arr['satisfyscore']=Arr::get($_POST,'satisfyscore') ? Arr::get($_POST,'satisfyscore') : 90;
        $data_arr['bookcount']=Arr::get($_POST,'bookcount') ? Arr::get($_POST,'bookcount') : 0;
        $data_arr['webid']=$webid;
        $data_arr['carkindid']=Arr::get($_POST,'carkindid');

        $data_arr['ishidden']=Arr::get($_POST,'ishidden');
        $data_arr['kindlist']=implode(',',$kindlist);
        $data_arr['attrid']=$attrids;
        $data_arr['iconlist']=implode(',',Arr::get($_POST,'iconlist'));
        $data_arr['supplierlist']=implode(',',Arr::get($_POST,'supplierlist'));
        $data_arr['seotitle'] = Arr::get($_POST,'seotitle');//优化标题
        $data_arr['tagword'] = Arr::get($_POST,'tagword');
        $data_arr['keyword'] = Arr::get($_POST,'keyword');
        $data_arr['description'] = Arr::get($_POST,'description');
        $data_arr['templet'] = Arr::get($_POST,'templet');
        //图片处理
        $images_arr=Arr::get($_POST,'images');
        $imagestitle_arr=Arr::get($_POST,'imagestitle');
        $headimgindex=Arr::get($_POST,'imgheadindex');
        $imgstr="";
        foreach($images_arr as $k=>$v)
        {
            $imgstr.=$v.'||'.$imagestitle_arr[$k].',';
            if($headimgindex==$k)
            {
                $data_arr['litpic']=$v;
            }
        }
        $imgstr=trim($imgstr,',');
        $data_arr['piclist']=$imgstr;
        if($carid)
        {
            $model=ORM::factory('car',$carid);

            $model->addtime=time();
        }
        else
        {
            $model=ORM::factory('car');
            $model->aid=Common::getLastAid('sline_car',$data_arr['webid']);
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
            $carid=$model->id;
            Common::saveExtendData(3,$carid,$_POST);//扩展信息保存

            echo $carid;
        }
        else
            echo 'no';
    }
    /*
     * 添加套餐
     */
    public function action_addsuit()
    {
        $carid=$this->params['carid'];
        $carinfo=ORM::factory('car',$carid)->as_array();
        $suittypes=ORM::factory('car_suit_type')->where("carid=".$carid)->get_all();
        $this->assign('suittypes',$suittypes);
        $this->assign('carinfo',$carinfo);
        $this->assign('position','添加套餐');
        $this->assign('action','add');
        $this->display('stourtravel/car/suit_edit');
    }
    /*
     * 修改套餐
     */
    public function action_editsuit()
    {
        $suitid=$this->params['suitid'];
        $info=ORM::factory('car_suit',$suitid)->as_array();
        $carinfo=ORM::factory('car',$info['carid'])->as_array();

        $suittypes=ORM::factory('car_suit_type')->where("carid=".$carinfo['id'])->get_all();
        $this->assign('action','edit');
        $this->assign('suittypes',$suittypes);
        $this->assign('carinfo',$carinfo);
        $this->assign('info',$info);
        $this->assign('action','edit');
        $this->assign('position','修改套餐');
        $this->display('stourtravel/car/suit_edit');
    }
    /*
     * 套餐类型
     */
    public function action_suittype()
    {
        $action=$this->params['action'];

        if(empty($action))
        {
        $carid=$this->params['carid'];
        $list=ORM::factory('car_suit_type')->where('carid='.$carid)->get_all();
        $this->assign('list',$list);
        $this->assign('carid',$carid);
        $this->display('stourtravel/car/suittype');
        }
        else if($action=='save')
        {
            $carid=Arr::get($_POST,'carid');
            $kindname_arr=Arr::get($_POST,'kindname');
            $displayorder_arr=Arr::get($_POST,'displayorder');
            $newkindname_arr=Arr::get($_POST,'newkindname');
            $newdisplayorder_arr=Arr::get($_POST,'newdisplayorder');
            foreach($kindname_arr as $k=>$v)
            {
                $model=ORM::factory('car_suit_type',$k);
                if($model->id)
                {
                    $model->kindname=$v;
                    $model->carid=$carid;
                    $model->displayorder=$displayorder_arr[$k] ? $displayorder_arr[$k] : 9999;
                    $model->save();
                }
            }

            foreach($newkindname_arr as $k=>$v)
            {
                $model=ORM::factory('car_suit_type');
                $model->displayorder=$newdisplayorder_arr[$k];
                $model->carid=$carid;
                $model->kindname=$v;
                $model->save();
            }
            echo 'ok';
        }
        else if($action=='del')
        {
            $id=Arr::get($_POST,'id');
            $model=ORM::factory('car_suit_type',$id);
            $model->delete();
            echo 'ok';
        }
    }

    /*
     * 保存套餐
     */
    public function action_ajax_suitsave()
    {
        $carid=Arr::get($_POST,'carid');
        $suitid=Arr::get($_POST,'suitid');
        $data_arr=array();
        $data_arr['suitname']=Arr::get($_POST,'suitname');
        $data_arr['carid']=Arr::get($_POST,'carid');
        $data_arr['content']=Arr::get($_POST,'content');
        $data_arr['unit']=Arr::get($_POST,'unit');
        $data_arr['suittypeid']=Arr::get($_POST,'suittypeid');
        $data_arr['jifentprice']=Arr::get($_POST,'jifentprice') ? Arr::get($_POST,'jifentprice') : 0;
        $data_arr['jifenbook']=Arr::get($_POST,'jifenbook') ? Arr::get($_POST,'jifenbook') : 0;
        $data_arr['jifencomment']=Arr::get($_POST,'jifencomment') ? Arr::get($_POST,'jifencomment') : 0;
        $data_arr['paytype']=Arr::get($_POST,'paytype');
        $data_arr['dingjin']=Arr::get($_POST,'dingjin') ? Arr::get($_POST,'dingjin') : 0;


        if($suitid)
        {
          $model=ORM::factory('car_suit',$suitid);
        }
        else
          $model=ORM::factory('car_suit');
        foreach($data_arr as $k=>$v)
        {
            $model->$k=$v;
        }
        $model->save();

        if($model->saved())
        {
            $model->reload();
            $this->saveBaoJia($carid,$model->id,$_POST);
            echo $model->id;
        }
        else
            echo 'no';
    }
    /*
     *
     * 保存报价
     */
    public function saveBaoJia($carid,$suitid,$arr)
    {
        //$pricerule,$starttime,$endtime,$hotelid,$roomid,$basicprice,$profit,$description
        $pricerule = Arr::get($arr,'pricerule');
        $starttime = Arr::get($arr,'starttime');
        $endtime = Arr::get($arr,'endtime');
        if(empty($starttime)||empty($endtime))
            return false;

        $basicprice = Arr::get($arr,'basicprice') ? Arr::get($arr,'basicprice') : 0;
        $profit = Arr::get($arr,'profit') ? Arr::get($arr,'profit') : 0 ;
        $description = Arr::get($arr,'description');
        $monthval = Arr::get($arr,'monthval');
        $weekval = Arr::get($arr,'weekval');
        $number = Arr::get($arr,'number');

        $stime=strtotime($starttime);
        $etime=strtotime($endtime);
        $price = (int)$basicprice+(int)$profit;
        //按日期范围报价
        if($pricerule=='all')
        {
            $begintime=$stime;
            while(true)
            {
                $model = ORM::factory('car_suit_price')->where("suitid=$suitid and day='$begintime'")->find();
                $data_arr=array();
                $data_arr['carid'] = $carid;
                $data_arr['suitid'] = $suitid;
                $data_arr['adultbasicprice'] = $basicprice;
                $data_arr['adultprofit'] = $profit;
                $data_arr['description'] = $description;
                $data_arr['adultprice'] = $price;
                $data_arr['day'] = $begintime;
                $data_arr['number'] = $number;
                if($model->suitid)
                {
                    $query = DB::update('car_suit_price')->set($data_arr)->where("suitid=$suitid and day='$begintime'");
                    $query->execute();
                }
                else
                {
                    foreach($data_arr as $k=>$v)
                    {
                        $model->$k=$v;
                    }
                    $model->save();
                }

                $begintime=$begintime+86400;

                if($begintime>$etime)
                    break;
            }
        }
        //按号进行报价
        else if($pricerule=='month')
        {
            $syear=date('Y',$stime);
            $smonth=date('m',$stime);
            $sday=date('d',$stime);

            $eyear=date('Y',$etime);
            $emonth=date('m',$etime);
            $eday=date('d',$etime);

            $beginyear=$syear;
            $beginmonth=$smonth;
            while(true)
            {
                $daynum=date('t',strtotime($beginyear.'-'.$beginmonth.'-'.'01'));

                foreach($monthval as $v)
                {
                    if((int)$v<10)
                        $v='0'.$v;
                    $newtime=strtotime($beginyear.'-'.$beginmonth.'-'.$v);

                    if((int)$v>(int)$daynum||$newtime<$stime||$newtime>$etime)
                        continue;

                    $model = ORM::factory('car_suit_price')->where("suitid=$suitid and day='$newtime'")->find();
                    $data_arr=array();
                    $data_arr['carid'] = $carid;
                    $data_arr['suitid'] = $suitid;
                    $data_arr['adultbasicprice'] = $basicprice;
                    $data_arr['adultprofit'] = $profit;
                    $data_arr['description'] = $description;
                    $data_arr['adultprice'] = $price;
                    $data_arr['day'] = $newtime;
                    $data_arr['number'] = $number;
                    if($model->suitid)
                    {
                        $query = DB::update('car_suit_price')->set($data_arr)->where("suitid=$suitid and day='$newtime'");
                        $query->execute();
                    }
                    else
                    {
                        foreach($data_arr as $k=>$v)
                        {
                            $model->$k=$v;
                        }
                        $model->save();
                    }




                }
                $beginmonth=(int)$beginmonth+1;
                if($beginmonth>12)
                {
                    $beginmonth=$beginmonth-12;
                    $beginyear++;
                }

                if(($beginmonth>$emonth&&$beginyear>=$eyear)||($beginmonth<=$emonth&&$beginyear>$eyear))
                    break;
                $beginmonth=$beginmonth<10?'0'.$beginmonth:$beginmonth;
            }
        }
        //按星期进行报价
        else if($pricerule=='week')
        {

            $begintime=$stime;

            while(true)
            {
                $cur_week=date('w',$begintime);
                $cur_week=$cur_week==0?7:$cur_week;

                if(in_array($cur_week,$weekval))
                {
                    $model = ORM::factory('car_suit_price')->where("suitid=$suitid and day='$begintime'")->find();
                    $data_arr=array();
                    $data_arr['carid'] = $carid;
                    $data_arr['suitid'] = $suitid;
                    $data_arr['adultbasicprice'] = $basicprice;
                    $data_arr['adultprofit'] = $profit;
                    $data_arr['description'] = $description;
                    $data_arr['adultprice'] = $price;
                    $data_arr['day'] = $begintime;
                    $data_arr['number'] = $number;
                    if($model->suitid)
                    {
                        $query = DB::update('car_suit_price')->set($data_arr)->where("suitid=$suitid and day='$begintime'");
                        $query->execute();
                    }
                    else
                    {
                        foreach($data_arr as $k=>$v)
                        {
                            $model->$k=$v;
                        }
                        $model->save();
                    }
                }

                $begintime=$begintime+86400;


                if($begintime>$etime)
                    break;
            }

        }
        Model_Car::updateMinPrice($carid);
    }

}
<?php defined('SYSPATH') or die('No direct script access.');
class Controller_Hotel  extends Stourweb_Controller{

    private  $roomtype = array('单床1.5米','大床1.8米','大床2米','双床1.2米','双床1.5米','双床1.8米','三床1.2米','大床/双床');//床型
    private  $windowtype = array('有窗','内窗','无窗');
    private  $repasttype = array('单早','双早','含','不含','早餐','早晚餐','三餐','一价全包','用晚含早');
    private  $computertype = array('有线','WIFI','含','不含');



    public function before()
    {
        parent::before();
        $action = $this->request->action();

        if($action == 'hotel')
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
                Common::getUserRight('hotel',$user_action);


        }
        else if($action == 'add')
        {
            Common::getUserRight('hotel','sadd');
        }
        else if($action == 'edit')
        {
            Common::getUserRight('hotel','smodify');
        }
        else if($action == 'price')
        {

                Common::getUserRight('hotelprice','slook');

        }
        else if($action == 'ajax_price')
        {
              $op = $this->params['action'];
              if($op == 'save')
              {
                  Common::getUserRight('hotelprice','smodify');
              }
              else if($op == 'del')
              {
                  Common::getUserRight('hotelprice','sdel');
              }
        }
        else if($action == 'rank' || $action == 'ajax_ranklist')
        {
                Common::getUserRight('hotelrank','slook');

        }
        else if($action == 'ajax_rank_add')
        {
                Common::getUserRight('hotelrank','sadd');
        }
        else if($action == 'ajax_rank_save')
        {
                Common::getUserRight('hotelrank','smodify');
        }
        else if($action == 'ajax_rank_del')
        {
                Common::getUserRight('hotelrank','sdel');
        }

        $this->assign('parentkey',$this->params['parentkey']);
        $this->assign('itemid',$this->params['itemid']);
        $this->assign('weblist',Common::getWebList());
        $this->assign('templetlist',Common::getUserTemplteList('hotel_show'));//获取上传的用户模板

    }
     /*
	 酒店列表操作
	 
	 */
	public function action_hotel()
	{
		$action=$this->params['action'];
		if(empty($action))  //显示酒店列表页
		{
           $this->assign('kindmenu',Common::getConfig('menu_sub.hotelkind'));//分类设置项
		   $this->display('stourtravel/hotel/list');
		}
		else if($action=='read')    //读取列表
		{
			$start=Arr::get($_GET,'start');
			$limit=Arr::get($_GET,'limit');
			$keyword=Arr::get($_GET,'keyword');
			$kindid=Arr::get($_GET,'kindid');
			$attrid=Arr::get($_GET,'attrid');
			$rankid=Arr::get($_GET,'rankid');
            $webid=Arr::get($_GET,'webid');
            $webid = empty($webid) ? -1 : $webid;
            $keyword = Common::getKeyword($keyword);

			$sort=json_decode(Arr::get($_GET,'sort'),true);
            $specOrders=array('attrid','kindlist','iconlist','themelist');
			$order='order by a.modtime desc';
			if($sort[0]['property'])
			{
				if($sort[0]['property']=='displayorder')
				{
					$order='order by displayorder '.$sort[0]['direction'].',a.modtime desc';

				}
			    else if($sort[0]['property']=='ishidden')
				{
					$order='order by a.ishidden '.$sort[0]['direction'].',a.modtime desc';
				}
                else if($sort[0]['property']=='suitday')
                {
                    $order='order by d.suitday '.$sort[0]['direction'].',a.modtime desc';
                }
                else if(in_array($sort[0]['property'],$specOrders))
                {
                   $order='order by order_'.$sort[0]['property'].' '.$sort[0]['direction'].',a.modtime desc';
                }
			}
			$w="a.id is not null";
            $w.=empty($keyword)?'':" and (a.title like '%{$keyword}%' or a.id like '%{$keyword}%')";
			$w.=empty($kindid)?'':" and find_in_set($kindid,a.kindlist)";
			$w.=empty($attrid)?'':" and find_in_set($attrid,a.attrid)";
			$w.=empty($rankid)?'':" and a.hotelrankid='$rankid'";
            $w.=$webid=='-1' ? '' : " and a.webid=$webid";
			
			if(empty($kindid))
			{
			   $sql="select a.id,a.aid,a.title,a.kindlist,a.attrid,a.hotelrankid,a.hotelrankid ,a.ishidden,a.webid,a.iconlist,a.supplierlist,a.themelist,b.isding,b.isjian,b.istejia,if(length(ifnull(a.attrid,''))=0,0,1) as order_attrid,if(length(ifnull(a.kindlist,''))=0,0,1) as order_kindlist,if(length(ifnull(a.iconlist,''))=0,0,1) as order_iconlist,if(length(ifnull(a.themelist,''))=0,0,1) as order_themelist
,ifnull(b.displayorder,9999) as displayorder,ifnull(d.suitday,0) as suitday from sline_hotel as a left join sline_allorderlist b on (a.id=b.aid and b.typeid=2) left join (select c.hotelid,c.id,min(c.suitday) as suitday from(select a.hotelid,a.id,max(b.day) as suitday
 from sline_hotel_room a left join sline_hotel_room_price b on a.id=b.suitid  group by a.id) c group by c.hotelid) d on a.id=d.hotelid  where $w $order limit $start,$limit";
			}
			else
			{
				$sql="select a.id,a.aid,a.title,a.kindlist,a.attrid,a.hotelrankid,a.hotelrankid ,a.ishidden,a.webid,a.iconlist,if(length(ifnull(a.attrid,''))=0,0,1) as order_attrid,if(length(ifnull(a.kindlist,''))=0,0,1) as order_kindlist,if(length(ifnull(a.iconlist,''))=0,0,1) as order_iconlist,if(length(ifnull(a.themelist,''))=0,0,1) as order_themelist
,a.themelist,b.isding,b.isjian,b.istejia,ifnull(b.displayorder,9999) as displayorder,ifnull(d.suitday,0) as suitday from sline_hotel as a left join sline_kindorderlist as b on (b.classid=$kindid and a.id=b.aid and b.typeid=2) left join (select c.hotelid,c.id,min(c.suitday) as suitday from(select a.hotelid,a.id,max(b.day) as suitday
 from sline_hotel_room a left join sline_hotel_room_price b on a.id=b.suitid  group by a.id) c group by c.hotelid) d on a.id=d.hotelid where $w $order limit $start,$limit";
			}
			$totalcount_arr=DB::query(Database::SELECT,"select count(*) as num from sline_hotel a where $w")->execute()->as_array();
			$list=DB::query(Database::SELECT,$sql)->execute()->as_array();
			
		
			$new_list=array();
			foreach($list as $k=>$v)
			{
				
				$v['kindname']=Model_Destinations::getKindnameList($v['kindlist']);
			    $v['attrname']=Model_Hotel_Attr::getAttrnameList($v['attrid']);
                $v['url'] = Common::getBaseUrl($v['webid']).'/hotels/show_'.$v['aid'].'.html';
                $iconname = Model_Icon::getIconName($v['iconlist']);

                $name = '';
                foreach($iconname as $icon)
                {
                    if(!empty($icon))
                        $name.='<span style="color:red">['.$icon.']</span>';
                }

                $v['iconname'] = $name;

                $v['series'] = Common::getSeries($v['id'],'02');//编号

                //供应商信息
                $supplier = ORM::factory('supplier')->where("id='{$v['supplierlist']}'")->find()->as_array();
                $v['suppliername'] = $supplier['suppliername'];
                $v['linkman'] = $supplier['linkman'];
                $v['mobile'] = $supplier['mobile'];
                $v['address'] = $supplier['address'];
                $v['qq'] = $supplier['qq'];

				//$homes=ORM::factory('hotel_room')->where("hotelid",'=',$v['id'])->get_all(); //读取套餐
                $suitOrder=$sort[0]['property']=='suitday'?'order by suitday '.$sort[0]['direction']:'';
                $homeSql="select a.*,ifnull(max(b.day),0) as suitday from sline_hotel_room a left join sline_hotel_room_price b on a.id=b.suitid where a.hotelid={$v['id']}  group by a.id $suitOrder";
                $homes=DB::query(Database::SELECT,$homeSql)->execute()->as_array();
				if(!empty($homes))
				   $v['tr_class']='parent-product-tr';
				$new_list[]=$v;
				
				foreach($homes as $key=>$val)
				{
				   $val['title']=$val['roomname'];
                   $val['roomid'] = $val['id'];
				   $val['id']='suit_'.$val['id'];
                   $val['hotelid'] = $val['hotelid'];

				   if($key!=count($homes)-1)
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
		   
		   if(is_numeric($id)) //酒店
		   {
		    $model=ORM::factory('hotel',$id);
		    $model->deleteClear();
		   }
		   else if(strpos($id,'suit')!==FALSE)
		   {
			   $suitid=substr($id,strpos($id,'_')+1);
			   $suit=ORM::factory('hotel_room',$suitid);
               $hotelid=$suit->hotelid;
			   $suit->deleteClear();
               Model_Hotel::updateMinPrice($hotelid);

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
					 $order_mod=$order->where("aid='$id' and typeid=2 and webid=0")->find();
					
					 if($order_mod->id)  //如果已经存在
					 {
					   $order_mod->displayorder=$displayorder;
					 }
					 else   //如果这个排序不存在
					 {
						$order_mod->displayorder=$displayorder;
						$order_mod->aid=$id;
						$order_mod->webid=0;
						$order_mod->typeid=2;
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
					  $kindorder_mod=$kindorder->where("aid='$id' and typeid=2 and classid=$kindid")->find();
					  if($kindorder_mod->id)
					  {
					   $kindorder_mod->displayorder=$displayorder;
					  }
					  else
					  {
						$kindorder_mod->displayorder=$displayorder;
						$kindorder_mod->aid=$id;
						$kindorder_mod->classid=$kindid;
						$kindorder_mod->typeid=2;
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
			       $suit=ORM::factory('hotel_room',$suitid);
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
					$model=ORM::factory('hotel',$id);
				}
				else if(strpos($id,'suit')!==FALSE)
				{
					$suitid=substr($id,strpos($id,'_')+1);

					$model=ORM::factory('hotel_room',$suitid);


				}
				if($model->id)
				{
                    $model->$field=$val;
                    if($field=='kindlist') {
                        $model->$field = implode(',', Model_Destinations::getParentsStr($val));
                    }
                    else if($field=='attrid')
                    {
                        $model->$field=implode(',',Model_Attrlist::getParentsStr($val,2));
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
     * 添加酒店
     * */
    public function action_add()
    {
        $columns=ORM::factory('hotel_content')->where("(webid=0 and isopen=1) or columnname='tupian'")->order_by('displayorder','asc')->get_all();
        $this->assign('columns',$columns);
        $this->assign('webid',0);
        $this->assign('position','添加酒店');
        $this->assign('action','add');
        $this->assign('ranklist',ORM::factory('hotel_rank')->getList());
        $this->display('stourtravel/hotel/edit');
    }
    /*
     * 修改酒店
     * */
    public function action_edit()
    {
        $productid = $this->params['id'];

        $this->assign('action','edit');
        $this->assign('ranklist',ORM::factory('hotel_rank')->getList());

        $info = ORM::factory('hotel',$productid)->as_array();

        $columns=ORM::factory('hotel_content')->where("(webid=0 and isopen=1) or columnname='tupian'")->order_by('displayorder','asc')->get_all();

        $info['kindlist_arr']=Model_Destinations::getKindlistArr($info['kindlist']);

        $info['attrlist_arr']=Common::getSelectedAttr(2,$info['attrid']);
        $info['iconlist_arr']=Common::getSelectedIcon($info['iconlist']);
        $info['supplier_arr']=ORM::factory('supplier',$info['supplierlist'])->as_array();
        $info['piclist_arr'] =  json_encode(Common::getUploadPicture($info['piclist']));//图片数组
        $extendinfo = Common::getExtendInfo(2,$info['id']);
        $this->assign('columns',$columns);
        $this->assign('extendinfo',$extendinfo);//扩展信息
        $this->assign('info',$info);
        $this->assign('position','修改酒店'.$info['title']);
        $this->display('stourtravel/hotel/edit');


    }
    /*
     * 保存酒店(ajax)
     * */
    public function action_ajax_save()
    {
        $action = Arr::get($_POST,'action');//当前操作

        $id = Arr::get($_POST,'productid');



        $status = false;

        $webid = Arr::get($_POST,'webid');//所属站点

        //添加操作
        if($action == 'add' && empty($id))
        {
            $model = ORM::factory('hotel');
            $model->aid = Common::getLastAid('sline_hotel',$webid);
            $model->addtime = time();
        }
        else
        {
            $model = ORM::factory('hotel',$id);
            if($model->webid != $webid) //如果更改了webid重新生成aid
            {
                $aid = Common::getLastAid('sline_hotel',$webid);
                $model->aid = $aid;
            }
            $productid = $id;
        }

        $attrids =implode(',',Arr::get($_POST,'attrlist'));//属性
        if(!empty($attrids)){
            $attrmode = ORM::factory("hotel_attr")->where("id in ($attrids)")->group_by('pid')->get_all();
            foreach ($attrmode as $k => $v) {
                $attrids = $v['pid'].','.$attrids;
            }
        }
        
        $imagestitle = Arr::get($_POST,'imagestitle');
        $images = Arr::get($_POST,'images');
        $imgheadindex = Arr::get($_POST,'imgheadindex');

        //图片处理
        $piclist ='';
        $litpic = $images[$imgheadindex];
        for($i=1;isset($images[$i]);$i++)
        {
            $desc = isset($imagestitle[$i]) ? $imagestitle[$i] : '';
            $pic = !empty($desc) ? $images[$i].'||'.$desc : $images[$i];
            $piclist .= $pic.',';

        }
        $piclist =strlen($piclist)>0 ? substr($piclist,0,strlen($piclist)-1) : '';//图片


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



        $model->title = Arr::get($_POST,'title');
        $model->address = Arr::get($_POST,'address');
        $model->webid = $webid;
        $model->sellpoint = Arr::get($_POST,'sellpoint');
        $model->recommendnum=$_POST['recommendnum'];
        $model->telephone = Arr::get($_POST,'telephone');
        $model->opentime = Arr::get($_POST,'opentime');
        $model->decoratetime = Arr::get($_POST,'decoratetime');//装修时间
        $model->opentime = Arr::get($_POST,'opentime');
        $model->kindlist = implode(',',$kindlist);//所属目的地
        $model->attrid = $attrids;//属性
        $model->iconlist = implode(',',Arr::get($_POST,'iconlist'));//图标
        $model->supplierlist = implode(',',Arr::get($_POST,'supplierlist'));
        $model->satisfyscore = Arr::get($_POST,'satisfyscore')?Arr::get($_POST,'satisfyscore'):0;//满意度
        $model->bookcount = Arr::get($_POST,'bookcount')?Arr::get($_POST,'bookcount'):0;//销量
        $model->piclist = $piclist;
        $model->ishidden = Arr::get($_POST,'ishidden')?Arr::get($_POST,'ishidden'):0;//显示隐藏
        $model->litpic = Arr::get($_POST,'litpic');//封面图
        $model->traffic = Arr::get($_POST,'jiaotong');//交通指南
        $model->notice = Arr::get($_POST,'zhuyi');//注意事项
        $model->equipment = Arr::get($_POST,'fujian');//附件
        $model->aroundspots = Arr::get($_POST,'zhoubian');//周边景点
        $model->seotitle = Arr::get($_POST,'seotitle');//优化标题
        $model->tagword = Arr::get($_POST,'tagword');
        $model->keyword = Arr::get($_POST,'keyword');
        $model->description = Arr::get($_POST,'description');
        $model->fuwu=$_POST['fuwu'];
        $model->modtime = time();
        $model->hotelrankid = Arr::get($_POST,'hotelrankid');
        $model->lng=$_POST['lng'];
        $model->lat=$_POST['lat'];
        $link = new Model_Tool_Link();
        $model->content=$link->keywordReplaceBody(Arr::get($_POST,'jieshao'),2);
        //$model->content =  Arr::get($_POST,'jieshao');
        $model->litpic = $litpic;
        $model->templet = Arr::get($_POST,'templet');
        if($action=='add')
        {
            $model->save();
        }
        else
        {
            $model->update();
        }



        if($model->saved())
        {
            if($action=='add')
            {
                $productid = $model->id; //插入的产品id

            }

            Common::saveExtendData(2,$productid,$_POST);//扩展信息保存

            $status = true;
        }
        echo json_encode(array('status'=>$status,'productid'=>$productid));






    }

    /*
     * 酒店星级操作
     * */
    public function action_rank()
    {
        $this->display('stourtravel/hotel/rank');

    }



    /*
     * 获取星级列表
     * */
    public function action_ajax_ranklist()
    {

        $model =  new Model_Hotel_Rank();
        $arr = $model->order_by('orderid','asc')->get_all();

        $out = array();
        foreach($arr as $row)
        {

            $out[] =array('displayorder'=>$row['orderid'],'rankname'=>$row['hotelrank'],'id'=>$row['id']);

        }
        echo json_encode(array('trlist'=>$out));
    }
    /*
     * 动态添加星级
     * */
    public function action_ajax_rank_add()
    {
        $rankname = Arr::get($_POST,'rankname');
        $rankname = !empty($rankname) ? $rankname : '自定义';
        $model = ORM::factory('hotel_rank');
        $model->hotelrank = $rankname;
        $model->orderid = '9999';
        $model->webid = 0;
        $model->create();
        $flag = 0 ;
        $rankid = 0;
        $webid = 0;
        if($model->saved())
        {
            $rankid = $model->id; //插入的星级id

            $flag = true;
        }
        echo json_encode(array('status'=>$flag,'rankid'=>$rankid));

    }
    /*
     * 星级动态保存
     * */
    public function action_ajax_rank_save()
    {
        $data = $_POST;
        $rankname = Arr::get($data,'rankname');

        $displayorder = Arr::get($data,'displayorder');

        $newrankname = Arr::get($data,'newrankname');
        $newdisplayorder = Arr::get($data,'newdisplayorder');

        $id = Arr::get($data,'id');
        for($i=0;isset($rankname[$i]);$i++)
        {
            $obj = ORM::factory('hotel_rank')->where('id','=',$id[$i])->find();
            $obj->hotelrank = $rankname[$i];
            $obj->orderid = $displayorder[$i];
            $obj->webid = 0;
            $obj->update();
            $obj->clear();
        }
        for($i=0;isset($newrankname[$i]);$i++)
        {
            $model= ORM::factory('hotel_rank');
            $model->hotelrank = $newrankname[$i];
            $model->orderid = $newdisplayorder[$i];
            $obj->webid = 0;
            $model->create();
            $model->clear();
        }
        echo json_encode(array('status'=>true));

    }
    /*
     * 星级删除
     * */
    public function action_ajax_rank_del()
    {
        $navid = Arr::get($_GET,'id');
        $model = ORM::factory('hotel_rank',$navid);
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
        echo json_encode($out);

    }

    /*
     * 酒店价格范围操作
     * */
    public function action_price()
    {
        $action = $this->params['action'];
        if(empty($action))
        {
            $list = ORM::factory('hotel_pricelist')->where('webid','=','0')->order_by('min','asc')->get_all();
            $this->assign('list',$list);
            $this->display('stourtravel/hotel/price');
        }
        if($action == 'save')
        {
            $lowerprice=Arr::get($_POST,'lowerprice');
            $highprice=Arr::get($_POST,'highprice');

        }

    }
    /*
    * 酒店价格ajax操作
    * */
    public function action_ajax_price()
    {
        $action = $this->params['action'];
        //动态添加范围
        if($action == 'add')
        {
            /*$row = ORM::factory('hotel_pricelist')
                ->where('webid','=','0')
                ->order_by('id','desc')
                ->limit(1)
                ->find()->as_array();

            $min = intval($row['max'])+1;

            $model = new Model_Hotel_Pricelist();
            $model->min = $min;
            $model->webid = 0;
            $flag = 0 ;
            $priceid = 0;
            $model->create();
            if($model->saved())
            {
                $priceid = $model->id; //插入的id

                $flag = true;
            }
            echo json_encode(array('status'=>$flag,'priceid'=>$priceid,'min'=>$min));*/
        }
        //动态保存
        if($action == 'save')
        {
            $min = Arr::get($_POST,'min');
            $max = Arr::get($_POST,'max');
            $id = Arr::get($_POST,'id');
            $newmin = Arr::get($_POST,'newmin');
            $newmax = Arr::get($_POST,'newmax');

            //保存原来的
            for($i=0;isset($id[$i]);$i++)
             {
                 $obj = ORM::factory('hotel_pricelist')->where('id','=',$id[$i])->find();
                 $obj->min = $min[$i];
                 $obj->max = $max[$i];
                 $obj->update();
                 $obj->clear();
             }
            //添加新的
            for($i=0;isset($newmin[$i]);$i++)
            {
                $obj = ORM::factory('hotel_pricelist');
                $obj->min = $newmin[$i];
                $obj->max = $newmax[$i];
                $obj->webid = 0;
                $obj->create();
                $obj->clear();
            }

            echo json_encode(array('status'=>true));

        }
        //动态删除
        if($action == 'del')
        {
            $id = Arr::get($_POST,'id');
            $model = ORM::factory('hotel_pricelist',$id);
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
            echo json_encode($out);
        }

    }


    /*
     * 酒店房型管理
     * */
    public function action_room()
    {

        $action=$this->params['action'];
        $hotelid = $this->params['hotelid'];
        $this->assign('hotelid',$hotelid);
        if(empty($action))  //显示线路列表页
        {
            $info = ORM::factory('hotel',$hotelid)->as_array();
            $position = $info['title'];
            $this->assign('position',$position);
            $this->display('stourtravel/hotel/room');
        }
        else if($action=='read')    //读取列表
        {
            $start=Arr::get($_GET,'start');
            $limit=Arr::get($_GET,'limit');

            /*$list = ORM::factory('hotel_room')
                       ->where('hotelid','=',$hotelid)
                       ->order_by('displayorder','asc')
                       ->offset($start)
                       ->limit($limit)
                       ->as_array();*/
            $sql = "select a.* from sline_hotel_room a where a.hotelid='$hotelid' order by a.id desc limit $start,$limit";
            $totalcount_arr=DB::query(Database::SELECT,"select count(*) as num from sline_hotel_room a where hotelid='$hotelid'")->execute()->as_array();
            $list=DB::query(Database::SELECT,$sql)->execute()->as_array();
            $new_list=array();
            foreach($list as $k=>$v)
            {
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
           // $id = Arr::get($_GET,'id');

            if(is_numeric($id)) //
            {
                $model=ORM::factory('hotel_room',$id);
                $model->delete();

            }
        }
        else if($action=='update')
        {

            $id=Arr::get($_POST,'id');
            $field=Arr::get($_POST,'field');
            $val=Arr::get($_POST,'val');
            $model = ORM::factory('hotel_room',$id);
            $model->$field = $val;
            $model->update();
            if($model->saved())
                echo 'ok';
            else
                echo 'no';


        }
    }

    /*
     * 房型添加/修改
     * */
    public function action_room_op()
    {



        $action=$this->params['action'];
        $hotelid = $this->params['hotelid'];
        $this->assign('hotelid',$hotelid);
        $hotelinfo = ORM::factory('hotel',$hotelid)->as_array();
        $this->assign('hotelname',$hotelinfo['title']);
        if($action == 'add')
        {
            $this->assign('position','添加房型');
            $this->assign('action','add');

        }
        else if($action == 'edit')
        {
            $roomid = $this->params['roomid'];
            $info = ORM::factory('hotel_room',$roomid)->as_array();
            $info['piclist_arr'] =  json_encode(Common::getUploadPicture($info['piclist']));//图片数组
            $this->assign('info',$info);
            $this->assign('position','修改房型');
            $this->assign('action','edit');
        }
        $this->assign('roomtype',$this->roomtype);
        $this->assign('windowtype',$this->windowtype);
        $this->assign('repasttype',$this->repasttype);
        $this->assign('computertype',$this->computertype);
        $this->display('stourtravel/hotel/room_edit');
    }

    /*
     * 房型保存
     * */
    public function action_ajax_room_save()
    {
        $action = Arr::get($_POST,'action');
        $hotelid = Arr::get($_POST,'hotelid');
        $images = Arr::get($_POST,'images');
        $imagestitle = Arr::get($_POST,'imagestitle');
        $roomid = Arr::get($_POST,'roomid');//房间id
        $suitid = $roomid;


        //图片处理
        $piclist ='';

        for($i=1;isset($images[$i]);$i++)
        {
            $desc = isset($imagestitle[$i]) ? $imagestitle[$i] : '';
            $pic = !empty($desc) ? $images[$i].'||'.$desc : $images[$i];
            $piclist .= $pic.',';

        }
        $piclist =strlen($piclist)>0 ? substr($piclist,0,strlen($piclist)-1) : '';//图片
        //添加保存
        if($action == 'add' && empty($roomid))
        {
            $model = ORM::factory('hotel_room');

        }
        else //修改保存
        {
            $model = ORM::factory('hotel_room',$roomid);
        }
        $model->roomname = Arr::get($_POST,'roomname');
        $model->sellprice = Arr::get($_POST,'sellprice')?Arr::get($_POST,'sellprice'):0;
        $model->price = Arr::get($_POST,'price')?Arr::get($_POST,'price'):0;
        $model->roomstyle = Arr::get($_POST,'roomstyle');
        $model->breakfirst = Arr::get($_POST,'breakfirst');
        $model->computer = Arr::get($_POST,'computer');
        $model->roomarea = Arr::get($_POST,'roomarea');
        $model->roomfloor = Arr::get($_POST,'roomfloor');
        $model->roomwindow = Arr::get($_POST,'roomwindow');
        $model->number = Arr::get($_POST,'roomnum')?Arr::get($_POST,'roomnum'):0;
        $model->jifencomment = Arr::get($_POST,'jifencomment') ? Arr::get($_POST,'jifencomment') : 0;
        $model->jifentprice = Arr::get($_POST,'jifentprice') ? Arr::get($_POST,'jifentprice') : 0;
        $model->jifenbook = Arr::get($_POST,'jifenbook') ? Arr::get($_POST,'jifenbook') : 0;
        $model->paytype = Arr::get($_POST,'paytype') ? Arr::get($_POST,'paytype') : 1;
        $model->dingjin = Arr::get($_POST,'dingjin');
        $model->piclist = $piclist;
        $model->hotelid = $hotelid;

        if($action=='add' && empty($roomid))
        {
            $model->create();
        }
        else
        {
            $model->update();
        }
        if($model->saved())
        {
            if($action=='add')
            {
                $roomid = $model->id; //插入的产品id
                $suitid = $roomid;

            }
            else
            {
                $roomid =null;
            }

            $status = true;
        }


        self::saveBaoJia($hotelid,$suitid,$_POST);

        echo json_encode(array('status'=>$status,'roomid'=>$roomid));





    }
/*
 * 酒店房型报价
 * */
   public function saveBaoJia($hotelid,$roomid,$arr)
   {
       //$pricerule,$starttime,$endtime,$hotelid,$roomid,$basicprice,$profit,$description
       $pricerule = Arr::get($arr,'pricerule');
       $starttime = Arr::get($arr,'starttime');
       $endtime = Arr::get($arr,'endtime');
       $basicprice = Arr::get($arr,'basicprice') ? Arr::get($arr,'basicprice') : 0;
       $profit = Arr::get($arr,'profit') ? Arr::get($arr,'profit') : 0;
       $description = Arr::get($arr,'description');
       $monthval = Arr::get($arr,'monthval');
       $weekval = Arr::get($arr,'weekval');
       $number = Arr::get($arr,'number');
       if(empty($starttime)||empty($endtime))
           return false;
       $stime=strtotime($starttime);
       $etime=strtotime($endtime);
       $price = (int)$basicprice+(int)$profit;
       //按日期范围报价
       if($pricerule=='all')
       {
           $begintime=$stime;


           while(true)
           {

               $model = ORM::factory('hotel_room_price')->where("suitid=$roomid and day='$begintime'")->find();
               $data_arr=array();
               $data_arr['hotelid'] = $hotelid;
               $data_arr['suitid'] = $roomid;
               $data_arr['basicprice'] = $basicprice;
               $data_arr['profit'] = $profit;
               $data_arr['description'] = $description;
               $data_arr['price'] = $price;
               $data_arr['day'] = $begintime;
               $data_arr['number'] = $number;
               if($model->suitid)
               {
                   $query = DB::update('hotel_room_price')->set($data_arr)->where("suitid=$roomid and day='$begintime'");
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


                   $model = ORM::factory('hotel_room_price')->where("suitid=$roomid and day='$newtime'")->find();
                   $data_arr=array();
                   $data_arr['hotelid'] = $hotelid;
                   $data_arr['suitid'] = $roomid;
                   $data_arr['basicprice'] = $basicprice;
                   $data_arr['profit'] = $profit;
                   $data_arr['description'] = $description;
                   $data_arr['price'] = $price;
                   $data_arr['day'] = $newtime;
                   $data_arr['number'] = $number;
                   if($model->suitid)
                   {
                       $query = DB::update('hotel_room_price')->set($data_arr)->where("suitid=$roomid and day='$newtime'");
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


                   $model = ORM::factory('hotel_room_price')->where("suitid=$roomid and day='$begintime'")->find();
                   $data_arr=array();
                   $data_arr['hotelid'] = $hotelid;
                   $data_arr['suitid'] = $roomid;
                   $data_arr['basicprice'] = $basicprice;
                   $data_arr['profit'] = $profit;
                   $data_arr['description'] = $description;
                   $data_arr['price'] = $price;
                   $data_arr['day'] = $begintime;
                   $data_arr['number'] = $number;
                   if($model->suitid)
                   {
                       $query = DB::update('hotel_room_price')->set($data_arr)->where("suitid=$roomid and day='$begintime'");
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

       Model_Hotel::updateMinPrice($hotelid);
   }

	

}
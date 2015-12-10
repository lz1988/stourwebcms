<?php defined('SYSPATH') or die('No direct script access.');
class Controller_Spot  extends Stourweb_Controller{
    public function before()
    {
        parent::before();
        $action = $this->request->action();

        if($action == 'spot')
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
                Common::getUserRight('spot',$user_action);

        }
        else if($action == 'add')
        {
            Common::getUserRight('spot','sadd');
        }
        else if($action == 'edit')
        {
            Common::getUserRight('spot','smodify');
        }
        else if($action == 'price')
        {
            Common::getUserRight('spotprice','slook');
        }

        else if($action == 'ajax_price')
        {
            $param = $this->params['action'];
            $right = array(

                'save'=>'smodify',
                'del'=>'sdelete'
            );
            $user_action = $right[$param] ? $right[$param] : 'slook';
            if(!empty($user_action))
                Common::getUserRight('spotprice',$user_action);

        }
        else if($action == 'ajax_save')
        {
            Common::getUserRight('spot','smodify');
        }
        $this->assign('parentkey',$this->params['parentkey']);
        $this->assign('itemid',$this->params['itemid']);
        $this->assign('weblist',Common::getWebList());
    }
     /*
	景点列表 
	 */
	public function action_spot()
	{
		$action=$this->params['action'];
		if(empty($action))  //显示线路列表页
		{
           $this->assign('kindmenu',Common::getConfig('menu_sub.spotkind'));//分类设置项
		   $this->display('stourtravel/spot/list');
		}
		else if($action=='read')    //读取列表
		{
			$start=Arr::get($_GET,'start');
			$limit=Arr::get($_GET,'limit');
			$keyword=Arr::get($_GET,'keyword');
			$kindid=Arr::get($_GET,'kindid');
			$attrid=Arr::get($_GET,'attrid');
			$webid=Arr::get($_GET,'webid');
			$sort=json_decode(Arr::get($_GET,'sort'),true);
			$order='order by a.modtime desc';
            $webid = empty($webid) ? -1 : $webid;
            $keyword = Common::getKeyword($keyword);
            $specOrders=array('attrid','kindlist','iconlist','themelist');
			if($sort[0]['property'])
			{
                if($sort[0]['property']=='displayorder')
                {
                    $prefix = '';
                }
                else if($sort[0]['property']=='ishidden')
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
            $w.=$webid=='-1' ? '' : " and a.webid=$webid";
			
			if(empty($kindid))
			{
			  $sql="select a.aid,a.id,a.title,a.price,a.tagword,a.kindlist,a.attrid,a.litpic,if(length(ifnull(a.attrid,''))=0,0,1) as order_attrid,if(length(ifnull(a.kindlist,''))=0,0,1) as order_kindlist,if(length(ifnull(a.iconlist,''))=0,0,1) as order_iconlist,if(length(ifnull(a.themelist,''))=0,0,1) as order_themelist,
a.webid,a.piclist,a.themelist,a.iconlist,a.supplierlist,a.ishidden,b.isjian,ifnull(b.displayorder,9999) as displayorder,b.isding from sline_spot as a left join sline_allorderlist b on (a.id=b.aid and b.typeid=5) where $w $order  limit $start,$limit ";
			}
			else
			{
			    $sql="select a.aid,a.id,a.title,a.price,if(length(ifnull(a.attrid,''))=0,0,1) as order_attrid,if(length(ifnull(a.kindlist,''))=0,0,1) as order_kindlist,if(length(ifnull(a.iconlist,''))=0,0,1) as order_iconlist,if(length(ifnull(a.themelist,''))=0,0,1) as order_themelist,
a.tagword,a.kindlist,a.attrid,a.litpic,a.webid,a.piclist,a.themelist,a.iconlist,a.supplierlist,a.ishidden,b.isjian,ifnull(b.displayorder,9999) as displayorder,b.isding from sline_spot as a left join sline_kindorderlist as b on (b.classid={$kindid} and a.id=b.aid and b.typeid=5) where $w $order limit $start,$limit";
			}
			$totalcount_arr=DB::query(Database::SELECT,"select count(*) as num from sline_spot a where $w")->execute()->as_array();
			$list=DB::query(Database::SELECT,$sql)->execute()->as_array();
			$new_list=array();
			foreach($list as $k=>$v)
			{
				
				$v['kindname']=Model_Destinations::getKindnameList($v['kindlist']);
			    $v['attrname']=Model_Spot_Attr::getAttrnameList($v['attrid']);
                $v['url'] = Common::getBaseUrl($v['webid']).'/spots/show_'.$v['aid'].'.html';
                $iconname = Model_Icon::getIconName($v['iconlist']);
                $name = '';
                foreach($iconname as $icon)
                {
                    if(!empty($icon))
                        $name.='<span style="color:red">['.$icon.']</span>';
                }
                $v['iconname'] = $name;

                $v['series'] = Common::getSeries($v['id'],'05');//编号

                //供应商信息
                $supplier = ORM::factory('supplier')->where("id='{$v['supplierlist']}'")->find()->as_array();
                $v['suppliername'] = $supplier['suppliername'];
                $v['linkman'] = $supplier['linkman'];
                $v['mobile'] = $supplier['mobile'];
                $v['address'] = $supplier['address'];
                $v['qq'] = $supplier['qq'];
			
				$suits=DB::query(Database::SELECT,"select a.*,b.kindname as tickettypename from sline_spot_ticket a left join sline_spot_ticket_type b on a.tickettypeid=b.id where a.spotid={$v['id']} order by a.displayorder asc")->execute()->as_array();
				
				if(!empty($suits))
				   $v['tr_class']='parent-product-tr';
				$new_list[]=$v;
				foreach($suits as $key=>$val)
				{
				   $val['title']=$val['title'];
                   $val['ticketid'] = $val['id'];//门票id
                   $val['spotid'] = $v['id'];//景点id
				   $val['id']='suit_'.$val['id'];

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
		    $model=ORM::factory('spot',$id);

		    $model->deleteClear();
		   }
		   else if(strpos($id,'suit')!==FALSE)
		   {
			   $suitid=substr($id,strpos($id,'_')+1);
			   $suit=ORM::factory('spot_ticket',$suitid);
			   $suit->deleteClear();
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
					 $order_mod=$order->where("aid='$id' and typeid=5 and webid=0")->find();
					
					 if($order_mod->id)  //如果已经存在
					 {
					   $order_mod->displayorder=$displayorder;
					 }
					 else   //如果这个排序不存在
					 {
						$order_mod->displayorder=$displayorder;
						$order_mod->aid=$id;
						$order_mod->webid=0;
						$order_mod->typeid=5;
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
					  $kindorder_mod=$kindorder->where("aid='$id' and typeid=5 and classid=$kindid")->find();
					  if($kindorder_mod->id)
					  {
					   $kindorder_mod->displayorder=$displayorder;
					  }
					  else
					  {
						$kindorder_mod->displayorder=$displayorder;
						$kindorder_mod->aid=$id;
						$kindorder_mod->classid=$kindid;
						$kindorder_mod->typeid=5;
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
			       $suit=ORM::factory('spot_ticket',$suitid);
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
					$model=ORM::factory('spot',$id);
				}
				else if(strpos($id,'suit')!==FALSE)
				{
					$suitid=substr($id,strpos($id,'_')+1);
					$model=ORM::factory('spot_ticket',$suitid);
				}
				if($model->id)
				{
                    $model->$field=$val;
                    if($field=='kindlist') {
                        $model->$field = implode(',', Model_Destinations::getParentsStr($val));
                    }
                    else if($field=='attrid')
                    {
                        $model->$field=implode(',',Model_Attrlist::getParentsStr($val,5));
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
   * 添加景点
   * */
    public function action_add()
    {
        $this->assign('webid',0);
        $this->assign('position','添加景点');
        $this->assign('action','add');
        $columns=ORM::factory('spot_content')->where("(webid=0 and isopen=1) or columnname='tupian'")->order_by('displayorder','asc')->get_all();
        $this->assign('columns',$columns);
        $this->display('stourtravel/spot/edit');
    }
    /*
    * 修改景点
    * */
    public function action_edit()
    {
        $productid = $this->params['id'];

        $this->assign('action','edit');
        $info = ORM::factory('spot',$productid)->as_array();
        $info['kindlist_arr'] = json_encode(ORM::factory('destinations')->getKindlistArr($info['kindlist']));//目的地数组
        $info['attrlist_arr'] = json_encode(Common::getSelectedAttr(5,$info['attrid']));//属性数组
        $info['iconlist_arr'] = json_encode(Common::getSelectedIcon($info['iconlist']));//图标数组
        $info['supplier_arr']=ORM::factory('supplier',$info['supplierlist'])->as_array();
        $info['piclist_arr'] =  json_encode(Common::getUploadPicture($info['piclist']));//图片数组

        $columns=ORM::factory('spot_content')->where("(webid=0 and isopen=1) or columnname='tupian'")->order_by('displayorder','asc')->get_all();

        $extendinfo = Common::getExtendInfo(5,$info['id']);
        $this->assign('columns',$columns);
        $this->assign('extendinfo',$extendinfo);//扩展信息
        $this->assign('info',$info);
        $this->assign('position','修改景点'.$info['title']);
        $this->display('stourtravel/spot/edit');


    }
    /*
     * 保存景点(ajax)
     * */
    public function action_ajax_save()
    {




        $action = Arr::get($_POST,'action');//当前操作

        $id = Arr::get($_POST,'productid');

        $status = false;

        $webid = Arr::get($_POST,'webid');//所属站点
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

        //添加操作
        if($action == 'add' && empty($id))
        {
            $model = ORM::factory('spot');
            $model->aid = Common::getLastAid('sline_spot',$webid);
            $model->addtime = time();
        }
        else
        {
            $model = ORM::factory('spot',$id);
            if($model->webid != $webid) //如果更改了webid重新生成aid
            {
                $aid = Common::getLastAid('sline_spot',$webid);
                $model->aid = $aid;
            }
        }
        //选中上级属性
        $attrids =implode(',',Arr::get($_POST,'attrlist'));//属性
        if(!empty($attrids)){
            $attrmode = ORM::factory("spot_attr")->where("id in ($attrids)")->group_by('pid')->get_all();
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


        $model->title = Arr::get($_POST,'title');
        $model->shortname = Arr::get($_POST,'shortname');
        $model->address = Arr::get($_POST,'address');
        $model->webid = $webid;

        $model->shownum = Arr::get($_POST,'shownum')?Arr::get($_POST,'shownum'): 0;

        $model->author = Arr::get($_POST,'author');//编辑人
        $model->ishidden = Arr::get($_POST,'ishidden')?Arr::get($_POST,'ishidden'):0;//显示隐藏
        $model->getway = Arr::get($_POST,'getway');//取票方式
        $model->sellpoint = Arr::get($_POST,'sellpoint');

        $model->kindlist = implode(',',$kindlist);//所属目的地
        $model->attrid = $attrids;//属性
        $model->lng = Arr::get($_POST,'lng') ? Arr::get($_POST,'lng') : 0;
        $model->lat = Arr::get($_POST,'lat') ? Arr::get($_POST,'lat') : 0;

        $model->iconlist = implode(',',Arr::get($_POST,'iconlist'));//图标

        $model->satisfyscore = Arr::get($_POST,'satisfyscore')?Arr::get($_POST,'satisfyscore'):0;//满意度
        $model->bookcount = Arr::get($_POST,'bookcount')?Arr::get($_POST,'bookcount'):0;//销量
        $model->piclist = $piclist;
        $link = new Model_Tool_Link();
        $model->content=$link->keywordReplaceBody(Arr::get($_POST,'content'),5);
        //$model->content = Arr::get($_POST,'content');//景点介绍
        $model->isspotarea = 0;
        $model->booknotice = Arr::get($_POST,'booknotice');
        $model->recommendnum=$_POST['recommendnum'];
        $model->seotitle = Arr::get($_POST,'seotitle');//优化标题
        $model->tagword = Arr::get($_POST,'tagword');
        $model->keyword = Arr::get($_POST,'keyword');
        $model->description = Arr::get($_POST,'description');
        $model->kindlist = implode(',',Arr::get($_POST,'kindlist'));//所属目的地
        $model->attrid = implode(',',Arr::get($_POST,'attrlist'));//属性
        $model->iconlist = implode(',',Arr::get($_POST,'iconlist'));//图标
        $model->supplierlist = implode(',',Arr::get($_POST,'supplierlist'));
        $model->modtime = time();


        $model->litpic = $litpic;

        /*$columnlist = $model->table_columns();
        foreach($columnlist as $key=>$v)
        {
            if($v['type']=='int' && $key!='id')
            {
                $model->$key = empty($model->$key) ? 0 : $model->$key;
            }

        }*/

        if($action=='add' && empty($id))
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

                $productid = $model->id; //插入的产品id

            }
            else
            {
                $productid =null;
            }
            Common::saveExtendData(5,$model->id,$_POST);//扩展信息保存

            $status = true;
        }
        echo json_encode(array('status'=>$status,'productid'=>$productid));






    }
    /*
 * 门票价格范围操作
 * */
    public function action_price()
    {
        $action = $this->params['action'];
        if(empty($action))
        {
            $list = ORM::factory('spot_pricelist')->where('webid','=','0')->order_by('min','asc')->get_all();
            $this->assign('list',$list);
            $this->display('stourtravel/spot/price');
        }


    }
    /*
    * 门票价格ajax操作
    * */
    public function action_ajax_price()
    {
        $action = $this->params['action'];

        //动态保存
        if($action == 'save')
        {
            $max = Arr::get($_POST,'max');
            $min = Arr::get($_POST,'min');
            $id = Arr::get($_POST,'id');
            $newmin = Arr::get($_POST,'newmin');
            $newmax = Arr::get($_POST,'newmax');



            //保存原来的
            for($i=0;isset($id[$i]);$i++)
            {
                $obj = ORM::factory('spot_pricelist')->where('id','=',$id[$i])->find();
                if(!empty($min[$i]))$obj->min =$min[$i];
                if(!empty($max[$i]))$obj->max = $max[$i];
                $obj->update();
                $obj->clear();
            }
            //添加新的
            for($i=0;isset($newmin[$i]);$i++)
            {
                $obj = ORM::factory('spot_pricelist');
                if(!empty($newmin[$i]))$obj->min =$newmin[$i];
                if(!empty($newmax[$i]))$obj->max = $newmax[$i];
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
            $model = ORM::factory('spot_pricelist',$id);
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
    * 门票列表管理
    * */
    public function action_ticket()
    {

        $action=$this->params['action'];
        $spotid = $this->params['spotid'];
        $this->assign('spotid',$spotid);
        $this->assign('tickettypelist',json_encode(ORM::factory('spot_ticket_type')->where('spotid','=',$spotid)->order_by('displayorder','asc')->get_all()));
        if(empty($action))  //显示线路列表页
        {
            $info = ORM::factory('spot',$spotid)->as_array();
            $position = $info['title'];
            $this->assign('position',$position);
            $this->display('stourtravel/spot/ticket_list');
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
            $sql = "select a.* from sline_spot_ticket a where a.spotid='$spotid' order by a.displayorder asc limit $start,$limit";
            $totalcount_arr=DB::query(Database::SELECT,"select count(*) as num from sline_spot_ticket a where spotid='$spotid'")->execute()->as_array();
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
            $rawdata=file_get_contents('php://input');
            $field=Arr::get($_GET,'field');
            $data=json_decode($rawdata);
            $id=$data->id;
            if($field)
            {
                $model=ORM::factory('spot_ticket',$id);
                if($model->id)
                {
                    $model->$field=$data->$field;
                    $model->save();
                    if($model->saved())
                        echo 'ok';
                    else
                        echo 'no';
                }
            }

        }
        else if($action=='delete') //删除某个记录
        {
            $rawdata=file_get_contents('php://input');
            $data=json_decode($rawdata);
            $id=$data->id;
            // $id = Arr::get($_GET,'id');

            if(is_numeric($id)) //
            {
                $model=ORM::factory('spot_ticket',$id);
                $model->delete();

            }
        }
        else if($action=='update') //更新单个字段.
        {
            $id=Arr::get($_POST,'id');
            $field=Arr::get($_POST,'field');
            $val=Arr::get($_POST,'val');
            $model=ORM::factory('spot_ticket',$id);
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
    * 门票添加/修改
    * */
    public function action_ticket_op()
    {
        $action=$this->params['action'];
        $spotid = $this->params['spotid'];
        $this->assign('spotid',$spotid);
        $spotinfo = ORM::factory('spot',$spotid)->as_array();
        $this->assign('spotname',$spotinfo['title']);
        $this->assign('tickettypelist',ORM::factory('spot_ticket_type')->where('spotid','=',$spotid)->get_all());//门票类型
        if($action == 'add')
        {
            $this->assign('position','添加门票');
            $this->assign('action','add');

        }
        else if($action == 'edit')
        {
            $ticketid = $this->params['ticketid'];
            $info = ORM::factory('spot_ticket',$ticketid)->as_array();
            $info['piclist_arr'] =  json_encode(Common::getUploadPicture($info['piclist']));//图片数组
            $this->assign('info',$info);
            $this->assign('position','修改门票');
            $this->assign('action','edit');
        }
        $this->display('stourtravel/spot/ticket_edit');
    }

    /*
     * 门票保存
     * */
    public function action_ajax_ticket_save()
    {
        $action = Arr::get($_POST,'action');
        $spotid = Arr::get($_POST,'spotid');
        $images = Arr::get($_POST,'images');
        $imagestitle = Arr::get($_POST,'imagestitle');
        $ticketid = Arr::get($_POST,'ticketid');
        $suitid = $ticketid;



        //添加保存
        if($action == 'add' && empty($ticketid))
        {
            $model = ORM::factory('spot_ticket');

        }
        else //修改保存
        {
            $model = ORM::factory('spot_ticket',$ticketid);
        }



        $model->title = Arr::get($_POST,'title');
        $model->tickettypeid = Arr::get($_POST,'tickettypeid')?Arr::get($_POST,'tickettypeid'):0;
        $model->sellprice = Arr::get($_POST,'sellprice')?Arr::get($_POST,'sellprice'):0;
        $model->ourprice = Arr::get($_POST,'ourprice')?Arr::get($_POST,'ourprice'):0;
        $model->jifencomment = Arr::get($_POST,'jifencomment')?Arr::get($_POST,'jifencomment'):0;
        $model->jifentprice = Arr::get($_POST,'jifentprice')?Arr::get($_POST,'jifentprice'):0;
        $model->jifenbook = Arr::get($_POST,'jifenbook')?Arr::get($_POST,'jifenbook'):0;
        $model->number = Arr::get($_POST,'ticketnum')?Arr::get($_POST,'ticketnum'):0;
        $model->dingjin = Arr::get($_POST,'dingjin')?Arr::get($_POST,'dingjin'):0;
        $model->paytype = Arr::get($_POST,'paytype')?Arr::get($_POST,'paytype'):1;
        $model->description = Arr::get($_POST,'description')?Arr::get($_POST,'description'): '';


        $model->spotid = $spotid;

        if($action=='add' && empty($ticketid))
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
                $ticketid = $model->id; //插入的产品id
                $suitid = $ticketid;
            }
            else
            {
                $roomid =null;
            }

            $status = true;
        }

        Model_spot::updateMinPrice($spotid);

        echo json_encode(array('status'=>$status,'ticketid'=>$ticketid));





    }

    /*
     * 门票类型管理
     * */

    public function action_tickettype()
    {
        $spotid = $this->params['spotid'];
        $this->assign('spotid',$spotid);
        $this->display('stourtravel/spot/tickettype_list');

    }



    /*
     * 获取门票类型列表
     * */
    public function action_ajax_tickettype_list()
    {
        $spotid = Arr::get($_GET,'spotid');
        $model =  new Model_Spot_Ticket_Type();
        $arr = $model->where('spotid','=',$spotid)->order_by('displayorder','asc')->get_all();

        $out = array();
        foreach($arr as $row)
        {

            $out[] =array('displayorder'=>$row['displayorder'],'kindname'=>$row['kindname'],'id'=>$row['id']);

        }
        echo json_encode(array('trlist'=>$out));
    }
    /*
     * 动态添加门票类型
     * */
    public function action_ajax_tickettype_add()
    {
        $kindname = Arr::get($_POST,'kindname');
        $kindname = !empty($kindname) ? $kindname : '自定义';
        $model = ORM::factory('hotel_rank');
        $model->kindname = $kindname;
        $model->displayorder = '9999';
        $model->create();
        $flag = 0 ;
        $tickettypeid = 0;
        if($model->saved())
        {
            $tickettypeid = $model->id; //插入的星级id

            $flag = true;
        }
        echo json_encode(array('status'=>$flag,'$tickettypeid'=>$tickettypeid));

    }
    /*
     * 门票类型动态保存
     * */
    public function action_ajax_tickettype_save()
    {
        $data = $_POST;
        $kindname = Arr::get($data,'kindname');

        $displayorder = Arr::get($data,'displayorder');

        $spotid = Arr::get($data,'spotid');

        $newname = Arr::get($data,'newname');
        $newdisplayorder = Arr::get($data,'newdisplayorder');

        $id = Arr::get($data,'id');
        for($i=0;isset($kindname[$i]);$i++)
        {
            $obj = ORM::factory('spot_ticket_type')->where('id','=',$id[$i])->find();
            $obj->kindname = $kindname[$i];
            $obj->displayorder = $displayorder[$i];
            $obj->update();
            $obj->clear();
        }
        for($i=0;isset($newname[$i]);$i++)
        {
            $model= ORM::factory('spot_ticket_type');
            $model->kindname = $newname[$i];
            $model->displayorder = $newdisplayorder[$i];
            $model->spotid = $spotid;
            $model->create();
            $model->clear();
        }
        echo json_encode(array('status'=>true));

    }
    /*
     * 门票类型删除
     * */
    public function action_ajax_tickettype_del()
    {
        $navid = Arr::get($_GET,'id');
        $model = ORM::factory('spot_ticket_type',$navid);
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
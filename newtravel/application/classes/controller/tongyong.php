<?php defined('SYSPATH') or die('No direct script access.');
/*
 * 通用模块主控制器
 * @author:netman
 *
 * */
class Controller_Tongyong  extends Stourweb_Controller{

    //属性设置列表
    public static  $kind = array(
                         array('name'=>'属性','url'=>'attrid/modelattr/parentkey/kind/itemid/{#typeid#}/typeid/{#typeid#}','itemid'=>'{#typeid#}'),
                         array('name'=>'目的地','url'=>'destination/destination/parentkey/kind/itemid/{#typeid#}/typeid/{#typeid#}','itemid'=>'{#typeid#}'),
                         array('name'=>'内容介绍','url'=>'attrid/content/parentkey/kind/itemid/{#typeid#}/typeid/{#typeid#}','itemid'=>'{#typeid#}'),
                         array('name'=>'扩展字段','url'=>'attrid/extendlist/parentkey/kind/itemid/{#typeid#}/typeid/{#typeid#}','itemid'=>'{#typeid#}')

                    );
    public $addmodule = null; //通用模型表
    public $typeid = null;//模型id
    public $modulename = null;
    public function before()
    {
        parent::before();
        $action = $this->request->action();
        /*if($action == 'article')
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
                Common::getUserRight('article',$user_action);

        }
        else if($action == 'add')
        {
            Common::getUserRight('article','sadd');
        }
        else if($action == 'edit')
        {
            Common::getUserRight('article','smodify');
        }
        else if($action == 'ajax_save')
        {
            Common::getUserRight('article','smodify');
        }*/
        $this->assign('parentkey',$this->params['parentkey']);
        $this->assign('itemid',$this->params['itemid']);
        $this->assign('weblist',Common::getWebList());

        $this->addmodule = ORM::factory('model')->where("id>13")->get_all();
        $this->typeid = $this->params['typeid'];
        $this->modulename = Model_Model::getModuleName($this->typeid);
        $this->assign('typeid',$this->typeid);
        $this->assign('modulename',$this->modulename);

        foreach(self::$kind as $key => $row) //typeid替换
        {
            self::$kind[$key]['url'] = str_replace('{#typeid#}',$this->typeid,$row['url']);
            self::$kind[$key]['itemid'] = str_replace('{#typeid#}',$this->typeid,$row['itemid']);


        }




    }
     /*
	列表
	 */
	public function action_index()
	{
		$action=$this->params['action'];
        $typeid = $this->typeid;
		if(empty($action))  //显示列表页
		{

           $this->assign('kindmenu',self::$kind);//分类设置项
		   $this->display('stourtravel/tongyong/list');
		}
		else if($action=='read')    //读取列表
		{
			$start=Arr::get($_GET,'start');
			$limit=Arr::get($_GET,'limit');
			$keyword=Arr::get($_GET,'keyword');
			$kindid=Arr::get($_GET,'kindid');
			$attrid=Arr::get($_GET,'attrid');
            $webid=Arr::get($_GET,'webid');
            $webid = empty($webid) ? 0 : $webid;
            $keyword = Common::getKeyword($keyword);
			$sort=json_decode(Arr::get($_GET,'sort'),true);
			$order='order by a.modtime desc';
            $specOrders=array('attrid','kindlist','iconlist','themelist');
			if($sort[0]['property'])
			{
                if($sort[0]['property']=='displayorder')
                    $prefix='b.';
                else if($sort[0]['property']=='ishidden')
                {
                    $prefix='a.';
                }
                else if($sort[0]['property']=='addtime')
                {
                   $prefix='a.';
                }
                else if(in_array($sort[0]['property'],$specOrders))
                {
                    $prefix='order_';
                }
                $order='order by '.$prefix.$sort[0]['property'].' '.$sort[0]['direction'].',a.modtime desc';

			}
			$w="a.typeid='$typeid'";
			$w.=empty($keyword)?'':" and a.title like '%{$keyword}%'";
			$w.=empty($kindid)?'':" and find_in_set($kindid,a.kindlist)";
			$w.=empty($attrid)?'':" and find_in_set($attrid,a.attrid)";
            $w.=$webid=='-1' ? '' : " and a.webid=$webid";
			
			if(empty($kindid))
			{
			   $sql="select a.*,b.displayorder,if(length(ifnull(a.attrid,''))=0,0,1) as order_attrid,if(length(ifnull(a.kindlist,''))=0,0,1) as order_kindlist,if(length(ifnull(a.iconlist,''))=0,0,1) as order_iconlist,if(length(ifnull(a.themelist,''))=0,0,1) as order_themelist from sline_model_archive as a left join sline_allorderlist b on (a.id=b.aid and b.typeid='$typeid') where $w $order";
			}
			else
			{
			   $sql="select a.*,b.displayorder,if(length(ifnull(a.attrid,''))=0,0,1) as order_attrid,if(length(ifnull(a.kindlist,''))=0,0,1) as order_kindlist,if(length(ifnull(a.iconlist,''))=0,0,1) as order_iconlist,if(length(ifnull(a.themelist,''))=0,0,1) as order_themelist from sline_model_archive as a left join sline_kindorderlist as b on (b.classid=$kindid and a.id=b.aid and b.typeid='$typeid')  where $w $order ";
				
			}
			$total=DB::query(1,$sql)->execute();
            $sql.=" limit $start,$limit";
			$list=DB::query(1,$sql)->execute()->as_array();
			$new_list=array();
            $moduleinfo = Model_Model::getModuleInfo($typeid);
			foreach($list as $k=>$v)
			{
				
				$v['kindname']=Model_Destinations::getKindnameList($v['kindlist']);
			    $v['attrname']=Model_Article_Attr::getAttrnameList($v['attrid']);
                $v['modtime']=Common::myDate('Y-m-d',$v['modtime']);
                $v['modulepinyin'] = $moduleinfo['pinyin'];

                $iconname = Model_Icon::getIconName($v['iconlist']);
                $name = '';
                foreach($iconname as $icon)
                {
                    if(!empty($icon))
                        $name.='<span style="color:red">['.$icon.']</span>';
                }

                $v['iconname'] = $name;

                $v['series'] = Common::getSeries($v['id'],$typeid);//编号


                //供应商信息
                $supplier = ORM::factory('supplier')->where("id='{$v['supplierlist']}'")->find()->as_array();
                $v['suppliername'] = $supplier['suppliername'];
                $v['linkman'] = $supplier['linkman'];
                $v['mobile'] = $supplier['mobile'];
                $v['address'] = $supplier['address'];
                $v['qq'] = $supplier['qq'];
                //套餐信息
                $homes=ORM::factory('model_suit')->where("productid",'=',$v['id'])->get_all(); //读取套餐

                if(!empty($homes)) $v['tr_class']='parent-product-tr';

                $new_list[]=$v;

                foreach($homes as $key=>$val)
                {
                    $val['title']=$val['suitname'];
                    $val['suitid'] = $val['id'];
                    $val['id']='suit_'.$val['id'];
                    $val['productid'] = $val['productid'];
                    $val['sellprice'] = $val['sellprice'];
                    $val['ourprice'] = $val['ourprice'];
                    if($key!=count($homes)-1)
                        $val['tr_class']='suit-tr';
				    $new_list[]=$val;
                }
			}
			$result['total']=$total->count();
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
		       $model=ORM::factory('model_archive',$id);
		       $model->delete();
		   }
           else if(strpos($id,'suit')!==FALSE)
           {
               $suitid=substr($id,strpos($id,'_')+1);
               $suit=ORM::factory('model_suit',$suitid);
               $suit->delete();
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
					 $order_mod=$order->where("aid='$id' and typeid='$typeid' and webid=0")->find();
					
					 if($order_mod->id)  //如果已经存在
					 {
					   $order_mod->displayorder=$displayorder;
					 }
					 else   //如果这个排序不存在
					 {
						$order_mod->displayorder=$displayorder;
						$order_mod->aid=$id;
						$order_mod->webid=0;
						$order_mod->typeid=$typeid;
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
					  $kindorder_mod=$kindorder->where("aid='$id' and typeid=$typeid and classid=$kindid")->find();
					  if($kindorder_mod->id)
					  {
					   $kindorder_mod->displayorder=$displayorder;
					  }
					  else
					  {
						$kindorder_mod->displayorder=$displayorder;
						$kindorder_mod->aid=$id;
						$kindorder_mod->classid=$kindid;
						$kindorder_mod->typeid=$typeid;
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
                    $suit=ORM::factory('model_suit',$suitid);
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
					$model=ORM::factory('model_archive',$id);
				}
                else if(strpos($id,'suit')!==FALSE)
                {
                    $suitid=substr($id,strpos($id,'_')+1);

                    $model=ORM::factory('model_suit',$suitid);


                }
				if($model->id)
				{

                    $model->$field=$val;
                    if($field=='kindlist') {
                        $model->$field = implode(',', Model_Destinations::getParentsStr($val));
                    }
                    else if($field=='attrid')
                    {
                        $model->$field=implode(',',Model_Attrlist::getParentsStr($val,$typeid));
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
     * 添加页面
     * */
    public function action_add()
    {
        $typeid = $this->params['typeid'];

        $this->assign('webid',0);
        $this->assign('position','添加');
        $this->assign('action','add');

        $columns=ORM::factory('model_content')->where("(webid=0 and isopen=1 and typeid=$typeid) or (columnname='tupian' and typeid=$typeid)")->order_by('displayorder','asc')->get_all();
        $this->assign('columns',$columns);
        $this->assign('typeid',$typeid);
        $this->display('stourtravel/tongyong/edit');
    }
    /*
    * 修改页面
    * */
    public function action_edit()
    {
        $productid = $this->params['id'];
        $typeid = $this->params['typeid'];
        $this->assign('action','edit');
        $info = ORM::factory('model_archive',$productid)->as_array();

        $columns=ORM::factory('model_content')->where("(webid=0 and isopen=1 and typeid=$typeid) or (columnname='tupian' and typeid=$typeid)")->order_by('displayorder','asc')->get_all();
        $this->assign('columns',$columns);

        $info['kindlist_arr'] = ORM::factory('destinations')->getKindlistArr($info['kindlist']);//目的地数组
        $info['attrlist_arr'] = Common::getSelectedAttr($typeid,$info['attrid']);//属性数组
        $info['iconlist_arr'] = Common::getSelectedIcon($info['iconlist']);//图标数组
        $info['piclist_arr'] =  json_encode(Common::getUploadPicture($info['piclist']));//图片数组
        $info['supplier_arr']=ORM::factory('supplier',$info['supplierlist'])->as_array();
        $extendinfo = Common::getExtendInfo($typeid,$info['id']);


        $this->assign('extendinfo',$extendinfo);//扩展信息
        $this->assign('info',$info);
        $this->assign('position','修改'.$info['title']);
        $this->assign('typeid',$typeid);
        $this->display('stourtravel/tongyong/edit');


    }
    /*
     * 保存(ajax)
     * */
    public function action_ajax_save()
    {
        $action = Arr::get($_POST,'action');//当前操作
        $id = Arr::get($_POST,'productid');
        $status = false;
        $webid = Arr::get($_POST,'webid');//所属站点
        $typeid = $this->params['typeid'];

        //添加操作
        if($action == 'add' && empty($id))
        {
            $model = ORM::factory('model_archive');
            $model->aid = Common::getLastAid('sline_model_archive',$webid);
            $model->addtime = time();
        }
        else
        {
            $model = ORM::factory('model_archive',$id);
            if($model->webid != $webid) //如果更改了webid重新生成aid
            {
               $aid = Common::getLastAid('sline_model_archive',$webid);
               $model->aid = $aid;
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


        $model->piclist = $piclist;
        $model->title = Arr::get($_POST,'title');
        $model->webid = $webid;
        $model->content = Arr::get($_POST,'content');
        $model->modtime = Arr::get($_POST,'modtime');
        $model->litpic = $litpic;
        $model->ishidden = Arr::get($_POST,'ishidden')?Arr::get($_POST,'ishidden'):0;//显示隐藏
        $model->seotitle = Arr::get($_POST,'seotitle');//优化标题
        $model->tagword = Arr::get($_POST,'tagword');
        $model->keyword = Arr::get($_POST,'keyword');
        $model->description = Arr::get($_POST,'description');
        $model->shownum = Arr::get($_POST,'shownum')? Arr::get($_POST,'shownum'):0;
        $model->kindlist = implode(',',Arr::get($_POST,'kindlist'));//所属目的地
        $model->attrid = implode(',',Arr::get($_POST,'attrlist'));//属性
        $model->iconlist = implode(',',Arr::get($_POST,'iconlist'));//图标
        $model->supplierlist =implode(',',Arr::get($_POST,'supplierlist'));

        $model->modtime = time();
        $model->typeid = Arr::get($_POST,'typeid');
        $model->templet = Arr::get($_POST,'templet');
        $model->satisfyscore = Arr::get($_POST,'satisfyscore');
        $model->sellpoint = Arr::get($_POST,'sellpoint');
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
            Common::saveExtendData($typeid,$model->id,$_POST);//扩展信息保存
            $status = true;
        }
        echo json_encode(array('status'=>$status,'productid'=>$productid));

    }

    /*
     * 套餐管理
     * */
    public function action_suit()
    {
        $action=$this->params['action'];
        $productid = $this->params['productid'];
        $this->assign('productid',$productid);
        $info = ORM::factory('model_archive',$productid)->as_array();
        $this->assign('productname',$info['title']);

        if($action == 'add')
        {
            $this->assign('position','添加套餐');
            $this->assign('action','add');

        }
        else if($action == 'edit')
        {
            $suitid = $this->params['suitid'];
            $info = ORM::factory('model_suit',$suitid)->as_array();
            $this->assign('info',$info);
            $this->assign('position','修改套餐');
            $this->assign('action','edit');
        }
        $this->display('stourtravel/model/suit_edit');

    }
    /*
   * 套餐保存
   * */
    public function action_ajax_suit_save()
    {
        $action = Arr::get($_POST,'action');
        $productid = Arr::get($_POST,'productid');
        $suitid = Arr::get($_POST,'suitid');//套餐id

        //添加保存
        if($action == 'add' && empty($suitid))
        {
            $model = ORM::factory('model_suit');

        }
        else //修改保存
        {
            $model = ORM::factory('model_suit',$suitid);
        }
        $model->suitname = Arr::get($_POST,'suitname');
        $model->sellprice = Arr::get($_POST,'sellprice')?Arr::get($_POST,'sellprice'):0;
        $model->ourprice = Arr::get($_POST,'ourprice')?Arr::get($_POST,'ourprice'):0;
        $model->number = Arr::get($_POST,'number')?Arr::get($_POST,'number'):-1;
        $model->jifencomment = Arr::get($_POST,'jifencomment') ? Arr::get($_POST,'jifencomment') : 0;
        $model->jifentprice = Arr::get($_POST,'jifentprice') ? Arr::get($_POST,'jifentprice') : 0;
        $model->jifenbook = Arr::get($_POST,'jifenbook') ? Arr::get($_POST,'jifenbook') : 0;
        $model->paytype = Arr::get($_POST,'paytype') ? Arr::get($_POST,'paytype') : 1;
        $model->dingjin = Arr::get($_POST,'dingjin');
        $model->productid = $productid;
        $model->description = Arr::get($_POST,'description');

        if($action=='add' && empty($suitid))
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
                $suitid = $model->id; //插入的产品id
            }
            else
            {
                $suitid =null;
            }

            $status = true;
        }
        echo json_encode(array('status'=>$status,'suitid'=>$suitid));





    }


}
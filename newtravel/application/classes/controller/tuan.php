<?php defined('SYSPATH') or die('No direct script access.');
class Controller_Tuan extends Stourweb_Controller{
    public function before()
    {
        parent::before();
        $action = $this->request->action();

        if($action == 'tuan')
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
                Common::getUserRight('tuan',$user_action);


        }
        else if($action == 'add')
        {
            Common::getUserRight('tuan','sadd');
        }
        else if($action == 'edit')
        {
            Common::getUserRight('tuan','smodify');
        }
        else if($action == 'ajax_tuansave')
        {
            Common::getUserRight('tuan','smodify');
        }

        $this->assign('parentkey',$this->params['parentkey']);
        $this->assign('itemid',$this->params['itemid']);
        $this->assign('weblist',Common::getWebList());
        $this->assign('templetlist',Common::getUserTemplteList('tuan_show'));//获取上传的用户模板
    }
     /*
	景点列表 
	 */
	public function action_tuan()
	{
		$action=$this->params['action'];
		if(empty($action))  //显示线路列表页
		{
           $this->assign('kindmenu',Common::getConfig('menu_sub.tuankind'));//分类设置项
		   $this->display('stourtravel/tuan/list');
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

            $specOrders=array('attrid','kindlist','iconlist','themelist');
			$order='order by a.modtime desc';
			if($sort[0]['property'])
			{
                if($sort[0]['property']=='displayorder')
                    $prefix='';
                else if($sort[0]['property']=='ishidden')
                {
                    $prefix='a.';
                }
                else if($sort[0]['property']=='endtime')
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
			  $sql="select a.id,a.webid,a.aid,a.title,a.endtime,a.shownum,a.bookcount,a.totalnum,a.virtualnum,a.validdate,a.attrid,a.kindlist,a.jifenbook,a.jifentprice,a.jifencomment,a.iconlist,a.themelist,b.isjian,b.isding,if(length(ifnull(a.attrid,''))=0,0,1) as order_attrid,if(length(ifnull(a.kindlist,''))=0,0,1) as order_kindlist,if(length(ifnull(a.iconlist,''))=0,0,1) as order_iconlist,if(length(ifnull(a.themelist,''))=0,0,1) as order_themelist,
ifnull(b.displayorder,9999) as displayorder,ishidden from sline_tuan as a left join sline_allorderlist b on (a.id=b.aid and b.typeid=13)  where $w $order limit $start,$limit";
			}
			else
			{
			    $sql="select a.id,a.webid,a.aid,a.title,a.endtime,a.shownum,a.bookcount,a.totalnum,a.virtualnum,a.validdate,a.attrid,a.kindlist,a.jifenbook,a.jifentprice,a.jifencomment,a.iconlist,a.themelist,if(length(ifnull(a.attrid,''))=0,0,1) as order_attrid,if(length(ifnull(a.kindlist,''))=0,0,1) as order_kindlist,if(length(ifnull(a.iconlist,''))=0,0,1) as order_iconlist,if(length(ifnull(a.themelist,''))=0,0,1) as order_themelist,
b.isjian,b.isding,ifnull(b.displayorder,9999) as displayorder,ishidden from sline_tuan as a left join sline_kindorderlist as b on (b.classid=$kindid and a.id=b.aid and b.typeid=13)  where $w $order limit $start,$limit";
			}
			$totalcount_arr=DB::query(Database::SELECT,"select count(*) as num from sline_tuan a where $w")->execute()->as_array();
			$list=DB::query(Database::SELECT,$sql)->execute()->as_array();
			$new_list=array();
			foreach($list as $k=>$v)
			{
				$v['kindname']=Model_Destinations::getKindnameList($v['kindlist']);
			    $v['attrname']=Model_Spot_Attr::getAttrnameList($v['attrid']);

                $iconname = Model_Icon::getIconName($v['iconlist']);
                $name = '';
                foreach($iconname as $icon)
                {
                    if(!empty($icon))
                        $name.='<span style="color:red">['.$icon.']</span>';
                }

                $v['iconname'] = $name;

                $v['series'] = Common::getSeries($v['id'],'13');//编号

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
		    $model=ORM::factory('tuan',$id);
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
			    if(is_numeric($id))//如果是景点
				{
				    if(empty($kindid))  //全局排序
				   {
					 $order=ORM::factory('allorderlist');
					 $order_mod=$order->where("aid='$id' and typeid=13 and webid=0")->find();
					
					 if($order_mod->id)  //如果已经存在
					 {
					   $order_mod->displayorder=$displayorder;
					 }
					 else   //如果这个排序不存在
					 {
						$order_mod->displayorder=$displayorder;
						$order_mod->aid=$id;
						$order_mod->webid=0;
						$order_mod->typeid=13;
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
					  $kindorder_mod=$kindorder->where("aid='$id' and typeid=13 and classid=$kindid")->find();
					  if($kindorder_mod->id)
					  {
					   $kindorder_mod->displayorder=$displayorder;
					  }
					  else
					  {
						$kindorder_mod->displayorder=$displayorder;
						$kindorder_mod->aid=$id;
						$kindorder_mod->classid=$kindid;
						$kindorder_mod->typeid=13;
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
					$model=ORM::factory('tuan',$id);
				}
				if($model->id)
				{
                    $model->$field=$val;
                    if($field=='kindlist') {
                        $model->$field = implode(',', Model_Destinations::getParentsStr($val));
                    }
                    else if($field=='attrid')
                    {
                        $model->$field=implode(',',Model_Attrlist::getParentsStr($val,13));
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
	*  添加团购
	*/
    public function action_add()
    {
        $weblist=ORM::factory('weblist')->get_all();

        $columns=ORM::factory('tuan_content')->where("(webid=0 and isopen=1) or columnname='tupian'")->order_by('displayorder','asc')->get_all();
        $this->assign('columns',$columns);
        $this->assign('weblist',$weblist);
        $this->assign('webid',0);
        $this->assign('action','add');
        $this->assign('position','添加团购');
        $this->display('stourtravel/tuan/edit');

    }
    /*
   * 修改团购
   */
    public function action_edit()
    {
        $tuanid=$this->params['tuanid'];
        $info=ORM::factory('tuan',$tuanid)->as_array();
        $info['kindlist_arr'] = ORM::factory('destinations')->getKindlistArr($info['kindlist']);//目的地数组
        $info['attrlist_arr'] = Common::getSelectedAttr(13,$info['attrid']);//属性数组
        $info['iconlist_arr'] = Common::getSelectedIcon($info['iconlist']);//图标数组
        $info['piclist_arr'] =  json_encode(Common::getUploadPicture($info['piclist']));//图片数组
        $info['supplier_arr']=ORM::factory('supplier',$info['supplierlist'])->as_array();
        $extendinfo = Common::getExtendInfo(13,$info['id']);

        $columns=ORM::factory('tuan_content')->where("(webid=0 and isopen=1) or columnname='tupian'")->order_by('displayorder','asc')->get_all();
        $this->assign('columns',$columns);
        $this->assign('extendinfo',$extendinfo);//扩展信息
        $this->assign('action','edit');
        $this->assign('info',$info);
        $this->assign('position','修改团购'.$info['title']);
        $this->display('stourtravel/tuan/edit');
    }
    /*
     * 保存团
     */
    public function action_ajax_tuansave()
    {
    	$attrids =implode(',',Arr::get($_POST,'attrlist'));//属性
        if(!empty($attrids)){
            $attrmode = ORM::factory("tuan_attr")->where("id in ($attrids)")->group_by('pid')->get_all();
            foreach ($attrmode as $k => $v) {
                $attrids = $v['pid'].','.$attrids;
            }
        }
        $tuanid=Arr::get($_POST,'tuanid');



        $data_arr=array();
        $data_arr['title']=Arr::get($_POST,'title');
        $data_arr['shortname']=Arr::get($_POST,'shortname');
        $data_arr['totalnum']=Arr::get($_POST,'totalnum')?Arr::get($_POST,'totalnum'):-1;
        $data_arr['starttime']=strtotime(Arr::get($_POST,'starttime'));
        $data_arr['endtime']=strtotime(Arr::get($_POST,'endtime'));
        $data_arr['sellprice']=Arr::get($_POST,'sellprice') ? Arr::get($_POST,'sellprice') : 0;
        $data_arr['price']=Arr::get($_POST,'price') ? Arr::get($_POST,'price') : 0;
        $data_arr['jifenbook']=Arr::get($_POST,'jifenbook') ? Arr::get($_POST,'jifenbook'):0 ;
        $data_arr['jifentprice']=Arr::get($_POST,'jifentprice') ? Arr::get($_POST,'jifentprice') : 0;
        $data_arr['jifencomment']=Arr::get($_POST,'jifencomment') ? Arr::get($_POST,'jifencomment') : 0;
        $data_arr['paytype']=Arr::get($_POST,'paytype')?Arr::get($_POST,'paytype'):1;
        $data_arr['dingjin']=Arr::get($_POST,'dingjin')?Arr::get($_POST,'dingjin'):0;
        $data_arr['sellpoint']=Arr::get($_POST,'sellpoint');
        $data_arr['ishidden'] = Arr::get($_POST,'ishidden')?Arr::get($_POST,'ishidden'):0;
        $data_arr['kindlist'] = implode(',',Arr::get($_POST,'kindlist'));//所属目的地
        $data_arr['attrid'] = $attrids;//属性
        $data_arr['iconlist'] = implode(',',Arr::get($_POST,'iconlist'));//图标
        $data_arr['supplierlist'] = implode(',',Arr::get($_POST,'supplierlist'));
        $link = new Model_Tool_Link();
        $data_arr['content']=$link->keywordReplaceBody(Arr::get($_POST,'content'),13);
        $data_arr['satisfyscore']=$_POST['satisfyscore'];
        //$data_arr['content']=Arr::get($_POST,'content');
        $data_arr['seotitle']=Arr::get($_POST,'seotitle');
        $data_arr['keyword']=Arr::get($_POST,'keyword');
        $data_arr['description']=Arr::get($_POST,'description');
        $data_arr['sellpoint']=Arr::get($_POST,'sellpoint');
        $data_arr['validdate']=Arr::get($_POST,'validdate');
        $data_arr['tagword']=Arr::get($_POST,'tagword');
        $data_arr['virtualnum']=Arr::get($_POST,'virtualnum') ? Arr::get($_POST,'virtualnum') : 0;
        $data_arr['templet'] = Arr::get($_POST,'templet');
        $data_arr['modtime']=time();
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

        if($tuanid)
        {
            $model=ORM::factory('tuan',$tuanid);
        }
        else
        {
            $model=ORM::factory('tuan');
            $model->aid=Common::getLastAid('sline_tuan',0);
            $model->addtime=time();
        }
        foreach($data_arr as $k=>$v)
        {
            $model->$k=$v;
        }
        $model->save();

        if($model->saved())
        {
            Common::saveExtendData(13,$model->id,$_POST);//扩展信息保存
            $model->reload();
            $id=$model->id;
            echo $id;
        }
        else
            echo 'no';
    }
}
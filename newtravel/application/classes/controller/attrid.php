<?php defined('SYSPATH') or die('No direct script access.');
class Controller_Attrid extends Stourweb_Controller{
     public static $table_arr=array(
         1=>'line_attr',
         2=>'hotel_attr',
         3=>'car_attr',
         4=>'article_attr',
         5=>'spot_attr',
         6=>'photo_attr',
         11=>'jieban_attr',
         12=>'destinations_attr',
         13=>'tuan_attr'
     );
    public static $extend_table_arr=array(
        1=>'sline_line_extend_field',
        2=>'sline_hotel_extend_field',
        3=>'sline_car_extend_field',
        4=>'sline_article_extend_field',
        5=>'sline_spot_extend_field',
        6=>'sline_photo_extend_field',
        8=>'sline_visa_extend_field',
        13=>'sline_tuan_extend_field'
    );
	 public static $product_arr=array(
         1=>'line',
         2=>'hotel',
         3=>'car',
         4=>'article',
         5=>'spot',
         6=>'photo',
         11=>'jieban',
         12=>'destinations',
         13=>'tuan'
     );
     public static $product_name=array(
         1=>'线路',
         2=>'酒店',
         3=>'租车',
         4=>'文章',
         5=>'景点',
         6=>'相册',
         8=>'签证',
         11=>'结伴',
         12=>'目的地',
         13=>'团购'

     );
    public static $content_table=array(
        1=>'line_content',
        2=>'hotel_content',
        3=>'car_content',
        4=>'',
        5=>'spot_content',
        6=>'',
        8=>'visa_content',
        13=>'tuan_content'
    );
    public function before()
    {
        parent::before();
        $action = $this->request->action();

        $type_id= $this->params['typeid'] ? $this->params['typeid'] : 1;

        $right_arr = array(
            '1'=>'lineattr',
            '2'=>'hotelattr',
            '3'=>'carattr',
            '4'=>'articleattr',
            '5'=>'spotattr',
            '6'=>'photoattr',
            '12'=>'destattr',
            '13'=>'tuanattr'
        );
        $right_moduleid = $right_arr[$type_id];
        if($type_id<14) //通知模块暂时不设置权限
        {
            if($action == 'list')
            {

                $param = $this->params['action'];
                if(!empty($param))
                {
                    $right = array(
                        'read'=>'slook',
                        'save'=>'smodify',
                        'delete'=>'sdelete',
                        'update'=>'smodify',
                        'addsub'=>'sadd'
                    );
                    $user_action = $right[$param];

                    if(!empty($user_action))
                    {

                        Common::getUserRight($right_moduleid,$user_action);
                    }


                }


            }
        }

        $this->assign('parentkey',$this->params['parentkey']);
        $this->assign('itemid',$this->params['itemid']);
        $this->assign('typeid',$this->params['typeid']);
    }
	 /*
	   获取某个产品的所有属性，并以json方式返回
	 */
	 public function action_ajax_attridlist()
	 {
		 $typeid=Arr::get($_POST,'typeid');
		 $list=self::getattridlist($typeid);
         echo json_encode($list);	 
	 }
	 /*
	    设置某个产品的属性
	 */
	 public function action_ajax_setattrid()
	 {
    	 $typeid=Arr::get($_POST,'typeid');
    	 $productid=Arr::get($_POST,'productid');
    	 $attrids=Arr::get($_POST,'attrids');
		 
        //找到父级id

        $attrtable = $typeid<13 ? self::$table_arr[$typeid] :  'model_attr';;//当前操作表
         
        //找到父级id
        $attrids_arr = ORM::factory($attrtable)->where("id in (".$attrids.")")->group_by('pid')->get_all();
        foreach ($attrids_arr as $key => $value) {
            $attrids .= ','.$value['pid']; 
        }
        
		$is_success='ok';
		$productid_arr=explode('_',$productid);
		foreach($productid_arr as $k=>$v)
		{
            $table = $typeid>13 ? 'model_archive' : self::$product_arr[$typeid];
			$model=ORM::factory($table,$v);
			if($model->id)
			{
				$model->attrid=$attrids;
				$model->save();
				if(!$model->saved())
				   $is_success='no';
			}
		}
		echo $is_success;
	 }

    /*
     * 属性列表
     * */
     public function action_list()
     {



         $action=$this->params['action'];
         $typeid = $this->params['typeid'];//栏目id.
         $attrtable = self::$table_arr[$typeid];//当前操作表

         if(empty($action))
         {
             $channelname = self::$product_name[$typeid];//产品名
             $menu = self::$product_arr[$typeid].'kind';
             $this->assign('typeid',$typeid);
             $this->assign('menu',$menu);
             $this->assign('channelname',$channelname);
             $this->display('stourtravel/attr/list');
         }
         else if($action=='read')
         {


             $node=Arr::get($_GET,'node');

             $list=array();
             if($node=='root')//属性组根
             {

                 $list=ORM::factory($attrtable)->where('pid','=','0')->get_all();

                 foreach($list as $k=>$v)
                 {
                     $list[$k]['kindname']=Model_Destinations::getKindnameList($v['destid']);
                     $list[$k]['allowDrag']=false;
                 }
                 $list[]=array(
                     'leaf'=>true,
                     'id'=>'0add',
                     'attrname'=>'<button class="dest-add-btn df-add-btn" onclick="addSub(0)">添加</button>',
                     'allowDrag'=>false,
                     'allowDrop'=>false,
                     'displayorder'=>'add'
                 );
             }
             else //子级
             {
                 $list=ORM::factory($attrtable)->where('pid','=',$node)->get_all();
                 foreach($list as $k=>$v)
                 {
                     $list[$k]['kindname']=Model_Destinations::getKindnameList($v['destid']);
                     $list[$k]['leaf']=true;
                 }
                 $list[]=array(
                     'leaf'=>true,
                     'id'=>$node.'add',
                     'attrname'=>'<button class="dest-add-btn df-add-btn" onclick="addSub(\''.$node.'\')">添加</button>',
                     'allowDrag'=>false,
                     'allowDrop'=>false,
                     'displayorder'=>'add'
                 );
             }
             echo json_encode(array('success'=>true,'text'=>'','children'=>$list));
         }
         else if($action=='addsub')//添加子级
         {
             $pid=Arr::get($_POST,'pid');

             $model=ORM::factory($attrtable);
             $model->pid=$pid;
             $model->attrname="未命名";
             $model->webid=0;
             $model->save();

             if($model->saved())
             {
                 $model->reload();
                 echo json_encode($model->as_array());
             }
         }
         else if($action=='save') //保存修改
         {
             $rawdata=file_get_contents('php://input');
             $field=Arr::get($_GET,'field');
             $data=json_decode($rawdata);
             $id=$data->id;
             if($field)
             {
                 $model=ORM::factory($attrtable,$id);
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
         else if($action=='drag') //拖动
         {
             $moveid=Arr::get($_POST,'moveid');
             $overid=Arr::get($_POST,'overid');
             $position=Arr::get($_POST,'position');
             $movemodel=ORM::factory($attrtable,$moveid);
             $overmodel=ORM::factory($attrtable,$overid);
             if($position=='append')
             {
                 $movemodel->pid=$overid;
             }
             else
             {
                 $movemodel->pid=$overmodel->pid;
             }
             $movemodel->save();
             if($movemodel->saved())
                 echo 'ok';
             else
                 echo 'no';


         }

         else if($action=='delete')//属性删除
         {
             $rawdata=file_get_contents('php://input');
             $data=json_decode($rawdata);
             $id=$data->id;
             if(!is_numeric($id))
             {
                 echo json_encode(array('success'=>false));
                 exit;
             }
             $model=ORM::factory($attrtable,$id);
             $model->delete();

         }
         else if($action=='update')//更新操作
         {
             $id=Arr::get($_POST,'id');
             $field=Arr::get($_POST,'field');
             $val=Arr::get($_POST,'val');
             $model=ORM::factory($attrtable,$id);
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
     * 扩展模型属性配置(用于扩展模块)
     * */
    public function action_modelattr()
    {

        $action=$this->params['action'];
        $typeid = $this->params['typeid'];//栏目id.
        $attrtable = 'model_attr';
        if(empty($action))
        {
            $channelname = Model_Model::getModuleName($typeid);//产品名
            //$menu = self::$product_arr[$typeid].'kind';
            $this->assign('typeid',$typeid);
            $this->assign('menu','');
            $this->assign('channelname',$channelname);
            $this->display('stourtravel/attr/modelattr');
        }
        else if($action=='read')
        {


            $node=Arr::get($_GET,'node');

            $list=array();
            if($node=='root')//属性组根
            {

                $list=ORM::factory($attrtable)->where("pid=0 and typeid=$typeid")->get_all();
                foreach($list as $k=>$v)
                {
                    $list[$k]['kindname']=Model_Destinations::getKindnameList($v['destid']);
                    $list[$k]['allowDrag']=false;
                }
                $list[]=array(
                    'leaf'=>true,
                    'id'=>'0add',
                    'attrname'=>'<button class="dest-add-btn df-add-btn" onclick="addSub(0)">添加</button>',
                    'allowDrag'=>false,
                    'allowDrop'=>false,
                    'displayorder'=>'add'
                );
            }
            else //子级
            {
                $list=ORM::factory($attrtable)->where('pid','=',$node)->get_all();
                foreach($list as $k=>$v)
                {
                    $list[$k]['kindname']=Model_Destinations::getKindnameList($v['destid']);
                    $list[$k]['leaf']=true;
                }
                $list[]=array(
                    'leaf'=>true,
                    'id'=>$node.'add',
                    'attrname'=>'<button class="dest-add-btn df-add-btn" onclick="addSub(\''.$node.'\')">添加</button>',
                    'allowDrag'=>false,
                    'allowDrop'=>false,
                    'displayorder'=>'add'
                );
            }
            echo json_encode(array('success'=>true,'text'=>'','children'=>$list));
        }
        else if($action=='addsub')//添加子级
        {
            $pid=Arr::get($_POST,'pid');

            $model=ORM::factory($attrtable);
            $model->pid=$pid;
            $model->attrname="未命名";
            $model->webid=0;
            $model->typeid=$typeid;
            $model->save();

            if($model->saved())
            {
                $model->reload();
                echo json_encode($model->as_array());
            }
        }
        else if($action=='save') //保存修改
        {
            $rawdata=file_get_contents('php://input');
            $field=Arr::get($_GET,'field');
            $data=json_decode($rawdata);
            $id=$data->id;
            if($field)
            {
                $model=ORM::factory($attrtable,$id);
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
        else if($action=='drag') //拖动
        {
            $moveid=Arr::get($_POST,'moveid');
            $overid=Arr::get($_POST,'overid');
            $position=Arr::get($_POST,'position');
            $movemodel=ORM::factory($attrtable,$moveid);
            $overmodel=ORM::factory($attrtable,$overid);
            if($position=='append')
            {
                $movemodel->pid=$overid;
            }
            else
            {
                $movemodel->pid=$overmodel->pid;
            }
            $movemodel->save();
            if($movemodel->saved())
                echo 'ok';
            else
                echo 'no';


        }

        else if($action=='delete')//属性删除
        {
            $rawdata=file_get_contents('php://input');
            $data=json_decode($rawdata);
            $id=$data->id;
            if(!is_numeric($id))
            {
                echo json_encode(array('success'=>false));
                exit;
            }
            $model=ORM::factory($attrtable,$id);
            $model->delete();

        }
        else if($action=='update')//更新操作
        {
            $id=Arr::get($_POST,'id');
            $field=Arr::get($_POST,'field');
            $val=Arr::get($_POST,'val');
            $model=ORM::factory($attrtable,$id);
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
     * 属性高级配置
     * */
     public function action_config()
     {
         $attrid = $this->params['id'];
         $typeid = $this->params['typeid'];

         $table = Model_Attrlist::getAttrTable($typeid);
         $info = ORM::factory($table,$attrid)->as_array();
         $this->assign('info',$info);
         $this->assign('typeid',$typeid);

         $this->display('stourtravel/attr/config');

     }
    /*
     * 属性配置保存
     * */
    public function action_ajax_config_save()
    {
        $typeid = ARR::get($_POST,'typeid');
        //$table = self::$table_arr[$typeid];
        $table = Model_Attrlist::getAttrTable($typeid);
        $id = ARR::get($_POST,'attrid');
        $desc = ARR::get($_POST,'description');
        $litpic = ARR::get($_POST,'litpic');
        $model = ORM::factory($table,$id);
        $model->litpic = $litpic;
        $model->description = $desc;
        $model->update();
        if($model->saved())
        {
            echo json_encode(array('status'=>true));
        }
    }
	 /*
	   根据typeid获取某个产品属性的列表 ，以json方式返回
	 */
	 public static function getattridlist($typeid)
	 {
         $tablename = Model_Attrlist::getAttrTable($typeid);
         $model=ORM::factory($tablename);
         $w = $typeid > 13 ? " and typeid='$typeid'" : '';
		 $list=$model->where("isopen=1 and pid=0 $w")->get_all();
		 foreach($list as $k=>$v)
		 {
			 $list[$k]['children']=$model->where("pid={$v['id']} and isopen=1")->get_all();
		 }
		 return $list;
		 
	 }



    /*
     * 扩展字段列表
     * */
    public function action_extendlist()
    {



        $action=$this->params['action'];
        $typeid = $this->params['typeid'];//栏目id.

        $extend_table = 'sline_extend_field';//当前操作表
        $this->assign('typeid',$typeid);
        $isextendmodel = intval($typeid)>13 ? 1 : 0;
        $this->assign('isextendmodel',$isextendmodel);


        if(empty($action))
        {
            $channelname = Model_Model::getModuleName($typeid);//产品名
            //$menu = self::$product_arr[$typeid].'kind';
            $this->assign('typeid',$typeid);
            //$this->assign('menu',$menu);
            $this->assign('channelname',$channelname);
            $this->display('stourtravel/attr/extendfield');
        }
        else if($action=='read')
        {

            $start=Arr::get($_GET,'start');
            $limit=Arr::get($_GET,'limit');
            $sql="select a.*  from $extend_table as a where typeid='$typeid' order by addtime desc limit $start,$limit";
            $list = DB::query(1,$sql,false)->execute()->as_array();
            $totalcount_arr=DB::query(Database::SELECT,"select count(*) as num from $extend_table where typeid='$typeid' ")->execute()->as_array();
            $result['total']=$totalcount_arr[0]['count'];
            $result['lists']=$list;
            $result['success']=true;

            echo json_encode($result);
        }
        else if($action == 'add')
        {

            $this->display('stourtravel/attr/addfield');
        }
        else if($action=='delete') //删除某个记录
        {
            $rawdata=file_get_contents('php://input');
            $data=json_decode($rawdata);
            $id=$data->id;
            $fieldname = $data->fieldname;
            $typeid = $this->params['typeid'];
            //$extend_table = self::$extend_table_arr[$typeid];
            $extend_table = 'sline_'.Model_Model::getExtendTable($typeid);//扩展表名称
            if(is_numeric($id)) //
            {
                $flag = ORM::factory('extend_field',$id)->delete();
                Common::delField($extend_table,$fieldname);


            }
        }
        else if($action=='update')//更新某个字段
        {
            $id=Arr::get($_POST,'id');
            $field=Arr::get($_POST,'field');
            $val=Arr::get($_POST,'val');
            if(is_numeric($id))
            {
                $model=ORM::factory('extend_field')->where('id','=',$id)->find();
            }
            if($model->id)
            {
                $model->$field=$val;

                $model->update();
                if($model->saved())
                    echo 'ok';
                else
                    echo 'no';
            }


        }

    }

    /*
     * 扩展字段保存
     * */
    public function action_ajax_extendfield_save()
    {
        $ftype = array(
            'text'=>'varchar(255)',
            'editor'=>'mediumtext'
        );

        $fieldname = Arr::get($_POST,'fieldname');
        $fieldtype = Arr::get($_POST,'fieldtype');
        $description = Arr::get($_POST,'description');
        $isunique = Arr::get($_POST,'isunique');
        $typeid = Arr::get($_POST,'typeid');
        //$extend_table = self::$extend_table_arr[$typeid];
        $extend_table = 'sline_'.Model_Model::getExtendTable($typeid);//扩展表名称
        $_ftype = $ftype[$fieldtype];

        Common::addField($extend_table,$fieldname,$_ftype,$isunique,$description);

        $model = ORM::factory('extend_field');
        $model->typeid = $typeid;
        $model->fieldname = 'e_'.$fieldname;
        $model->fieldtype = $fieldtype;
        $model->description = $description;
        $model->isopen = 1;
        $model->isunique = $isunique;
        $model->save();
        if($model->saved())
        {
            echo json_encode(array('status'=>true));
        }
    }
    /*
     * 字段名检测
     * */
    public function action_ajax_field_check()
    {

        $fieldname = Arr::get($_POST,'fieldname');


        $typeid = Arr::get($_POST,'typeid');
        $flag = 'false';
        $model = ORM::factory('extend_field')->where("fieldname='e_$fieldname' and typeid='$typeid'")->find();
        if(!isset($model->id))//没有找到就通过
        {
            $flag = 'true';
        }
        echo $flag;
    }

    /*
     * 公用行程内容处理控制器
     *
     * */
    public function action_content()
    {
        $action=$this->params['action'];
        $typeid = $this->params['typeid'];
        $modeuleinfo = Model_Model::getModuleInfo($typeid);
        $content_table = $modeuleinfo['pinyin'].'_content';
        if($modeuleinfo['issystem']!=1)
        {
            $content_table='model_content';
        }

        $channelname = $modeuleinfo['modulename'];
        $this->assign('typeid',$typeid);
        $this->assign('channelname',$channelname);
        if(empty($action))
        {
            $model = ORM::factory($content_table);

            if($modeuleinfo['issystem']!=1)
            {
                $contentlist=$model->where('webid','=',0)->and_where('typeid','=',$typeid)->order_by('displayorder')->get_all();
            }
            else{
                $contentlist = $model->where('webid=0')->order_by('displayorder')->get_all();
             }

            $this->assign('list',$contentlist);
            $this->display('stourtravel/attr/content');
        }
        else if($action=='save')
        {
            $displayorder=Arr::get($_POST,'displayorder');
            $chinesename=Arr::get($_POST,'chinesename');
            $isopen=Arr::get($_POST,'isopen');

            foreach($displayorder as $k=>$v)
            {
                $m = ORM::factory($content_table);
                $model=$m->where("id=$k")->find();
                if($model->id)
                {
                    $open=$isopen[$k]?1:0;
                    $model->chinesename=$chinesename[$k];
                    $model->displayorder=$v;
                    $model->isopen=$open;
                    $model->save();

                    $this->addExtendField($typeid,$model->columnname,$model->chinesename,1);
                }

            }
            echo 'ok';
        }
    }
    public function action_dialog_setattrid()
    {
        $typeid=$_GET['typeid'];
        $id=$_GET['id'];
        $attrlist=$_GET['attrlist'];
        $selector=urldecode($_GET['selector']);
        $attrids=array();
        if(!empty($id))
        {

            $attrids=$this->getProductAttrids($id,$typeid);
        }
        if(!empty($attrlist))
        {
            $attrids=explode(',',$attrlist);
        }
        $attridList=self::getattridlist($typeid);
        $this->assign('id',$id);
        $this->assign('attrids',$attrids);
        $this->assign('selector',$selector);
        $this->assign('attridList',$attridList);
        $this->display('stourtravel/attr/dialog_setattrid');

    }
    public function action_ajax_addfield()
    {
        $typeid =$this->params['typeid'];
        $extend_table ='sline_'.Model_Model::getExtendTable($typeid);//扩展表名称
        if(empty($extend_table))
        {
            echo json_encode(array('status'=>false,'msg'=>'类型错误'));
            return;
        }

       $lastIndex=Common::getExtendContentIndex($extend_table);
       $fieldName='e_'.'content_'.$lastIndex;
       $result=Common::addField($extend_table,'content_'.$lastIndex,'mediumtext',0,'自定义'.$lastIndex);
       if($result)
       {
            $data=$this->addContentField($typeid,$fieldName,'自定义'.$lastIndex);
            $this->addExtendField($typeid,$fieldName,'自定义'.$lastIndex);
            echo json_encode(array('status'=>true,'msg'=>'添加成功','data'=>$data));
        }
        else {
            echo json_encode(array('status' => false, 'msg' => '添加失败'));
        }
    }
    public function action_ajax_delfield()
    {
        $id=$_POST['id'];
        $typeid=$_POST['typeid'];
        $this->delContentField($typeid,$id);

    }
    public function action_dialog_delfield()
    {
        $id=$_GET['id'];
        $typeid=$_GET['typeid'];

        $isTongyong=false;
        $table = self::$content_table[$typeid];
        if(empty($table)) {
            $isTongyong=true;
            $table = 'model_content';
        }
        $model=ORM::factory($table,$id);
        if(!$model->loaded())
            return false;
        $columnName=$model->columnname;
        $extendTable ='sline_'.Model_Model::getExtendTable($typeid);//扩展表名称
        $sql = "select productid from $extendTable where $columnName is not null and $columnName!=''";
        $list = DB::query(Database::SELECT, $sql)->execute()->as_array();
        $ids = array();
        if (!empty($list)) {
            foreach ($list as $v) {
                $ids[] = $v['productid'];
            }
        }
        $idsStr = implode(',', $ids);
        if(!$isTongyong) {
            if (!empty($idsStr)) {
                $sql2 = "select * from sline_search where tid in ($idsStr) and typeid={$typeid}";
                $productList = DB::query(Database::SELECT, $sql2)->execute()->as_array();
                $this->assign('products', $productList);
            }
        }
        else
        {
            if (!empty($idsStr)) {
                $sql2 = "select * from sline_model_archive where id in ($idsStr) and typeid={$typeid}";
                $productList = DB::query(Database::SELECT, $sql2)->execute()->as_array();
                $this->assign('products', $productList);
            }
        }
        $this->assign('id',$id);
        $this->display('stourtravel/attr/dialog_delfield');
    }
    public function getProductAttrids($id,$typeid)
    {
        if(empty($id)||empty($typeid))
            return null;

        $model=ORM::factory('model',$typeid);
        if(!$model->loaded())
            return null;
        $table=$model->maintable;
        $info=ORM::factory($table,$id);
        if(!$info->loaded())
            return null;
        if(empty($info->attrid))
            return null;
        return explode(',',$info->attrid);
    }

    public function addContentField($typeid,$field,$description)
    {

        $table = self::$content_table[$typeid];
        $isTongyong=false;
        if(empty($table)) {
            $isTongyong=true;
            $table = 'model_content';
        }
        if(!$isTongyong)
        {
            $model = ORM::factory($table)->where('columnname','=',$field)->find();
        }
        else {
            $model = ORM::factory($table)->where('columnname', '=', $field)->and_where('typeid','=',$typeid)->find();
            $model->typeid=$typeid;
        }
        $model->columnname = $field;
        $model->chinesename =$description;
        $model->issystem = 0;
        $model->isopen = 1;
        $model->webid = 0;
        $model->isrealfield=1;
        $model->displayorder=99;
        if($model->save()) {
            $model->reload();
            return $model->as_array();
        }
        else
        {
            return false;
        }
    }
    public function delContentField($typeid,$id)
    {
        $table = self::$content_table[$typeid];
        $isTongyong=false;
        if(empty($table)) {
            $isTongyong=true;
            $table = 'model_content';
        }
        $model=ORM::factory($table,$id);
        $columnName=$model->columnname;
        $model->delete();
        $extend_table ='sline_'.Model_Model::getExtendTable($typeid);//扩展表名称
        $result=DB::query(Database::DELETE,"alter table `$extend_table` drop column $columnName")->execute();
        if(!$result)
            return false;
        $extendModel = ORM::factory('extend_field')->where('typeid','=',$typeid)->and_where('fieldname','=',$columnName)->find();
        $extendModel->delete();
        return true;
    }


    public function addExtendField($typeid,$field,$description,$issave=0)
    {
        $model = ORM::factory('extend_field')->where('typeid','=',$typeid)->and_where('fieldname','=',$field)->find();
        if($issave==1 && !$model->loaded())
        {
            return false;
        }
        $model->typeid = $typeid;
        $model->fieldname = $field;
        $model->fieldtype ='editor' ;
        $model->description = $description;
        $model->isopen = 1;
        $model->isunique = 0;
        return $model->save();
    }



}
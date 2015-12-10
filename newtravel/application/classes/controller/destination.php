<?php defined('SYSPATH') or die('No direct script access.');
class Controller_Destination extends Stourweb_Controller{

    private $product_arr=array(1=>'line',2=>'hotel',3=>'car',4=>'article',5=>'spot',6=>'photo',13=>'tuan');
    private $name_arr=array(1=>'线路',2=>'酒店',3=>'租车',4=>'文章',5=>'景点',6=>'相册',13=>'团购');
    public function before()
    {
        parent::before();
        $action = $this->request->action();

        if($action == 'destination')
        {
            $right_arr = array(
                '1'=>'linedest',
                '2'=>'hoteldest',
                '3'=>'cardest',
                '4'=>'articledest',
                '5'=>'spotdest',
                '6'=>'photodest',

            );
            $type_id = Arr::get($_GET,'typeid');


            if(!empty($type_id) && $type_id<14) //其它模型判断.
                $right_moduleid = $right_arr[$type_id];
            else
                $right_moduleid = 'destination';//主目的地权限

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

        $this->assign('parentkey',$this->params['parentkey']);
        $this->assign('itemid',$this->params['itemid']);
        $this->assign('templetlist',Common::getUserTemplteList('dest_index'));//获取上传的用户模板


    }
    public function action_destination()
	{
		 
		$action=$this->params['action'];
		if(empty($action))
		{
		  $typeid=$this->params['typeid'];
		  $typeid=empty($typeid)?0:$typeid;
            if(!empty($typeid))
            {
                $moduleinfo = Model_Model::getModuleInfo($typeid);
                //$product_dest_table='sline_'.$this->product_arr[$typeid].'_kindlist';
                $product_dest_table=$moduleinfo['pinyin'].'_kindlist';
            }
           $addmodule = ORM::factory('model')->where("id>13")->get_all(); //扩展模型

            $allmodule = Model_Model::getAllModule();

            //$position = $typeid==0 ? '全局目的地':$this->name_arr[$typeid].'目的地';
          $position = $typeid==0 ? '全局目的地':$moduleinfo['modulename'].'目的地';
		  $this->assign('typeid',$typeid);
          $this->assign('position',$position);
          $this->assign('addmodule',$addmodule);
          $this->assign('allmodule',$allmodule);
		  $this->display('stourtravel/destination/destination');
		}
		else if($action=='read')
		{
		   $node=Arr::get($_GET,'node');
		   $typeid=Arr::get($_GET,'typeid');
		   $node_arr=explode('_',$node);
            if(!empty($typeid))
            {
                $moduleinfo = Model_Model::getModuleInfo($typeid);
                //$product_dest_table='sline_'.$this->product_arr[$typeid].'_kindlist';
                $product_dest_table='sline_'.$moduleinfo['pinyin'].'_kindlist';
            }
		   
		   $pid=$node_arr[1]=='root'?0:$node_arr[1];
		   if(empty($typeid))
		   {
			   $sql="select * from sline_destinations where pid=$pid";
		   }
		   else
		   {

               $bfields = 'b.kindid,b.seotitle,b.keyword,b.description,b.tagword,b.jieshao,b.isfinishseo,b.isnav,b.ishot,b.displayorder';
               $sql="select a.id,a.kindname,if(find_in_set($typeid,opentypeids),1,0) as isopen,a.pinyin,a.iswebsite,{$bfields} from sline_destinations a left join $product_dest_table b on a.id=b.kindid where a.pid=$pid";


		   }
		   $list=DB::query(Database::SELECT,$sql)->execute()->as_array();
           if($typeid==0) //只有主目的地有添加功能.
           {
               $list[]=array(
                   'leaf'=>true,
                   'id'=>$pid.'add',
                   'kindname'=>'<button class="dest-add-btn df-add-btn" onclick="addSub('.$pid.')">添加</button>',
                   'allowDrag'=>false,'allowDrop'=>false,'displayorder'=>'add',
                   'isopen'=>'add',
                   'iswebsite'=>'add',
                   'isnav'=>'add',
                   'istopnav'=>'add',
                   'ishot'=>'add',
                   'pinyin'=>'add'
               );
           }

		   echo json_encode(array('success'=>true,'text'=>'','children'=>$list));

		}
		else if($action=='update')
		{
			$id=Arr::get($_POST,'id');
			$field=Arr::get($_POST,'field');
			$val=Arr::get($_POST,'val');
			$typeid=Arr::get($_POST,'typeid');

			if($typeid==0)
			{
			    $model=ORM::factory('destinations',$id);
                $model->$field=$val;
                if($field == 'weburl')
                {
                    $ar = explode('.',$val);
                    $py = str_replace('http://','',$ar[0]);
                    $m = ORM::factory('destinations')->where("webprefix='$py' and id!=$id")->find();
                    if(!$m->loaded()) //检测拼音是否重复
                    {
                        $model->webprefix = $py;

                    }
                    else
                    {
                        echo 'py_repeat';
                        exit;
                    }


                }
                $model->save();
                if($model->saved())
                    echo 'ok';
                else
                    echo 'no';

            }
            else if($field=='isopen')
            {
                $result=Model_Destinations::setTypeidOpen($id,$typeid,$val);
                if($result)
                    echo 'ok';
                else
                    echo 'no';
            }
			else
			{

              $moduleinfo = Model_Model::getModuleInfo($typeid);
                    //$product_dest_table='sline_'.$this->product_arr[$typeid].'_kindlist';
              $product_dest_table=$moduleinfo['pinyin'].'_kindlist';

			  //$model=ORM::factory($this->product_arr[$typeid].'_kindlist')->where("kindid=$id")->find();
                $model = new Model_Tongyong($product_dest_table);

                $model=$model->where("kindid=$id")->find();
              if(!$model->loaded())
              {
                  //$model = ORM::factory($this->product_arr[$typeid].'_kindlist');
                  $model->kindid = $id;

              }
              $model->$field=$val;
                $model->save();
                if($model->saved())
                    echo 'ok';
                else
                    echo 'no';


			}




		}
		else if($action=='save')
		{
		   $rawdata=file_get_contents('php://input');
		   $field=Arr::get($_GET,'field');
           $typeid=Arr::get($_GET,'typeid');
           $current_pinyin = Arr::get($_GET,'pinyin');
		   $data=json_decode($rawdata);

		   $dest_id_arr=explode('_',$data->id);
           $dest_id=$dest_id_arr[1];
            if(!empty($typeid))
            {
                $moduleinfo = Model_Model::getModuleInfo($typeid);
                //$product_dest_table='sline_'.$this->product_arr[$typeid].'_kindlist';
                $product_dest_table=$moduleinfo['pinyin'].'_kindlist';
            }
		   
		   if(!is_numeric($dest_id_arr[1]))
           {
			   echo json_encode(array('success'=>false));
		   }
           if($typeid==0)
           {
               $dest=ORM::factory('destinations',$dest_id_arr[1]);
               if($field)
               {
                   if($field=='kindname')
                   {
                      $dest->pinyin = empty($current_pinyin) ? Common::getPinYin($data->$field) : $current_pinyin;
                   }
                   $dest->$field=$data->$field;
               }
               else
               {
                   unset($data->id);
                   unset($data->parentId);
                   unset($data->leaf);
				   unset($data->issel);
				   unset($data->shownum);
                   foreach($data as $k=>$v)
                   {
                       $dest->$k=$v;
                   }
               }

           }
           else
           {

               //$dest=ORM::factory($this->product_arr[$typeid].'_kindlist')->where("kindid=$dest_id")->find();
               $dest = new Model_Tongyong($product_dest_table);
               $dest = $dest->where("kindid=$dest_id")->find();
               if(!$dest->loaded())
               {
                   $dest->kindid = $dest_id;
                   $dest->displayorder = $data->displayorder;
               }

               else
               {
                   unset($data->id);
                   unset($data->parentId);
                   unset($data->leaf);
                   unset($data->kindname);
                   unset($data->isopen);
                   unset($data->iswebsite);
                   unset($data->istopnav);
                   unset($data->pinyin);
                   unset($data->pid);
                   unset($data->kindtype);
                   unset($data->litpic);
                   unset($data->piclist);
                   unset($data->issel);
                   unset($data->shownum);
                   unset($data->templet);
				    unset($data->weburl);
                   foreach($data as $k=>$v)
                   {
                       $dest->$k=$v;
                   }

                   $dest->displayorder = $data->displayorder;

               }

           }

           $dest->displayorder=empty($dest->displayorder)?9999:$dest->displayorder;

           $dest->save();
           if($dest->saved())
           {
                echo json_encode(array('success'=>true));
           }
           else
                echo json_encode(array('success'=>false));
		}
		else if($action=='uploadfile')
		{
			$file=$_FILES['Filedata'];
			
			$rootpath=realpath(DOCROOT.'../');
			$dir=$rootpath."/uploads/main/".date('Ymd');
			
			if(!file_exists($dir))
			     mkdir($dir);
			$path_info=pathinfo($_FILES['Filedata']['name']);
		    $filename=date('His').'.'.$path_info['extension'];

			Upload::$default_directory=$dir;//默认保存文件夹
			Upload::$remove_spaces=true;//上传文件删除空格
			if(Upload::valid($file)){
					if(Upload::size($file,"1M")){
						if(Upload::type($file,array('jpg', 'png', 'gif'))){
							if(Upload::save($file,$filename)){
								
								$newfile=$dir.'/'.$filename;
								 Image::factory($newfile)
								->resize(600, 400, Image::AUTO)
								->save($newfile);
				                 echo substr(substr($newfile,strpos($dir,'/uploads')-1),1);
								  
							}else{
								echo "error_no";
							}
						}else{
							echo "error_type";
						}
					}else{
						echo "error_size";
					}
			}else{
				echo "error_null";
			}
         
			
		}
		else if($action=='addsub')
		{
			$pid=Arr::get($_POST,'pid');
			
			$dest=ORM::factory('destinations');
			$dest->pid=$pid;
			$dest->kindname="未命名";
			$dest->save();
			
			if($dest->saved())
			{
				$dest->reload();
				$dest->updateSibling('add');
 				echo json_encode($dest->as_array());
			}
		}
		else if($action=='drag')
		{
			$moveid=Arr::get($_POST,'moveid');
			$overid=Arr::get($_POST,'overid');
			$position=Arr::get($_POST,'position');
			$moveDest=ORM::factory('destinations',$moveid);
		    $overDest=ORM::factory('destinations',$overid);
			if($position=='append')
			{
				$moveDest->pid=$overid;		
			}
			else
			{
				$moveDest->pid=$overDest->pid;
			}
			$moveDest->save();
			if($moveDest->saved())
				 echo 'ok';
			 else
				 echo 'no';
			
			
		}
		else if($action=='search')
		{
			$keyword=trim(Arr::get($_POST,'keyword'));
			$list=DB::query(Database::SELECT,"select id,pid from sline_destinations where kindname like '%{$keyword}%'")->execute()->as_array();
			$new_arr=array();

			foreach($list as $k=>$v)
			{
			    $temp_arr = array();
                if($v['pid']!=0)
				{
					$temp_id=$v['pid'];
					$temp_arr=array($v['pid'],$v['id']);
					while(true)
					{
						$temp_dest=ORM::factory('destinations',$temp_id)->as_array();
						if($temp_dest['pid']!=0)
						{
							array_unshift($temp_arr,$temp_dest['pid']);
							$temp_id=$temp_dest['pid'];
						}
						else
						   break;
					}

					$new_arr[]=$temp_arr;
			 	   	
				}
				else 
				{
					$new_arr[]=array($v['id']);
				}


			}


			if(empty($new_arr))
			   echo 'no';
			else

			   echo json_encode($new_arr);   	
		}
		else if($action=='delete')
		{
		   $rawdata=file_get_contents('php://input');
		   $field=Arr::get($_GET,'field');	
		   $data=json_decode($rawdata);
		   $dest_id_arr=explode('_',$data->id);
		   if(!is_numeric($dest_id_arr[1]))
           {
			   echo json_encode(array('success'=>false));
			   exit;
		   }
		   $dest=ORM::factory('destinations',$dest_id_arr[1]);
		   $dest->deleteClear();
		   
		}
	}
	/*
	   获取下级目的地,用于各个列表的目的地筛选
	*/
	public function action_ajax_getNextDestList()
	{
		$pid=Arr::get($_POST,'pid');
		$keyword=Arr::get($_POST,'keyword');
		$pid=empty($pid)?0:$pid;
		
		if($keyword)
		  $sql="select id,kindname,pinyin from sline_destinations where kindname like '%{$keyword}%' order by pinyin asc";
		else 
		  $sql="select id,kindname,pinyin from sline_destinations where pid=$pid  order by pinyin asc";
		
		$destlist=DB::query(Database::SELECT,$sql)->execute()->as_array();

		echo json_encode($destlist);
	}
	/*
	  获取下级目的地和已设置的目的地名称,用于产品的目的地设置
	*/
	public function action_ajax_getDestsetList()
	{
		$pid=Arr::get($_POST,'pid');
		$keyword=Arr::get($_POST,'keyword');
		$pid=empty($pid)?0:$pid;
		$kindlist=Arr::get($_POST,'kindlist');
		
		if($keyword)
		  $sql="select id,kindname,pinyin from sline_destinations where kindname like '%{$keyword}%' and isopen=1  order by pinyin asc";
		else 
		  $sql="select id,kindname,pinyin from sline_destinations where pid=$pid and isopen=1  order by pinyin asc";
		$destlist=DB::query(Database::SELECT,$sql)->execute()->as_array();
        foreach($destlist as $key => $row)
        {
            $sql = "select count(*) as num from sline_destinations where pid='{$row['id']}' and isopen=1";
            $r = DB::query(1,$sql)->execute()->as_array();
            $destlist[$key]['childnum'] = $r[0]['num'];
        }
		if($kindlist)
		{
			$_arr=explode(',',$kindlist);
			foreach($_arr as $k=>$v)
			{
				$_dest=ORM::factory('destinations',$v);
				if($_dest->id)
				{
					$nv['id']=$_dest->id;
					$nv['kindname']=$_dest->kindname;
					$new_arr[]=$nv;
				}
			}
		}
		$dest_parents=Model_Destinations::getParents($pid);
		echo json_encode(array('nextlist'=>$destlist,'selected'=>$new_arr,'parents'=>$dest_parents));
	}
	public function action_ajax_setdest()
	{
		$typeid=Arr::get($_POST,'typeid');
		$productid=Arr::get($_POST,'productid');
		$kindlist=Arr::get($_POST,'kindlist');
		
		
		$productid_arr=explode('_',$productid);
		
		$is_success='ok';
		foreach($productid_arr as $k=>$v)
		{
            if($typeid<14) //是否是扩展模型
            {
                $model=ORM::factory($this->product_arr[$typeid],$v);
            }
            else
            {
                $model=ORM::factory('model_archive',$v);
            }

			if($model->id)
			{
				$model->kindlist=$kindlist;
				$model->save();
				if(!$model->saved())
				   $is_success='no';
			}
		}
		
		echo $is_success;
		/*
		$model=ORM::factory($product_arr[$typeid],$productid);
		$kindlist=trim($kindlist,',');
		$model->kindlist=$kindlist;
		$model->save();
		if($model->saved())
		   echo 'ok';
		else
		   echo 'no';   
		*/
		
	}


    /*
     * 取消子站
     * */
    public function action_cancelsite()
    {
        $siteid = $this->params['siteid'];
        Model_Web::delNav($siteid);//清除导航
        Model_Web::delRightModule($siteid);  //清除右侧模块配置
        Model_Web::genWeblist();//生成站点配置表


    }
    /*
     * 添加站点
     * */
    public function action_addsite()
    {
        $siteid = $this->params['siteid'];
        Model_Web::initData($siteid);//初始化站点数据.
        Model_Web::genWeblist(); //生成站点配置表
        Model_Web::createDefaultConfig($siteid);//创建默认配置文档

    }
    /*
     * 设置目的地
     */
    public function action_dialog_setdest()
    {
        $id=$_GET['id'];
        $kindlist=$_GET['kindlist'];
        $selector=$_GET['selector'];
        $typeid=$_GET['typeid'];
        $destList=$this->getProductDests($id,$typeid);
        if($kindlist)
        {
            $destList=Model_Destinations::getKindlistArr($kindlist);
        }
        $this->assign('id',$id);
        $this->assign('selector',urldecode($selector));
        $this->assign('destList',$destList);
        $this->display('stourtravel/destination/dialog_setdest');
    }
    public function action_dialog_basicinfo()
    {
        $id=$_GET['id'];
        $model=ORM::factory('destinations',$id);
        if(!$model->loaded())
            exit('wrong id');
        $info=$model->as_array();
        $this->assign('info',$info);
        $this->assign('id',$id);
        $this->assign('pics',Common::getUploadPicture($info['piclist']));
        $this->assign('templetlist',Common::getUserTemplteList('dest_index'));
        $this->display("stourtravel/destination/dialog_basicinfo");
    }
    public function action_dialog_productinfo()
    {
        $id=$_GET['id'];
        $typeid=$_GET['typeid'];
        $moduleinfo = Model_Model::getModuleInfo($typeid);
        $product_dest_table=$moduleinfo['pinyin'].'_kindlist';
        $model = new Model_Tongyong($product_dest_table);
        $info=$model->where("kindid",'=',$id)->find()->as_array();

        $pageName=$moduleinfo['pinyin'].'_list';
        $templateList=Model_Page_Config::getTemplateList($pageName);
        $this->assign('templateList',$templateList);
        $this->assign('id',$id);
        $this->assign('typeid',$typeid);
        $this->assign('info',$info);
        $this->display('stourtravel/destination/dialog_productinfo');

    }
    public function action_dialog_attrdest()
    {
        $id=$_GET['id'];
        $typeid=$_GET['typeid'];
        if($typeid!=12) {
            $model = ORM::factory('model', $typeid);
            if (!$model->loaded())
                return null;
            $table = $model->attrtable;
            $attrModel = ORM::factory($table, $id);
            if (!$attrModel->loaded())
                return null;
            $destList=Model_Destinations::getKindlistArr($attrModel->destid);
            $this->assign('destList',$destList);
        }
        else
        {

            $model=ORM::factory('destinations_attr',$id);
            if($model->loaded())
               $this->assign('destList',Model_Destinations::getKindlistArr($model->destid));
        }
        $this->assign('id',$id);
        $this->assign('typeid',$typeid);
        $this->display('stourtravel/destination/dialog_setdest');
    }
    public function action_dialog_setweb()
    {
        $id=$_GET['id'];
        $pinyin=$_GET['pinyin'];
        if(empty($id))
            exit('Wrong ID');
        $this->assign('id',$id);
        $this->assign('pinyin',$pinyin);
        $this->display('stourtravel/destination/dialog_setweb');
    }
	public function getProductDests($id,$typeid)
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
        $destList=Model_Destinations::getKindlistArr($info->kindlist);
        return $destList;
    }

}
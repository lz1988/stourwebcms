<?php defined('SYSPATH') or die('No direct script access.');
class Controller_Article  extends Stourweb_Controller{
    public function before()
    {
        parent::before();
        $action = $this->request->action();
        if($action == 'article')
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
        }
        $this->assign('parentkey',$this->params['parentkey']);
        $this->assign('itemid',$this->params['itemid']);
        $this->assign('weblist',Common::getWebList());
        $this->assign('templetlist',Common::getUserTemplteList('article_show'));//获取上传的用户模板

    }
     /*
	文章列表  
	 */
	public function action_article()
	{
		$action=$this->params['action'];
		if(empty($action))  //显示线路列表页
		{
           $this->assign('kindmenu',Common::getConfig('menu_sub.articlekind'));//分类设置项
		   $this->display('stourtravel/article/list');
		}
		else if($action=='read')    //读取列表
		{
			$start=Arr::get($_GET,'start');
			$limit=Arr::get($_GET,'limit');
			$keyword=Arr::get($_GET,'keyword');
			$kindid=Arr::get($_GET,'kindid');
			$attrid=Arr::get($_GET,'attrid');
            $webid=Arr::get($_GET,'webid');
            $webid = $webid=="" ? -1 : $webid;
            $keyword = Common::getKeyword($keyword);
			$sort=json_decode(Arr::get($_GET,'sort'),true);
			$order='order by a.modtime desc';
            $specOrders=array('attrid','kindlist','iconlist','themelist');
			if($sort[0]['property'])
			{
                if($sort[0]['property']=='displayorder')
                    $prefix='';
                else if($sort[0]['property']=='ishidden')
                {
                    $prefix='a.';
                }
                else if($sort[0]['property']=='templet')
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
			  $sql="select a.id,a.aid,a.title,a.attrid,a.kindlist,a.webid,a.addtime,a.ishidden,a.themelist,a.iconlist,if(length(ifnull(a.attrid,''))=0,0,1) as order_attrid,if(length(ifnull(a.kindlist,''))=0,0,1) as order_kindlist,if(length(ifnull(a.iconlist,''))=0,0,1) as order_iconlist,if(length(ifnull(a.themelist,''))=0,0,1) as order_themelist,
b.isjian,ifnull(b.displayorder,999999) as displayorder,b.isding,a.modtime,a.templet from sline_article as a left join sline_allorderlist b on (a.id=b.aid and b.typeid=4) where $w $order limit $start,$limit";
			}
			else
			{
			   $sql="select a.id,a.aid,a.title,a.attrid,a.kindlist,a.webid,a.addtime,a.ishidden,a.themelist,a.iconlist,if(length(ifnull(a.attrid,''))=0,0,1) as order_attrid,if(length(ifnull(a.kindlist,''))=0,0,1) as order_kindlist,if(length(ifnull(a.iconlist,''))=0,0,1) as order_iconlist,if(length(ifnull(a.themelist,''))=0,0,1) as order_themelist,b.isjian,b.displayorder,b.isding,a.modtime,a.templet from sline_article as a left join sline_kindorderlist as b on (b.classid=$kindid and a.id=b.aid and b.typeid=4)  where $w $order limit $start,$limit";
				
			}
			$totalcount_arr=DB::query(Database::SELECT,"select count(*) as num from sline_article a where $w")->execute()->as_array();
			$list=DB::query(Database::SELECT,$sql)->execute()->as_array();
		
			$new_list=array();
			foreach($list as $k=>$v)
			{
				
				$v['kindname']=Model_Destinations::getKindnameList($v['kindlist']);
			    $v['attrname']=Model_Article_Attr::getAttrnameList($v['attrid']);
                $v['modtime']=Common::myDate('Y-m-d',$v['modtime']);
                $v['url'] = Common::getBaseUrl($v['webid']).'/raiders/show_'.$v['aid'].'.html';
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
		    $model=ORM::factory('article',$id);
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
					 $order_mod=$order->where("aid='$id' and typeid=4 and webid=0")->find();
					
					 if($order_mod->id)  //如果已经存在
					 {
					   $order_mod->displayorder=$displayorder;
					 }
					 else   //如果这个排序不存在
					 {
						$order_mod->displayorder=$displayorder;
						$order_mod->aid=$id;
						$order_mod->webid=0;
						$order_mod->typeid=4;
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
					  Common::debug('here');
					  $kindorder=ORM::factory('kindorderlist');
					  $kindorder_mod=$kindorder->where("aid='$id' and typeid=4 and classid=$kindid")->find();
					  if($kindorder_mod->id)
					  {
					   $kindorder_mod->displayorder=$displayorder;
					  }
					  else
					  {
						$kindorder_mod->displayorder=$displayorder;
						$kindorder_mod->aid=$id;
						$kindorder_mod->classid=$kindid;
						$kindorder_mod->typeid=4;
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
					$model=ORM::factory('article',$id);
				}
				if($model->id)
				{
                    $model->$field=$val;
                    if($field=='kindlist') {
                        $model->$field = implode(',', Model_Destinations::getParentsStr($val));
                    }
                    else if($field=='attrid')
                    {
                        $model->$field=implode(',',Model_Attrlist::getParentsStr($val,4));
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
        $this->assign('webid',0);
        $this->assign('position','添加攻略');
        $this->assign('action','add');
        $this->display('stourtravel/article/edit');
    }
    /*
    * 修改页面
    * */
    public function action_edit()
    {
        $productid = $this->params['id'];

        $this->assign('action','edit');
        $info = ORM::factory('article',$productid)->as_array();
        $info['kindlist_arr'] = ORM::factory('destinations')->getKindlistArr($info['kindlist']);//目的地数组
        $info['attrlist_arr'] = Common::getSelectedAttr(4,$info['attrid']);//属性数组
        $info['iconlist_arr'] = Common::getSelectedIcon($info['iconlist']);//图标数组
        $info['piclist_arr'] =  json_encode(Common::getUploadPicture($info['piclist']));//图片数组
        $extendinfo = Common::getExtendInfo(4,$info['id']);
        $this->assign('extendinfo',$extendinfo);//扩展信息
        $this->assign('info',$info);
        $this->assign('position','修改文章'.$info['title']);
        $this->display('stourtravel/article/edit');


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
        $allow = Arr::get($_POST,'allow');//封面图片上传方式.
        $content = Arr::get($_POST,'content');//文章内容
        $bzcontent = Arr::get($_POST,'bzcontent');
        $templet = Arr::get($_POST,'templet');
        //图片处理
        $imagestitle = Arr::get($_POST,'imagestitle');
        $images = Arr::get($_POST,'images');
        $imgheadindex = Arr::get($_POST,'imgheadindex');
        $piclist ='';
        $litpic = $images[$imgheadindex];
        for($i=1;isset($images[$i]);$i++)
        {
            $desc = isset($imagestitle[$i]) ? $imagestitle[$i] : '';
            $pic = !empty($desc) ? $images[$i].'||'.$desc : $images[$i];
            $piclist .= $pic.',';

        }
        $piclist =strlen($piclist)>0 ? substr($piclist,0,strlen($piclist)-1) : '';//图片
        //添加操作
        if($action == 'add' && empty($id))
        {
            $model = ORM::factory('article');
            $model->aid = Common::getLastAid('sline_article',$webid);
            $model->addtime = time();
        }
        else
        {
            $model = ORM::factory('article',$id);
            if($model->webid != $webid) //如果更改了webid重新生成aid
            {
               $aid = Common::getLastAid('sline_article',$webid);
               $model->aid = $aid;
            }
        }

        $content = $templet=='moban2' ? $content : $bzcontent;
        if($allow == 'usecontentpic')
        {
            $litpic = self::dowloadPicture($content);

        }
        $summary = Arr::get($_POST,'summary');
        $summary = empty($summary) ? mb_substr(strip_tags(Arr::get($_POST,'content')), 0, 140, 'utf-8').'...' : $summary;
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

        $model->title = Arr::get($_POST,'title');
        $model->fromsite = Arr::get($_POST,'fromsite');
        $model->author = Arr::get($_POST,'author');
        $model->webid = $webid;
        $link = new Model_Tool_Link();
        $model->content=$link->keywordReplaceBody($content,4);
        //$model->content = $content;
        $model->modtime = Arr::get($_POST,'modtime');

        $model->comefrom = Arr::get($_POST,'comefrom');
        $model->litpic = $litpic;
        $model->ishidden = Arr::get($_POST,'ishidden')?Arr::get($_POST,'ishidden'):0;//显示隐藏
        $model->seotitle = Arr::get($_POST,'seotitle');//优化标题
        $model->tagword = Arr::get($_POST,'tagword');
        $model->keyword = Arr::get($_POST,'keyword');
        $model->description = Arr::get($_POST,'description');
        $model->shownum = Arr::get($_POST,'shownum')? Arr::get($_POST,'shownum'):0;
        $model->redirecturl = Arr::get($_POST,'redirecturl');
        $model->kindlist = implode(',',$kindlist);//所属目的地
        $model->attrid = implode(',',Arr::get($_POST,'attrlist'));//属性
        $model->iconlist = implode(',',Arr::get($_POST,'iconlist'));//图标
        $model->modtime = time();
        $model->templet = $templet;
        $model->summary = $summary;
        $model->piclist = $piclist;
        $model->attachment = Arr::get($_POST,'attachment');



        if($action=='add' && empty($id))
        {

            $model->create();
        }
        else
        {
            $model->update();
        }
        Common::saveExtendData(4,$id,$_POST);//扩展信息保存

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

            $status = true;
        }
        echo json_encode(array('status'=>$status,'productid'=>$productid));

    }

    /*
    * 删除附件
    * */
    public function action_ajax_del_attach()
    {
        $id =Arr::get($_POST,'articleid');

        $doc = ORM::factory('article',$id)->get('attachment');

        if($doc)
        {
            $path = BASEPATH.$doc;
            @unlink($path);
        }
        echo json_encode(array('status'=>1));
    }






    /*
     * 下载远程图片到本地
     * */

    private  function dowloadPicture($content)
    {


        include(PUBLICPATH.'/vendor/httpdown.class.php');

        //截取内容图片路径正则
        $rule="/(src)=[\"|'| ]{0,}([^>]*\.(gif|jpg|bmp|png|jpeg))/isU";

        if(preg_match($rule,$content,$array))
        {

            $url=str_replace("\"","",$array[2]);

            if(strpos($url,'http://')===false)
            {
                return $url;
            }



            if(!stristr($url,$GLOBALS['cfg_basehost']))
            {

                $htd = new HttpDown();//实例化
                $htd->OpenUrl($url);


                $sparr = Array("image peg", "image/jpeg", "image/gif", "image/png", "image/xpng", "image/wbmp");
                if(!in_array($htd->GetHead("content-type"),$sparr))
                {
                    return '';
                }
                else
                {
                    $date=date("Ymd");
                    $name=date("YmdHis").rand(1,50);
                    $path=UPLOADPATH."/arcimgs/";

                    $url=$path.$date."/";
                    $imgUrl = $url.$name;


                    //创建路径
                    if(!file_exists($url))
                    {
                        mkdir($url);
                    }
                    $itype = $htd->GetHead("content-type");

                    if($itype=="image/gif")
                    {
                        $itype = '.gif';
                    }
                    else if($itype=="image/png")
                    {
                        $itype = '.png';
                    }
                    else if($itype=="image/wbmp")
                    {
                        $itype = '.bmp';
                    }
                    else
                    {
                        $itype = '.jpg';
                    }
                    $fileurl = $imgUrl.$itype;
                    $ok = $htd->SaveToBin($fileurl);
                    $litpic = $fileurl;


                    $litpic = Common::thumb($litpic,$litpic,240,180);

                    $litpic=str_replace(BASEPATH,'',$litpic);//去掉头
                    $litpic=str_replace('\\','/',$litpic);


                }

            }
            else
            {
                $litpic=$url;
            }

            return $litpic;



        }
    }
	

}
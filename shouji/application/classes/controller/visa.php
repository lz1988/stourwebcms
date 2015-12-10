<?php defined('SYSPATH') or die('No direct script access.');
class Controller_Visa extends Stourweb_Controller{

    public function before()
    {
        parent::before();
        $this->assign('seoinfo',Common::getChannelSeo(8));
        $this->assign('cmsurl', URL::site());
        $this->assign('website', Common::getWebUrl());
    }
     


    //线路目的地列表
	public function action_index(){
		//定位第一级目的地
		 $area=ORM::factory('visa_area')->where("pid=0 and isopen=1")->order_by("displayorder",'asc')->get_all();

         if(!empty($area)){
         	foreach ($area as $key => $value) {
         		$area[$key]['netslist']=ORM::factory('visa_area')->where("pid=".$value['id']." and isopen=1")->order_by("displayorder",'asc')->get_all();
         	}
         }

         //签证类型
         $visatype=ORM::factory('visa_kind')->where("isopen=1")->order_by("displayorder",'asc')->get_all();

         //签发城市
		 $visacity=ORM::factory('visa_city')->where("isopen=1")->order_by("displayorder",'asc')->get_all();

		 //推荐签证
		 $list = ORM::factory('visa')->where("ishidden=0")->order_by("displayorder",'asc')->limit("0,4")->get_all();
		 foreach ($list as $key => $value) {
		 	if(empty($value['litpic'])){
		 		$list[$key]['litpic'] = Common::getDefaultImage();
		 	}
		 }

         //print_r($list_one);

		 //数据压入
		 $this->assign('area',$area);
		 $this->assign('visatype',$visatype);
		 $this->assign('visacity',$visacity);
         $this->assign('list',$list);
         $this->display('visa/index');
	}
	 

	 //线路目的地产品列表(如果没有id则报错)
	public function action_list()
	{
		$action=$this->params['action'];
		$kindid=$this->params['id'];
		$kind=$this->params['kind'];
		$city=$this->params['city'];
		$page=$this->params['page'];
		$order=$this->params['order'];
		$w="ishidden=0";
		$w.=empty($kindid)?'':" and (areaid='".$kindid."' or nationid='".$kindid."')";
		$w.=empty($city)?'':" and cityid=".$city;
		$w.=empty($kind)?'':" and visatype=".$kind;

	
		//排序
		$orderby = empty($order)?'modtime':"price";
		$orderac = empty($order)?'desc':$order;

		//当前页数信息
		$page = empty($page)?'1':$page;
		//每页记录数
		$pagesize= 10;

		//开始记录数字
		$starnum = ($page-1)*$pagesize;
		//结速记录数字
		$limit = $starnum.','.$pagesize;
		
		//列表
		$list = ORM::factory('visa')->where($w)->order_by($orderby,$orderac)->limit($limit)->get_all();
		if(!empty($list)){
			foreach ($list as $key => $value) {
			 	if(empty($value['litpic'])){
			 		$list[$key]['litpic'] = Common::getDefaultImage();
			 	}
				$list[$key]['content'] = Common::cutstr_html($value['content'],40);
			}
		}

		if($action=="ajaxline"){
			echo json_encode($list);
			exit;
		}

		//目的地列表
		if(empty($kindid)){
			$idname = "签证国家";
			$area=ORM::factory('visa_area')->where("pid=0 and isopen=1")->order_by("displayorder",'asc')->get_all();
		}else{
			$selectarea=ORM::factory('visa_area')->where("id=".$kindid)->find()->as_array();
			$idname = $selectarea['kindname'];
			$pid = $selectarea['pid'];
			$area=ORM::factory('visa_area')->where("pid=".$kindid." and isopen=1")->order_by("displayorder",'asc')->get_all();
			if(empty($area)){
				$area=ORM::factory('visa_area')->where("pid=".$pid." and isopen=1")->order_by("displayorder",'asc')->get_all();
			}
		}

		//签证类型
		$typename= "签证类型";
        $visatype=ORM::factory('visa_kind')->where("isopen=1")->order_by("displayorder",'asc')->get_all();
        foreach ($visatype as $key => $value) {
        	if($value['id']==$kind){
        		$typename = $value['kindname'];
        	}
        }
         //签发城市
        $cityname= "签发城市";
		$visacity=ORM::factory('visa_city')->where("isopen=1")->order_by("displayorder",'asc')->get_all();
		foreach ($visacity as $key => $value) {
        	if($value['id']==$city){
        		$cityname = $value['kindname'];
        	}
        }

 		

 		//列表传递
        $this->assign('area',$area);
		$this->assign('visatype',$visatype);
        $this->assign('visacity',$visacity);



		//参数传递
		$this->assign('kindid',$this->params['id']);
		$this->assign('idname',$idname);
		$this->assign('cityname',$cityname);
		$this->assign('typename',$typename);
		$this->assign('pid',$pid);
        $this->assign('city',$this->params['city']);
		$this->assign('kind',$this->params['kind']);
        $this->assign('order',$order);

		$this->assign('list',$list);
		$this->display('visa/search');
	}

	//签证详情
    public function action_show(){
        $id=$this->params['id'];
        $tel=Common::getSysPara('cfg_phone');

        //详细信息
        $row =ORM::factory('visa')->where("id=$id")->find()->as_array();
        if(empty($row['litpic'])){
	 		$row['litpic'] = Common::getDefaultImage();
	 	}
        //签证国家
        if(!empty($row['nationid'])){
			 $area=ORM::factory('visa_area')->where("id=".$row['nationid'])->find()->as_array();
	         $row['country'] = $area['kindname'];
        }
        
        //签证类型
         if(!empty($row['visatype'])){
	        $visatype=ORM::factory('visa_kind')->where("id=".$row['visatype'])->find()->as_array();
	        $row['kindname'] = $visatype['kindname'];
        }
        //签发城市
         if(!empty($row['cityid'])){
	      	$visacity=ORM::factory('visa_city')->where("id=".$row['cityid'])->find()->as_array();
	      	$row['cityname'] = $visacity['kindname'];
      	}
        $this->assign('row',$row);
        $this->assign('phone',$tel);
        $this->display('visa/show');
    }

    //预订页面
    public function action_order()
    {
        $id=$this->params['id'];
        /*if(!isset($GLOBALS['userinfo']['mid']))
        {
            $forwardurl = URL::site('visa/order/id/'.$id);
            $this->request->redirect('user/login?forwardurl='.$forwardurl);

        }*/
        //详细信息
        $info =ORM::factory('visa')->where("id=$id")->find()->as_array();
        if(empty($info['litpic'])){
	 		$info['litpic'] = Common::getDefaultImage();
	 	}
        $this->assign('info',$info);
        $this->display('visa/order');
    }
}

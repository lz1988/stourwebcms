<?php defined('SYSPATH') or die('No direct script access.');
class Controller_Cars extends Stourweb_Controller{

    public function before()
    {
        parent::before();
        $this->assign('seoinfo',Common::getChannelSeo(3));
        $this->assign('cmsurl', URL::site());
        $this->assign('website', Common::getWebUrl());
    }
     


    //租车首页
	public function action_index(){

         //车型分类
         $cartype=ORM::factory('car_kind')->order_by("displayorder",'asc')->get_all();

         //租车类型
		 $carattr=ORM::factory('car_attr')->where("pid=0 and isopen=1")->order_by("displayorder",'asc')->get_all();
		 if(!empty($carattr)){
		 	foreach ($carattr as $key => $value) {
		 		$carattr[$key]['nextlist'] = ORM::factory('car_attr')->where("pid=".$value['id']." and isopen=1")->order_by("displayorder",'asc')->get_all();
		 	}
		 }

		 //租车价格
		 $carpricelist=ORM::factory('car_pricelist')->order_by("id",'asc')->get_all();

		 //推荐租车信息
		 //$list = ORM::factory('car')->select(array('id','id'))->where("ishidden=0 and carprice>0")->order_by("displayorder",'asc')->limit("0,4")->get_all();
		 $list = DB::select_array(array('id','title','litpic','price'))->from('car')->where("ishidden=0 and price>0")->order_by("displayorder",'asc')->limit("0,4")->execute()->as_array();
		 if(empty($list)){
		 	$sql="SELECT a.id,a.title,a.litpic,min(b.adultprice) as carprice FROM sline_car a LEFT JOIN sline_car_suit_price b ON (b.carid = a.id and b.adultprice!=0) WHERE a.ishidden=0 GROUP BY a.id ORDER BY a.displayorder ASC limit 0,4 ";
            $query = DB::query(Database::SELECT, $sql);
            $list = $query->execute()->as_array();
		 }
		 foreach ($list as $key => $value) {
		 	if(empty($value['litpic'])){
		 		$list[$key]['litpic'] = Common::getDefaultImage();
		 	}
		 	
		 }

		 //数据压入
		 $this->assign('cartype',$cartype);
		 $this->assign('carattr',$carattr);
		 $this->assign('carpricelist',$carpricelist);
         $this->assign('list',$list);
         $this->display('cars/index');
	}
	 

	 //租车产品列表(如果没有id则报错)
	public function action_list()
	{
		$action=$this->params['action'];
		$attr=$this->params['attr'];
		$kindid=$this->params['kindid'];
		$kind=$this->params['kind'];
		$price=$this->params['price'];
		$page=$this->params['page'];
		$order=$this->params['order'];

		$w="ishidden=0";
		$w.=empty($kind)?'':" and carkindid=".$kind;
		//$w.=empty($attr)?'':" and find_in_set($attr,attrid)";

        if(!empty($attr))
        {
           $attrid = explode(',',$attr);
           foreach($attrid as $v){
               $w .= " and find_in_set($v,attrid)";
           }
        }

        //$w.=empty($kindid)?'':" and find_in_set($kindid,kindlist)";
		//如果有价格选择
 		/*if($price>0){
 			$pricearr =ORM::factory('car_pricelist')->where("id=".$price)->find()->as_array();
 			$w.= " and carprice>=".intval($pricearr['min'])." and carprice<=".intval($pricearr['max']);
 		}*/

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
		$sql="SELECT a.*,min(b.adultprice) as carprice FROM sline_car a LEFT JOIN sline_car_suit_price b ON (b.carid = a.id and b.adultprice!=0) WHERE $w GROUP BY a.id ORDER BY $orderby $orderac  limit $limit  ";

        $query = DB::query(Database::SELECT, $sql);
        $list = $query->execute()->as_array();
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

		


        //车型分类
         $cartypename = "车辆类型";
         $cartype=ORM::factory('car_kind')->order_by("displayorder",'asc')->get_all();
         foreach ($cartype as $key => $value) {
         	if($value['id']==$kind){
        		$cartypename = $value['kindname'];
        	}
         }
 
         //租车类型
		 if(empty($attr)){
		 	$attrname="租车类别";
		 	$carattr=ORM::factory('car_attr')->where("pid=0 and isopen=1")->order_by("displayorder",'asc')->get_all();
		 }else{
            $attrid = explode(',',$attr);
		 	$temattr = ORM::factory('car_attr')->where("id=".$attrid[0])->find()->as_array();

		 	$attrname = $temattr['attrname'];
		 	$pid = $temattr['pid'];
		 	$carattr=ORM::factory('car_attr')->where("pid=".$attrid[0]." and isopen=1")->order_by("displayorder",'asc')->get_all();
		 	if(empty($carattr)){
		 		$carattr=ORM::factory('car_attr')->where("pid=".$pid." and isopen=1")->order_by("displayorder",'asc')->get_all();
		 	}
		 }
		 

		 //租车价格
		 $pricename= "价格区间";
		 $carpricelist=ORM::factory('car_pricelist')->order_by("id",'asc')->get_all();
		 foreach ($carpricelist as $key => $value) {
         	if($value['id']==$price){
        		$pricename = intval($value['min']).'-'.intval($value['max']);
        	}
         }
 		

 		//列表传递
        $this->assign('cartype',$cartype);
		$this->assign('attrlist',$carattr);
        $this->assign('pricelist',$carpricelist);



		//参数传递
		$this->assign('cartypename',$cartypename);
		$this->assign('attrname',$attrname);
		$this->assign('pricename',$pricename);
		$this->assign('kind',$this->params['kind']);
        $this->assign('attr',$this->params['attr']);
		$this->assign('price',$this->params['price']);
        $this->assign('order',$this->params['order']);

		$this->assign('list',$list);
		$this->display('cars/search');
	}

	//车辆详情
    public function action_show(){
        $id=$this->params['id'];

        //详细信息
        $row =ORM::factory('car')->where("id=$id")->find()->as_array();
        if(empty($row['litpic'])){
 			$row['litpic'] = Common::getDefaultImage();
 		}
        //车辆类型
        if(!empty($row['carkindid'])) {
            $cartype = ORM::factory('car_kind')->where("id=" . $row['carkindid'])->find()->as_array();
            $row['counkindname'] = $cartype['kindname'];
        }
        //车辆品牌
        //$carbrand=ORM::factory('car_brand')->where("id=".$row['carbrandid'])->find()->as_array();
        //$row['carbrand'] = $carbrand['kindname'];

        $row['attrname']=Model_Car_Attr::getAttrnameList($row['attrid']);

        $row['lineseries'] = Common::getSeries($row['id'],'03');//线路编号
        //产品图片
		if(!empty($row['piclist'])){
			$temarr = explode(",",$row['piclist']);
			foreach ($temarr as $key => $value) {
				$row['pic_arr'][$key] = explode("||",$value);
			}
		}
        $sql="SELECT min(b.adultprice) as carprice FROM sline_car a LEFT JOIN sline_car_suit_price b ON (b.carid = $id and b.adultprice!=0) WHERE a.ishidden=0 GROUP BY a.id ORDER BY a.displayorder ASC LIMIT 1";
        $query = DB::query(Database::SELECT, $sql);
        $list = $query->execute()->as_array();

        $this->assign('list',$list);
        $this->assign('row',$row);
        $this->display('cars/show');
    }

    //订车
    public function action_create(){

        $id=$this->params['id'];
       /* if(!isset($GLOBALS['userinfo']['mid']))
        {
            $forwardurl = URL::site('cars/create/id/'.$id);
            $this->request->redirect('user/login?forwardurl='.$forwardurl);

        }*/

        //详细信息
		$sql="SELECT min(b.adultprice) as carprice FROM sline_car a LEFT JOIN sline_car_suit_price b ON (b.carid = $id and b.adultprice!=0) WHERE a.ishidden=0 GROUP BY a.id ORDER BY a.displayorder ASC LIMIT 1";
        $query = DB::query(Database::SELECT, $sql);
        $list = $query->execute()->as_array();
		
        $row =ORM::factory('car')->where("id=$id")->find()->as_array();
        if(empty($row['litpic'])){
 			$row['litpic'] = Common::getDefaultImage();
 		}
        //车型套餐信息
        $room =ORM::factory('car_suit')->where("carid=$id")->order_by('displayorder','asc')->get_all();

        //价格开始时间，从今天开始,最近30条信息
		$BeginDate=strtotime(date("Y-m-d"));
		if(!empty($room)){
			foreach ($room as $key => $value) {
				if(empty($value['unit'])){
					$room[$key]['unit'] = '辆';
				}
				$temprice = ORM::factory('car_suit_price')->where("suitid=".$value['id']." and day>=$BeginDate")->order_by('day','asc')->limit('0,90')->get_all();
				if(empty($temprice)){
					$room[$key]['price_arr'] = array();
				}else{
					foreach ($temprice as $ke => $va) {
						$temprice[$ke]['dayid'] = $va['day'];
						$temprice[$ke]['day'] = date("Y-m-d",$va['day']);
					}
					$room[$key]['price_arr'] = $temprice;
				}
							
			}
		}
        $this->assign('list',$list);
        $this->assign('row',$row);
        $this->assign('room',$room);
        $this->display('cars/select');
    }


}

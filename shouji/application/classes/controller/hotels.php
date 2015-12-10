<?php defined('SYSPATH') or die('No direct script access.');
class Controller_Hotels extends Stourweb_Controller{

    public function before()
    {
        parent::before();
        $this->assign('seoinfo',Common::getChannelSeo(2));
        $this->assign('cmsurl', URL::site());
        $this->assign('website', Common::getWebUrl());
    }
     


    //线路目的地列表
	public function action_index(){
		$seoinfo = Common::getChannelSeo(2);

		//定位第一级目的地
		 $sql_one="select b.id,b.kindname from sline_hotel_kindlist as a left join sline_destinations b on (a.kindid=b.id and b.isopen=1 ) where b.pid=0 order by a.displayorder asc";

         $list_one=DB::query(Database::SELECT,$sql_one)->execute()->as_array();

		//定位第二级目的地

         if(!empty($list_one)){

         	foreach ($list_one as $key_one => $value_one) {
         		
         		$sql_tow="select b.id,b.kindname from sline_hotel_kindlist as a left join sline_destinations b on (a.kindid=b.id and b.isopen=1 ) where b.pid=".$value_one['id']." order by a.displayorder asc";

         		$list_tow=DB::query(Database::SELECT,$sql_tow)->execute()->as_array();
         		//定位第三级目的地
         		if(!empty($list_tow)){
         			foreach ($list_tow as $key_tow => $value_tow) {
         				
         				$sql_three="select b.id,b.kindname from sline_hotel_kindlist as a left join sline_destinations b on (a.kindid=b.id and b.isopen=1 ) where b.pid=".$value_tow['id']." order by a.displayorder asc";

		         		$list_three=DB::query(Database::SELECT,$sql_three)->execute()->as_array();

		         		$list_tow[$key_tow]['nextlist'] = $list_three; //附加数组到上一级

         			}
         		}

         		$list_one[$key_one]['nextlist'] = $list_tow;	//附加数组到上一级

         	}
         }



         //酒店星级
         $hoteltype=ORM::factory('hotel_rank')->order_by("orderid",'asc')->get_all();

         //酒店价格
		 $pricelist=ORM::factory('hotel_pricelist')->where("webid=0")->order_by("min",'asc')->get_all();

		 //推荐酒店
		 $list=ORM::factory('hotel')->where("ishidden=0 and price>0")->limit('0,4')->get_all();
		 if(empty($list)){
		 	$list=ORM::factory('hotel')->where("ishidden=0")->limit('0,4')->get_all();
		 }
		 foreach ($list as $key => $value) {
		 	if(empty($value['litpic'])){
		 		$list[$key]['litpic'] = Common::getDefaultImage();
		 	}
		 	
		 }

         //print_r($seoinfo);
         $this->assign('citylist',$list_one);
         $this->assign('typelist',$hoteltype);
         $this->assign('pricelist',$pricelist);
         $this->assign('list',$list);
         $this->display('hotels/index');
	}
	 

	//产品列表Array ( [city] => 36 [star] => 2 [price] => 2 [key] => adfg )
	public function action_list()
	{
		$action=Arr::get($_GET,'action');
		$city=Arr::get($_GET,'city');
		$star=Arr::get($_GET,'star');
		$price=Arr::get($_GET,'price');
		$keyword=Arr::get($_GET,'key');
		$page=Arr::get($_GET,'page');
		$order=Arr::get($_GET,'order');

		$w="a.id is not null and ishidden=0";
		
		if($city>0){
			$w.=" and find_in_set($city,a.kindlist)";
		}
		if($star>0){
			$w.=" and a.hotelrankid='$star'";
		}
	
		if(empty($city)){
			$w.=empty($keyword)?'':" and a.title like '%{$keyword}%' ";
		}

		//如果有价格选择
 		if($price>0){
 			$pricearr =ORM::factory('hotel_pricelist')->where("id=$price")->find()->as_array();
 			$w.= " and a.price>=".intval($pricearr['min'])." and a.price<=".intval($pricearr['max']);
 		}
		//排序
		$orderby = empty($order)?'order by a.modtime desc':"order by a.price $order";

		//当前页数信息
		$page = empty($page)?'1':$page;
		//每页记录数
		$pagesize= 10;

		//开始记录数字
		$starnum = ($page-1)*$pagesize;
		//结速记录数字
		$limit = $starnum.','.$pagesize;

		if(empty($city))
		{
		   $sql="select a.id,a.aid,a.title,a.kindlist,a.attrid,a.hotelrankid,a.price,a.litpic,a.ishidden,ifnull(b.displayorder,9999) as displayorder from sline_hotel as a left join sline_allorderlist b on (a.id=b.aid and b.typeid=2) where $w $orderby limit $limit";
		}
		else
		{
			$sql="select a.id,a.aid,a.title,a.kindlist,a.attrid,a.hotelrankid,a.price,a.litpic,a.ishidden,ifnull(b.displayorder,9999) as displayorder from sline_hotel as a left join sline_kindorderlist as b on (b.classid=$city and a.id=b.aid and b.typeid=2) where $w $orderby limit $limit";
		}

		$list=DB::query(Database::SELECT,$sql)->execute()->as_array();

		foreach ($list as $key => $value) {

		 	if(empty($value['litpic'])){
		 		$list[$key]['litpic'] = Common::getDefaultImage();
		 	}
			 $hoteltype=ORM::factory('hotel_rank')->where("aid=".intval($value['hotelrankid']))->find()->as_array();
			 $list[$key]['randname'] = $hoteltype['hotelrank'];
			 $list[$key]['attrname']=Model_Hotel_Attr::getAttrnameList($value['attrid']);
		}

		if($action=="ajaxline"){
			echo json_encode($list);
			exit;
		}

		//目的地列表
		$cityname = "目的地";
		if(empty($city)){
			$sql_one="select b.id,b.kindname from sline_hotel_kindlist as a left join sline_destinations b on (a.kindid=b.id and b.isopen=1 ) where b.pid=0 order by a.displayorder asc";
         	$kindlist=DB::query(Database::SELECT,$sql_one)->execute()->as_array();
		}else{
			$pidkind =ORM::factory('destinations')->where("id=$city")->find()->as_array();
			$cityname = $pidkind['kindname'];
			$pid = $pidkind['pid'];
			$sqlkind="select b.id,b.kindname from sline_hotel_kindlist as a left join sline_destinations b on (a.kindid=b.id and b.isopen=1 ) where b.pid=".$city." order by a.displayorder asc";
	 		$kindlist=DB::query(Database::SELECT,$sqlkind)->execute()->as_array();
	 		if(empty($kindlist)){
	 			$pid = $pidkind['pid'];
	 			$sqlkind="select b.id,b.kindname from sline_hotel_kindlist as a left join sline_destinations b on (a.kindid=b.id and b.isopen=1 ) where b.pid=".$pid." order by a.displayorder asc";
	 			$kindlist=DB::query(Database::SELECT,$sqlkind)->execute()->as_array();
	 		}
		}
		

 		 //酒店星级
		 $typename= "酒店星级";
         $hoteltype=ORM::factory('hotel_rank')->order_by("orderid",'asc')->get_all();
         foreach ($hoteltype as $key => $value) {
        	if($value['id']==$star){
        		$typename = $value['hotelrank'];
        	}
         }

         //酒店价格
         $pricename="酒店价格";
		 $pricelist=ORM::factory('hotel_pricelist')->where("webid=0")->order_by("min",'asc')->get_all();
		 foreach ($pricelist as $key => $value) {
        	if($value['id']==$price){
        		$pricename = intval($value['min']).'-'.intval($value['max']);
        	}
        }

 		//筛选数据传递
 		$this->assign('kindlist',$kindlist);
        $this->assign('typelist',$hoteltype);
        $this->assign('pricelist',$pricelist);

		//参数传递
		$this->assign('cityname',$cityname);
		$this->assign('typename',$typename);
		$this->assign('pricename',$pricename);
		$this->assign('city',$city);
        $this->assign('star',$star);
		$this->assign('price',$price);
        $this->assign('key',$keyword);
        $this->assign('order',$order);

		$this->assign('list',$list);
		$this->display('hotels/search');
	}

	//酒店详情
    public function action_show(){

        $id=$this->params['id'];

        //详细信息
        $row =ORM::factory('hotel')->where("id=$id")->find()->as_array();
        if(empty($row['litpic'])){
	 		$row['litpic'] = Common::getDefaultImage();
	 	}
        //酒店星级
        $hoteltype=ORM::factory('hotel_rank')->where("aid=".intval($row['hotelrankid']))->find()->as_array();
        $row['randname'] = $hoteltype['hotelrank'];

        //酒店属性
	 	$row['attrname']=Model_Hotel_Attr::getAttrnameList($row['attrid']);
	 	$row['series'] = Common::getSeries($row['id'],'02');//编号

	 	//产品图片
		if(!empty($row['piclist'])){
			$temarr = explode(",",$row['piclist']);
			foreach ($temarr as $key => $value) {
				$row['pic_arr'][$key] = explode("||",$value);
			}
		}

        $this->assign('row',$row);
        $this->display('hotels/show');
    }

    //酒店预订
    public function action_create(){

        $id=$this->params['id'];
      /*  if(!isset($GLOBALS['userinfo']['mid']))
        {
            $forwardurl = URL::site('hotels/create/id/'.$id);
            $this->request->redirect('user/login?forwardurl='.$forwardurl);

        }*/

        //详细信息
        $row =ORM::factory('hotel')->where("id=$id")->find()->as_array();
        if(empty($row['litpic'])){
	 		$row['litpic'] = Common::getDefaultImage();
	 	}
	 	
        //房型信息
        $room =ORM::factory('hotel_room')->where("hotelid=$id")->order_by('displayorder','asc')->get_all();

        //价格开始时间，从今天开始,最近30条信息
		$BeginDate=strtotime(date("Y-m-d"));
		if(!empty($room)){
			foreach ($room as $key => $value) {
				switch ($value['breakfirst']) {
					case '含':
						$room[$key]['breakfast'] = '含餐';
						break;
					case '不含':
						$room[$key]['breakfast'] = '不含餐';
						break;

					default:
						$room[$key]['breakfast'] = $value['breakfirst'];
						break;
				}
				switch ($value['computer']) {
					case '含':
						$room[$key]['computer'] = '有宽带';
						break;
					case '不含':
						$room[$key]['computer'] = '无宽带';
						break;

					default:
						$room[$key]['computer'] = $value['computer'];
						break;
				}

				$temprice = ORM::factory('hotel_room_price')->where("suitid=".$value['id']." and day>=$BeginDate")->order_by('day','asc')->limit('0,90')->get_all();
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



        $this->assign('row',$row);
        $this->assign('room',$room);
        $this->display('hotels/select');
    }

    
}

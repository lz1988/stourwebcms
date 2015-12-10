<?php defined('SYSPATH') or die('No direct script access.');
class Controller_Lines extends Stourweb_Controller{

    public function before()
    {
        parent::before();
        $this->assign('seoinfo',Common::getChannelSeo(1));
        $this->assign('cmsurl', URL::site());
        $this->assign('website', Common::getWebUrl());
    }
     


    //线路目的地列表
	public function action_index(){
		
		//定位开启了首页显示的目的地
        $sql="select b.id,b.kindname from sline_line_kindlist as a left join sline_destinations b on (a.kindid=b.id) where a.isnav=1 and b.isopen=1 order by a.displayorder asc";

        $data = DB::query(Database::SELECT,$sql)->execute()->as_array();
		
		//开启首页显示目的地的信息，每个目的地显示4条数据
		if(!empty($data)){
            foreach ($data as $key => $value) {
				$temsql = $sql="select a.id,a.title,a.price,a.litpic,a.ishidden,IFNULL(b.displayorder,9999) as displayorder from sline_line as a left join sline_kindorderlist b on (a.id=b.aid and b.typeid=1 and b.classid=".$value[id].") where find_in_set(".$value['id'].",a.kindlist) and a.ishidden=0 order by displayorder asc limit 0,4";
                $temarr =  DB::query(Database::SELECT,$temsql)->execute()->as_array();
                //去掉html标记
                foreach ($temarr as $key1 => $value1) {
					if(empty($value1['litpic'])){
						$temarr[$key1]['litpic'] = Common::getDefaultImage();

					}
                    $temarr[$key1]['lineprice'] = Model_Line::getMinPrice($value1['id']);
				} 
                $data[$key]['list'] = $temarr;
            }

            foreach ($data as $key => $value) {
                if(empty($value['list'])){
                    unset($data[$key]);
                }
            }
        }
         //print_r($data);
         $this->assign('data',$data);
         $this->display('lines/index');
	}
	 

	 //线路目的地产品列表(如果没有id则报错)
	public function action_list()
	{
		$action=Arr::get($_GET,'action');
		$kindid=Arr::get($_GET,'kindid');
		$days=Arr::get($_GET,'days');
		$attrid=Arr::get($_GET,'attrid');
		$pricetyle=Arr::get($_GET,'pricetyle');
		$page=Arr::get($_GET,'page');
		$order=Arr::get($_GET,'order');

		$keyword=Arr::get($_GET,'key');
		$w="a.id is not null and ishidden=0";
		$w.=empty($kindid)?'':" and find_in_set($kindid,a.kindlist)";
		$w.=empty($attrid)?'':" and find_in_set($attrid,a.attrid)";
		$w.=empty($days)?'':" and a.lineday=$days";

		if(empty($kindid)){
			$w.=empty($keyword)?'':" and a.title like '%{$keyword}%'";
		}

		//如果有价格选择
 		if($pricetyle>0){
 			$pricearr =ORM::factory('line_pricelist')->where("id=$pricetyle and webid=0")->find()->as_array();
 			$w.= " and a.price>=".intval($pricearr['lowerprice'])." and a.price<=".intval($pricearr['highprice']);
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
		if($kindid!=0){
			$sql="select a.id,a.aid,a.title,a.satisfyscore,a.price,a.attrid,a.kindlist,a.ishidden,a.litpic,IFNULL(b.displayorder,9999) as displayorder from sline_line as a left join sline_kindorderlist b on (a.id=b.aid and b.typeid=1 and b.classid=$kindid)  where $w $orderby limit  $limit";
		}else{
			$sql="select a.id,a.aid,a.title,a.satisfyscore,a.price,a.attrid,a.kindlist,a.ishidden,a.litpic,IFNULL(b.displayorder,9999) as displayorder from sline_line as a left join sline_allorderlist b on (a.id=b.aid and b.typeid=1)  where $w $orderby limit  $limit";
		}
		$list=DB::query(Database::SELECT,$sql)->execute()->as_array();
		foreach ($list as $key => $value) {
		 	if(empty($value['litpic'])){
		 		$list[$key]['litpic'] = Common::getDefaultImage();

		 	}
            $list[$key]['lineprice'] = Model_Line::getMinPrice($value['id']);
		 	
		 }
		
		if($action=="ajaxline"){
			echo json_encode($list);
			exit;
		}

 		//目的地列表
		$cityname = "目的地";
		if(empty($kindid)){
			$sql_one="select b.id,b.kindname from sline_line_kindlist as a left join sline_destinations b on (a.kindid=b.id and b.isopen=1 ) where b.pid=0 order by a.displayorder asc";
         	$kindlist=DB::query(Database::SELECT,$sql_one)->execute()->as_array();
		}else{
			$pidkind =ORM::factory('destinations')->where("id=$kindid")->find()->as_array();
			$cityname = $pidkind['kindname'];
			$pid = $pidkind['pid'];
			$sqlkind="select b.id,b.kindname from sline_line_kindlist as a left join sline_destinations b on (a.kindid=b.id and b.isopen=1 ) where b.pid=".$kindid." order by a.displayorder asc";
	 		$kindlist=DB::query(Database::SELECT,$sqlkind)->execute()->as_array();
	 		if(empty($kindlist)){
	 			$pid = $pidkind['pid'];
	 			$sqlkind="select b.id,b.kindname from sline_line_kindlist as a left join sline_destinations b on (a.kindid=b.id and b.isopen=1 ) where b.pid=".$pid." order by a.displayorder asc";
	 			$kindlist=DB::query(Database::SELECT,$sqlkind)->execute()->as_array();
	 		}
		}

 		//行程天数列表
 		$daysname = "行程天数";
 		$daylist = ORM::factory('line_day')->where("webid=0")->get_all();
 		foreach ($daylist as $key => $value) {
        	if($value['id']==$days){
        		$daysname = $value['word'].'日游';
        	}
         }
 		//出游方式列表
        $travelname = "出游方式";
        if(empty($attrid)){
			$travellist = ORM::factory('line_attr')->where("webid=0 and pid=0")->order_by("displayorder",'asc')->get_all();
        }else{
        	$temattr = ORM::factory('line_attr')->where("id=".$attrid)->find()->as_array();
		 	$travelname = $temattr['attrname'];
		 	$pid = $temattr['pid'];
		 	$travellist=ORM::factory('line_attr')->where("pid=".$attrid." and webid=0")->order_by("displayorder",'asc')->get_all();
		 	if(empty($travellist)){
		 		$travellist=ORM::factory('line_attr')->where("pid=".$pid." and webid=0")->order_by("displayorder",'asc')->get_all();
		 	}
        }
 		

 		//价格区间列表
        $pricename = "价格区间";
 		$pricelist = ORM::factory('line_pricelist')->where("webid=0")->get_all();
 		foreach ($pricelist as $key => $value) {
        	if($value['id']==$pricetyle){
        		$pricename = intval($value['lowerprice']).'-'.intval($value['highprice']);
        	}
         }

 		//列表传递
 		$this->assign('kindlist',$kindlist);
        $this->assign('dayslist',$daylist);
		$this->assign('attrlist',$travellist);
        $this->assign('pricelist',$pricelist);



		//参数传递
		$this->assign('kindid',$kindid);
		$this->assign('pricename',$pricename);
		$this->assign('travelname',$travelname);
		$this->assign('daysname',$daysname);
		$this->assign('kindname',$cityname);
		$this->assign('pid',$pid);
        $this->assign('days',$days);
		$this->assign('attrid',$attrid);
        $this->assign('pricetyle',$pricetyle);
        $this->assign('order',$order);

        $this->assign('key',$keyword);
		$this->assign('list',$list);
		$this->display('lines/list');
	}


	//产品详情
	public function action_show()
	{
		$tel=Common::getSysPara('cfg_phone');
		$lineid=$this->params['id'];
		if(empty($lineid)){
			echo "产品信息错误！";
			exit;
		}
		//产品信息
		$row =ORM::factory('line')->where("id=$lineid")->find()->as_array();
        $row['lineprice'] = Model_Line::getMinPrice($lineid);
	 	if(empty($row['litpic'])){
	 		$row['litpic'] = Common::getDefaultImage();
	 	}

		$row['lineseries'] = Common::getSeries($row['id'],'01');//线路编号
		$row['satisfyscore']=empty($row['satisfyscore'])?$row['satisfyscore']:$row['satisfyscore'].'%';

		//如果行程类型为2
		if($row['isstyle']=='2'){
			$temjeishao = ORM::factory('line_jieshao')->where("lineid=".$row['id'])->order_by("day",'asc')->limit($row['lineday'])->get_all();
			
			/*foreach ($temjeishao as $key => $value) {
				//$value['jieshao'] = strip_tags($value['jieshao']);
				//$value['jieshao'] = Common::clearHtml($value['jieshao']);
				$temjeishao[$key]['jieshao'] = $value['jieshao'];
			}*/
			$row['linejieshao_arr']=$temjeishao;
		}
        else
        {

        }

		//产品图片
		if(!empty($row['piclist'])){
			$temarr = explode(",",$row['piclist']);
			foreach ($temarr as $key => $value) {
				$row['pic_arr'][$key] = explode("||",$value);
			}
		}

		$this->assign('linedisc',ORM::factory('line_content')->where("webid=0 and isopen=1 and isline=0 and columnname<>'linespot'")->order_by("displayorder",'asc')->get_all());

		$this->assign('row',$row);
		$this->assign('phone',$tel);
		$this->display('lines/show');

	}

	//产品预订
	public function action_create()
	{

        $lineid=$this->params['id'];
        /*if(!isset($GLOBALS['userinfo']['mid']))
        {
            $forwardurl = URL::site('lines/create/id/'.$lineid);
            $this->request->redirect('user/login?forwardurl='.$forwardurl);

        }*/
        $row =ORM::factory('line')->where("id=$lineid")->find()->as_array();
        if(empty($row['litpic'])){
            $row['litpic'] = Common::getDefaultImage();
        }
        $row['lineprice'] = Model_Line::getMinPrice($row['id']);
        $suit =ORM::factory('line_suit')->where("lineid=$lineid")->get_all();

        $dayBeforeNum=empty($row['linebefore'])?0:$row['linebefore'];
        //价格开始时间，从今天开始,最近30条价格信息
        $BeginDate=strtotime(date("Y-m-d"))+$dayBeforeNum*24*60*60;


        //套餐价格
        if(!empty($suit)){
            foreach ($suit as $key => $value) {
                $price_arr=ORM::factory('line_suit_price')->where("suitid=".$value['id']." and day>$BeginDate and adultprice>0")->order_by('day','asc')->limit('0,90')->get_all();
                if(empty($price_arr)){
                    $suit[$key]['price_arr'] = array();
                }else{
                    foreach ($price_arr as $ke => $va) {
                        $price_arr[$ke]['dayid'] = $va['day'];
                        $price_arr[$ke]['day'] = date("Y-m-d",$va['day']);
                        $price_arr[$ke]['suitid'] = $va['suitid'];
                    }
                    $suit[$key]['price_arr'] = $price_arr;
                }
            }
        }
        //var_dump($suit[0]['price_arr']);
        $this->assign('row',$row);
        $this->assign('suit',$suit);
        $this->display('lines/select');
	}

}

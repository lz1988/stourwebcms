<?php defined('SYSPATH') or die('No direct script access.');
class Controller_Spot extends Stourweb_Controller{

    public function before()
    {
        parent::before();
        $this->assign('seoinfo',Common::getChannelSeo(5));
        $this->assign('cmsurl', URL::site());
        $this->assign('website', Common::getWebUrl());
    }
     


    //线路目的地列表
	public function action_index(){
		//定位第一级目的地
		 $sql_one="select b.id,b.kindname from sline_spot_kindlist as a left join sline_destinations b on (a.kindid=b.id and b.isopen=1 ) where b.pid=0 order by a.displayorder asc";

         $list_one=DB::query(Database::SELECT,$sql_one)->execute()->as_array();
		 $order="order by displayorder asc,a.modtime desc";
		 if(!empty($list_one)){
			 foreach($list_one as $k=>$v){
			 	$w="find_in_set(".$v['id'].",a.kindlist)";
			 	$sql="select a.aid,a.id,a.title,a.price,a.tagword,a.kindlist,a.attrid,a.litpic,a.webid,a.piclist,a.themelist,a.iconlist,a.supplierlist,a.ishidden,b.isjian,ifnull(b.displayorder,9999) as displayorder,b.isding from sline_spot as a left join sline_kindorderlist as b on (b.classid={$v['id']} and a.id=b.aid and b.typeid=5) where $w $order limit 0,4";
				$list_arr=DB::query(Database::SELECT,$sql)->execute()->as_array();
				if(!empty($list_arr)){
					foreach ($list_arr as $key2 => $value2) {
					 	if(empty($value2['litpic'])){
					 		$list_arr[$key2]['litpic'] = Common::getDefaultImage();
					 	}
					 	
					 }
					$list_one[$k]['list_arr'] = $list_arr;
				}else{
					unset($list_one[$k]);
				}
			 }
		 }
         $this->assign('list',$list_one);
         $this->display('spot/index');
	}
	 

	 //线路目的地产品列表(如果没有id则报错)
	public function action_list()
	{

		$action=Arr::get($_GET,'action');
		$kindid=Arr::get($_GET,'kindid');
		$starid=Arr::get($_GET,'starid');
		$attrid=Arr::get($_GET,'attrid');
		$pricetyle=Arr::get($_GET,'pricetyle');
		$page=Arr::get($_GET,'page');
		$order=Arr::get($_GET,'order');
		$keyword=Arr::get($_GET,'key');


		$w="a.id is not null and ishidden=0";

		if(empty($kindid)){
			$w.=empty($keyword)?'':" and a.title like '%{$keyword}%'";
		}

		$w.=empty($kindid)?'':" and find_in_set($kindid,a.kindlist)";
		$w.=empty($attrid)?'':" and find_in_set($attrid,a.attrid)";
		$w.=empty($starid)?'':" and find_in_set($starid,a.attrid)";

		//如果有价格选择
 		if($pricetyle>0){
 			$pricearr =ORM::factory('spot_pricelist')->where("id=$pricetyle and webid=0")->find()->as_array();
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

		
		if(empty($kindid))
		{
		  $sql="select a.aid,a.id,a.title,a.price,a.area,a.spotpicid,a.tagword,a.kindlist,a.attrid,a.litpic,a.webid,a.piclist,a.satisfyscore,a.themelist,a.iconlist,a.supplierlist,a.ishidden,b.isjian,ifnull(b.displayorder,9999) as displayorder,b.isding from sline_spot as a left join sline_allorderlist b on (a.id=b.aid and b.typeid=5) where $w $orderby  limit $limit ";
		}
		else
		{
		  $sql="select a.aid,a.id,a.title,a.price,a.area,a.spotpicid,a.tagword,a.kindlist,a.attrid,a.litpic,a.webid,a.piclist,a.satisfyscore,a.themelist,a.iconlist,a.supplierlist,a.ishidden,b.isjian,ifnull(b.displayorder,9999) as displayorder,b.isding from sline_spot as a left join sline_kindorderlist as b on (b.classid={$kindid} and a.id=b.aid and b.typeid=5) where $w $orderby limit $limit";
		}
		$list=DB::query(Database::SELECT,$sql)->execute()->as_array();
		$new_list=array();
		foreach($list as $k=>$v)
		{
		 	if(empty($v['litpic'])){
		 		$v['litpic'] = Common::getDefaultImage();
		 	}
			$v['kindname']=Model_Destinations::getKindnameList($v['kindlist']);
		    $v['attrname']=Model_Spot_Attr::getAttrnameList($v['attrid']);
            $v['series'] = Common::getSeries($v['id'],'05');//编号
            $new_list[]=$v;
        }
        if($action=="ajaxline"){
			echo json_encode($new_list);
			exit;
		}

		//目的地列表
		$kindname = '目的地';
		if(empty($kindid)){
			$pid = 0;
 			$sqlkind="select b.id,b.kindname from sline_spot_kindlist as a left join sline_destinations b on (a.kindid=b.id and b.isopen=1 ) where b.pid=".$pid." order by a.displayorder asc";
 			$kindlist=DB::query(Database::SELECT,$sqlkind)->execute()->as_array();
		}else{
			$pidkind =ORM::factory('destinations')->where("id=$kindid")->find()->as_array();
			$kindname = $pidkind['kindname'];
			$pid = $kindid;
			$sqlkind="select b.id,b.kindname from sline_spot_kindlist as a left join sline_destinations b on (a.kindid=b.id and b.isopen=1 ) where b.pid=".$kindid." order by a.displayorder asc";
	 		$kindlist=DB::query(Database::SELECT,$sqlkind)->execute()->as_array();
	 		if(empty($kindlist)){
	 			$sqlkind="select b.id,b.kindname from sline_spot_kindlist as a left join sline_destinations b on (a.kindid=b.id and b.isopen=1 ) where b.pid=".$pidkind['pid']." order by a.displayorder asc";
 				$kindlist=DB::query(Database::SELECT,$sqlkind)->execute()->as_array();
	 		}
		}
		

		//景点星级类型
		$starname="景点星级";
 		$starlist = ORM::factory('spot_attr')->where("webid=0 and pid=2")->get_all();
 		foreach ($starlist as $key => $value) {
 			if($value['id']==$starid){
 				$starname=$value['attrname'];
 			}
 		}
 		//出景点类型
 		$travelname="景点类型";
 		$travellist = ORM::factory('spot_attr')->where("webid=0 and pid=1")->get_all();
 		foreach ($travellist as $key => $value) {
 			if($value['id']==$attrid){
 				$travelname=$value['attrname'];
 			}
 		}
 		//价格区间列表
 		$pricename = "价格区间";
 		$pricelist = ORM::factory('spot_pricelist')->where("webid=0")->get_all();
 		foreach ($pricelist as $key => $value) {
 			if($value['id']==$pricetyle){
 				$pricename=intval($value['min'])."-".intval($value['max']);
 			}
 		}
 		//列表传递
 		$this->assign('kindlist',$kindlist);
        $this->assign('starlist',$starlist);
		$this->assign('attrlist',$travellist);
        $this->assign('pricelist',$pricelist);



		//参数传递
		$this->assign('kindid',intval($this->params['kindid']));
		if(!empty($key)){
			$this->assign('kindname',$key);
		}else{
			$this->assign('kindname',$kindname);
		}
		
		
		$this->assign('pid',$pid);
		$this->assign('cityname',$kindname);
		$this->assign('starname',$starname);
		$this->assign('travelname',$travelname);
		$this->assign('pricename',$pricename);
        $this->assign('starid',$starid);
		$this->assign('attrid',$attrid);
        $this->assign('pricetyle',$pricetyle);
        $this->assign('order',$order);
        $this->assign('key',$keyword);
		$this->assign('kindid',$kindid);
		$this->assign('list',$new_list);
		$this->display('spot/search');
	}

	//产品详情
	public function action_show()
	{
		$lineid=$this->params['id'];
		if(empty($lineid)){
			echo "产品信息错误！";
			exit;
		}
		//产品信息
		$row =ORM::factory('spot')->where("id=$lineid")->find()->as_array();

		$row['kindname']=Model_Destinations::getKindnameList($row['kindlist']);
		$row['attrname']=Model_Spot_Attr::getAttrnameList($row['attrid']);

		$row['lineseries'] = Common::getSeries($row['id'],'05');//线路编号


		//产品图片
		if(!empty($row['piclist'])){
			$temarr = explode(",",$row['piclist']);
			foreach ($temarr as $key => $value) {
				$row['pic_arr'][$key] = explode("||",$value);
			}
		}

		//相关产品
		if(empty($row['kindlist'])){
			$otherarr = array();	
		}else{
			$temarr = explode(",",trim($row['kindlist'],','));
			$endnum = count($temarr)-1;
			$kindlistid = $temarr[$endnum];
			$sql="select a.id,a.title,a.price,a.attrid,a.litpic,a.satisfyscore,ifnull(b.displayorder,9999) as displayorder from sline_spot as a left join sline_kindorderlist as b on (b.classid={$kindlistid} and a.id=b.aid and b.typeid=5) order by displayorder asc limit 0,4";
			$otherarr=DB::query(Database::SELECT,$sql)->execute()->as_array();
			foreach ($otherarr as $key => $value) {
				$otherarr[$key]['attrname']=Model_Spot_Attr::getAttrnameList($value['attrid']);
			}
		}
		$this->assign('row',$row);
		$this->assign('other',$otherarr);
		$this->display('spot/show');

	}

	//产品预订
	public function action_create()
	{
		$lineid=$this->params['id'];
		/*if(!isset($GLOBALS['userinfo']['mid']))
        {
            $forwardurl = URL::site('spot/create/id/'.$lineid);
            $this->request->redirect('user/login?forwardurl='.$forwardurl);

        }*/
		$row =ORM::factory('spot')->where("id=$lineid")->find()->as_array();
		if(empty($row['litpic'])){
 			$row['litpic'] = Common::getDefaultImage();
 		}
		$suit =ORM::factory('spot_ticket')->where("spotid=$lineid")->get_all();
        foreach($suit as $key=>$value)
        {
            $suit[$key]['tickettype'] = ORM::factory('spot_ticket_type',$value['tickettypeid'])->get('kindname');
        }
		
		$this->assign('row',$row);
		$this->assign('suit',$suit);
		$this->display('spot/select');
	}

}

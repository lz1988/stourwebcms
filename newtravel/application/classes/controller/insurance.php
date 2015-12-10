<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/5/5 0005
 * Time: 11:46
 */
class Controller_Insurance extends Stourweb_Controller
{
    public function before()
    {
        parent::before();
        $action = $this->request->action();
        if ($action == 'index') {
            $param = $this->params['action'];
            $right = array(
                'read' => 'slook',
                'save' => 'smodify',
                'delete' => 'sdelete',
                'update' => 'smodify'
            );
            $user_action = $right[$param];
            if (!empty($user_action))
                Common::getUserRight('insurance', $user_action);
        }
        if ($action == 'huizhe') {
            Common::getUserRight('insurance', 'smodify');
        }
        if ($action == 'ajax_huizhe_list') {
            Common::getUserRight('insurance', 'sread');
        }
        if ($action == 'ajax_huizhe_update') {
            Common::getUserRight('insurance', 'smodify');
        }
        //  $this->assign('cmsurl', URL::site());
        $this->assign('parentkey', $this->params['parentkey']);
        $this->assign('itemid', $this->params['itemid']);
        $this->assign('weblist', Common::getWebList());

    }

    //保险订单列表
    public function action_book()
    {
        $action = $this->params['action'];
        if (empty($action))  //显示列表
        {
            $this->display('stourtravel/insurance/book');
        } else if ($action == 'read')    //读取列表
        {
            $start = Arr::get($_GET, 'start');
            $limit = Arr::get($_GET, 'limit');
            $keyword = Arr::get($_GET, 'keyword');
            $searchfield = $_GET['searchfield'];
            $sort = json_decode(Arr::get($_GET, 'sort'));
            $order = 'order by id desc';
            $w = ' where id is not null';
            if (!empty($keyword)) {
                if ($searchfield == 'memberaccount') {
                    //  DB::query(Database::SELECT, )->execute()->as_array();
                    $keyword = '13';
                    $memberids = DB::query(Database::SELECT, "select mid as num from sline_member where phone like :keyword ")->parameters(array(':keyword' => '%' . $keyword . '%'))->execute()->get_all();
                    $mids = array();
                    foreach ($memberids as $v) {
                        $mids[] = $v['mid'];
                    }
                    if (!empty($mids)) {
                        $w .= " and find_in_set(memberid,'" . implode(',', $mids) . "'')";
                    }
                } else {
                    $w .= " and `$searchfield` like :keyword";
                }
            }
            if ($sort[0]->property) {
                $order = 'order by ' . $sort[0]->property . ' ' . $sort[0]->direction;
            }
            $sql = "select *  from sline_insurance_booking $w $order limit $start,$limit";
            $totalcount_arr = DB::query(Database::SELECT, "select count(*) as num from sline_insurance_booking $w $order ")->parameters(array(':keyword' => '%' . $keyword . '%'))->execute()->as_array();
            $list = DB::query(Database::SELECT, $sql)->parameters(array(':keyword' => '%' . $keyword . '%'))->execute()->as_array();
            $new_list = array();
            foreach ($list as $k => $v) {
                $v['memberaccount'] = $v['memberid'] ? ORM::factory('member', $v['memberid'])->mobile : '';
                $v['title'] = ORM::factory('member_order')->where('ordersn', '=', $v['bookordersn'])->find()->get('productname');
                $v['productcasename'] = ORM::factory('insurance')->where('productcode', '=', $v['productcasecode'])->find()->get('productname');
                $v['addtime']=date('Y-m-d',$v['addtime']);
                $v['payedtime']=empty($v['payedtime'])?'':date('Y-m-d',$v['payedtime']);
                $paystatus=ORM::factory('member_order')->where('ordersn', '=', $v['bookordersn'])->find()->get('status');
                if($paystatus==2&&$v['status']==0)
                {
                    $bookModel=ORM::factory('insurance_booking',$v['id']);
                    $bookModel->status=1;
                    $bookModel->save();
                    $v['status']=1;
                }
               // $v['status']=$paystatus==2&&
                $new_list[] = $v;
            }
            $result['total'] = $totalcount_arr[0]['num'];
            $result['lists'] = $new_list;
            $result['success'] = true;

            echo json_encode($result);
        } else if ($action == 'save')   //保存字段
        {

        } else if ($action == 'delete') {
            $rawdata = file_get_contents('php://input');
            $data = json_decode($rawdata);
            $id = $data->id;
            if (is_numeric($id)) //订单
            {
                $line = ORM::factory('insurance_booking', $id);
                $line->delete();

            }

        }

    }

    //订单列表
    public function action_index()
    {
        $action = $this->params['action'];
        if (empty($action))  //显示列表
        {
            $this->display('stourtravel/insurance/index');
        } else if ($action == 'read')    //读取列表
        {
            $start = Arr::get($_GET, 'start');
            $limit = Arr::get($_GET, 'limit');
            $keyword = Arr::get($_GET, 'keyword');
            $order = 'order by a.id desc';

            if (!empty($keyword)) {
                $w = "where a.productname like '%{$keyword}%'";
            }
            $sql = "select a.*  from sline_insurance as a $w $order limit $start,$limit";

            $totalcount_arr = DB::query(Database::SELECT, "select count(*) as num from sline_insurance a ")->execute()->as_array();
            $list = DB::query(Database::SELECT, $sql)->execute()->as_array();
            $new_list = array();
            foreach ($list as $k => $v) {

                $new_list[] = $v;
            }
            $result['total'] = $totalcount_arr[0]['num'];
            $result['lists'] = $new_list;
            $result['success'] = true;

            echo json_encode($result);
        } else if ($action == 'update')   //保存字段
        {
            $id=Arr::get($_POST,'id');
            $field=Arr::get($_POST,'field');
            $val=Arr::get($_POST,'val');
            $kindid=Arr::get($_POST,'kindid');
            $model=new Model_Insurance($id);
            if($model->loaded()) {
                $model->$field = $val;
                if($model->save())
                {
                    echo 'ok';
                    return;
                }
            }
            echo 'no';

        }

    }

    public function action_huizhe()
    {
        $this->display('stourtravel/insurance/huizhe');
    }

    //尝试支付
    public function action_ajax_trypay()
    {
        $id = $this->params['id'];

        $result = $this->genePayXML($id);
        if(!$result)
        {
            echo json_encode(array('status'=>false,'msg'=>'ID错误或生成XML数据异常'));
            return;
        }
        $post = array('requestStr' => $result);
        $content = http_build_query($post);
        $content_length = strlen($content);
        $options = array(
            'http' => array(
                'method' => 'POST',
                'header' =>
                    "Content-type: application/x-www-form-urlencoded\r\n" .
                    "Content-length: $content_length\r\n",
                'content' => $content
            )
        );
        $xml = file_get_contents("http://newcloud.hzins.com/WebAPI/HZ_Service.asmx/API_OrderApplyPayOnline", false, stream_context_create($options));
        if(empty($xml))
        {
            echo json_encode(array('status'=>false,'msg'=>'ID错误或生成XML数据异常'));
            return;
        }

        $xmlObj=new SimpleXMLElement($xml);
        $isSuccess=(string)$xmlObj->IsSuccess;
        $msg=(string)$xmlObj->ErrorMsg;
        if($isSuccess=='false')
        {
            echo json_encode(array('status'=>false,'msg'=>$msg));
            return;
        }
        $insureNo=(string)$xmlObj->InsureNo;
        $payUrl=(string)$xmlObj->PayUrl;
        echo json_encode(array('status'=>true,'msg'=>$msg,'insureNo'=>$insureNo,'payUrl'=>$payUrl));
    }


    //更新慧择产品
    public function action_ajax_huizhe_update()
    {
        $configs = $this->getHuizheConfig();
        $transrNo = time() . mt_rand(10, 99);
        $usebase=$_POST['usebase'];
        if($usebase==1)
            $transrNo='BASE'.$transrNo;
        $md5Str = md5($configs['key'] . $configs['partnerid'] . $transrNo);


        $str = '<?xml version="1.0" encoding="utf-8"?>
        <ProductsQueryRequest><TransrNo>' . $transrNo . '</TransrNo>
        <MD5Str>' . $md5Str . '</MD5Str>
        <PartnerID>' . $configs['partnerid'] . '</PartnerID>
        <SonPartnerID>' . $configs['sonpartnerid'] . '</SonPartnerID>
        </ProductsQueryRequest>';


        $post = array('requestStr' => $str);
        $content = http_build_query($post);
        $content_length = strlen($content);
        $options = array(
            'http' => array(
                'method' => 'POST',
                'header' =>
                    "Content-type: application/x-www-form-urlencoded\r\n" .
                    "Content-length: $content_length\r\n",
                'content' => $content
            )
        );
        echo $str;
        $xml = file_get_contents("http://newcloud.hzins.com/WebAPI/HZ_Service.asmx/API_ProductsQuery", false, stream_context_create($options));
echo $xml;
      //  var_dump($xml);
        if (!$xml) {
            echo json_encode(array('status' => false, 'msg' => '获取产品列表错误，请检查配置是否正确'));
            return;
        }

        $xmlArr = Common::xml_to_array($xml);
        if (empty($xmlArr['ProductsQuery']) || empty($xmlArr['ProductsQuery']['ProductQuery'])) {
            echo json_encode(array('status' => false, 'msg' => '获取产品列表错误，请检查配置是否正确'));
            return;
        }
        $products = $xmlArr['ProductsQuery']['ProductQuery'];
        foreach ($products as $k => $v) {
            unset($v['ProductDetailsResponse']['ProductDetails']['ProductUnderwriting']['CoverageAreas']);
            Model_Insurance::updateProduct('huizhe', $v);
        }
        echo json_encode(array('status' => true, 'msg' => '更新完成'));
    }



    public function action_ajax_huizhe_list()
    {
        $products = Model_Insurance::getList();
        foreach ($products as $k => $v) {
            $products[$k]['content'] = Model_Insurance::filterProductInfo($v['content']);
        }
        echo json_encode(array('status' => true, 'msg' => '获取成功', 'list' => $products));
    }

    public function action_dialog_detail()
    {
        $id = $this->params['id'];
        $model = new Model_Insurance($id);
        if (!$model->loaded())
            exit('错误的ID');
        $info = $model->as_array();
        $info['content'] = Model_Insurance::filterProductInfo($info['content']);
        $this->assign('info', $info);
        $this->display('stourtravel/insurance/dialog_detail');
    }

    public function action_dialog_set()
    {
        $selids = $_GET['insuranceids'];
        $selArr = explode(',', $selids);

        $products = Model_Insurance::getList();
        foreach ($products as $k => $v) {
            $products[$k]['content'] = Model_Insurance::filterProductInfo($v['content']);
        }
        $this->assign('selids', $selArr);
        $this->assign('products', $products);
        $this->display('stourtravel/insurance/dialog_set');
    }

    public function action_book_add()
    {
        $id = $this->params['productid'];
        $model = new Model_Insurance($id);
        if (!$model->loaded())
            exit('错误的产品ID');

        $info = $model->as_array();
        $this->assign('info', $info);
        $this->display('stourtravel/insurance/book_add');
    }

    public function action_ajax_gene_tourerid()
    {
        $model = new Model_Insurance_Booking_Tourer();
        $model->create();
        if ($model->loaded())
            echo json_encode(array('status' => true, 'msg' => '', 'id' => $model->id));
        else
            echo json_encode(array('status' => false, 'msg' => '获取失败'));
    }

    public function action_ajax_booking_save()
    {
        $bookid = $_POST['productid'];
        $model = new Model_Insurance_Booking($bookid);
        $model->price = $_POST['singleprice'];
        $model->begindate = $_POST['begindate'];
        $model->enddate = $_POST['enddate'];
        $model->destination = $_POST['destination'];
        $model->trippurposeid = $_POST['trippurposeid'];
        $model->visacity = $_POST['visacity'];
        if(!empty($_POST['tourer']['id']))
        $model->insurednum=count($_POST['tourer']['id']);
        $curtime = time();
        if ($model->loaded()) {
            $model->modtime = $curtime;
        } else {
            $model->addtime = $curtime;
            $model->ordersn = 'INS' . $curtime . mt_rand(11, 99);
            $model->productcasecode = $_POST['productcasecode'];
        }
        $result = $model->save();
        if ($result) {
            $this->saveTourer($_POST['tourer'], $model->id);
            echo json_encode(array('status' => true, 'msg' => '保存成功', 'productid' => $model->id));
        } else {
            echo json_encode(array('status' => false, 'msg' => '保存失败'));
        }

    }

    public function action_ajax_del_tourerid()
    {
        $id = $_POST['id'];
        $model = new Model_Insurance_Booking_Tourer($id);
        if ($model->loaded()) {
            $result = $model->delete();
            if ($result) {
                echo json_encode(array('status' => true, 'msg' => '删除成功'));
                return;
            }
        }
        echo json_encode(array('status' => false, 'msg' => '删除失败'));
    }

    public function action_edit()
    {
        $id = $this->params['id'];
        $model = new Model_Insurance_Booking($id);
        if (!$model->loaded()) {
            exit('错误的ID');
        }
        $model->viewstatus=1;
        $model->save();
        $info = $model->as_array();
        $info['memberaccount'] = ORM::factory('member', $info['memberid'])->get('mobile');
        $info['linetitle'] = ORM::factory('member_order')->where('ordersn', '=', $info['bookordersn'])->find()->get('productname');
        $info['productname'] = ORM::factory('insurance')->where('productcode', '=', $info['productcasecode'])->find()->get('productname');
        $tourers = ORM::factory('insurance_booking_tourer')->where('orderid', '=', $info['id'])->get_all();
        $this->assign('info', $info);
        $this->assign('tourers', $tourers);
        $this->display("stourtravel/insurance/book_add");
    }
    //获取慧择的配置信息
    public function getHuizheConfig()
    {

        $webid = 0;
        $configModel = new Model_Sysconfig();
        $results = $configModel->getConfig($webid);
        $baseArr=array('partnerid'=> $results['cfg_huizhe_partnerid'], 'key' => $results['cfg_huizhe_key'], 'sonpartnerid' => $results['cfg_huizhe_sonpartnerid']);
        return $baseArr;


    }

    public function saveTourer($tourers, $orderid)
    {
        $ids = $tourers['id'];
        $result = true;
        foreach ($ids as $k => $id) {
            $model = new Model_Insurance_Booking_Tourer($id);
            $model->orderid = $orderid;
            $model->name = $tourers['name'][$k];
            $model->pinyin = $tourers['pinyin'][$k];
            $model->sex = $tourers['sex'][$k];
            $model->cardtype = $tourers['cardtype'][$k];
            $model->cardcode = $tourers['cardcode'][$k];
            $model->birthday = $tourers['birthday'][$k];
            $model->mobile = $tourers['mobile'][$k];
            $model->jobcode = $tourers['jobcode'][$k];
            $model->joblevel = $tourers['joblevel'][$k];
            $model->job = $tourers['job'][$k];
            $model->fltno = $tourers['fltno'][$k];
            $model->city = $tourers['city'][$k];
            $model->insurantrelation = $tourers['insurantrelation'][$k];
            $model->count = $tourers['count'][$k];
            //   $model->jobcode=$tourers['jobcode'][$k];
            $model->save();
        }
    }

    public function genePayXML($bookid)
    {
        $model = new Model_Insurance_Booking($bookid);
        if (!$model->loaded())
            return false;
        $curtime=time();
        $configsBase = $this->getHuizheConfig();
        $configModel = new Model_Sysconfig();
        $configsArr = $configModel->getConfig(0);
        $md5Str = md5($configsBase['key'] . $configsBase['partnerid'] . $model->ordersn);
        $asyncResUrl=$GLOBALS['cfg_basehost'].'/insurance/notify.php';


        //生成判断部
        $xml = '<?xml version="1.0" encoding="utf-8"?>
            <OrderApplyRequest>
              <TransrNo>'.$model->ordersn.'</TransrNo>
              <CaseCode>'.$model->productcasecode.'</CaseCode>
              <MD5Str>'.$md5Str.'</MD5Str>
              <PartnerID>'. $configsBase['partnerid'].'</PartnerID>';

        //生成member
        $xmlMember='<Member>
            <Name>'.$configsArr['cfg_huizhe_member_name'].'</Name>
            <Mobile>'.$configsArr['cfg_huizhe_member_mobile'].'</Mobile>
            <Email>'.$configsArr['cfg_huizhe_member_email'].'</Email>
            <Address>'.$configsArr['cfg_huizhe_member_address'].'</Address>
            <Company>'.$configsArr['cfg_huizhe_member_company'].'</Company>
            <CallBackUrl>'.$asyncResUrl.'</CallBackUrl>
          </Member>';

        //生成policy的XML
        $xmlPolicy='<Policy><ApplicationDate>'.date('Y-m-d',$curtime).'</ApplicationDate>
        <BeginDate>'.$model->begindate.'</BeginDate>
        <EndDate>'.$model->enddate.'</EndDate>
        <SinglePrice>'.$model->price.'</SinglePrice>
        <Destination>'.$model->destination.'</Destination>
        <TripPurposeId>'.$model->trippurposeid.'</TripPurposeId>
        <VisaCity>'.$model->visacity.'</VisaCity></Policy>';

        //生成applicant

        $xmlApplicant='<Applicant><Name>'. $configsArr['cfg_insurance_buyer_name'].'</Name>
        <NamePinYin>'. $configsArr['cfg_insurance_buyer_pinyin'].'</NamePinYin>
        <CardType>'. $configsArr['cfg_insurance_buyer_cardtype'].'</CardType>
        <CardCode>'. $configsArr['cfg_insurance_buyer_cardcode'].'</CardCode>
        <Sex>'. $configsArr['cfg_insurance_buyer_sex'].'</Sex>
        <Birthday>'. $configsArr['cfg_insurance_buyer_birthday'].'</Birthday>
        <Address>'. $configsArr['cfg_insurance_buyer_address'].'</Address>
        <PostCode>'. $configsArr['cfg_insurance_buyer_postcode'].'</PostCode>
        <Phone>'. $configsArr['cfg_insurance_buyer_phone'].'</Phone>
        <Mobile>'. $configsArr['cfg_insurance_buyer_mobile'].'</Mobile>
        <Fax>'. $configsArr['cfg_insurance_buyer_fax'].'</Fax>
        <Email>'. $configsArr['cfg_insurance_buyer_email'].'</Email>
        <HomeAddress>'. $configsArr['cfg_insurance_buyer_homeaddress'].'</HomeAddress>
        <JobCode>'. $configsArr['cfg_insurance_buyer_jobcode'].'</JobCode>
        <JobLevel>'. $configsArr['cfg_insurance_buyer_joblevel'].'</JobLevel>
        <Job>'. $configsArr['cfg_insurance_buyer_job'].'</Job></Applicant>
        ';

        //生成insured
        $tourerModel=new Model_Insurance_Booking_Tourer();
        $tourers=$tourerModel->where('orderid','=',$model->id)->get_all();
        $xmlInsured='';
        foreach($tourers as $k=>$v)
        {
            $xmlInsured.='<Insured>
            <Name>'.$v['name'].'</Name>
            <NamePinYin>'.$v['pinyin'].'</NamePinYin>
            <Sex>'.$v['sex'].'</Sex>
            <CardType>'.$v['cardtype'].'</CardType>
            <CardCode>'.$v['cardcode'].'</CardCode>
            <Birthday>'.$v['birthday'].'</Birthday>
            <Mobile>'.$v['mobile'].'</Mobile>
            <JobCode>'.$v['jobcode'].'</JobCode>
            <JObLevel>'.$v['joblevel'].'</JObLevel>
            <Job>'.$v['job'].'</Job>
            <FltNo>'.$v['fltno'].'</FltNo>
            <City>'.$v['city'].'</City>
            <InsurantRelation>'.$v['insurantrelation'].'</InsurantRelation>
            <Count>'.$v['count'].'</Count></Insured>';
        }

        $xml=$xml.$xmlMember.$xmlPolicy.$xmlInsured.$xmlApplicant.'</OrderApplyRequest>';
        return $xml;
    }
}
<?php defined('SYSPATH') or die('No direct script access.');
class Controller_Sms extends Stourweb_Controller{
    /*
     * 短信平台
     * */
    private $sms = null;
    private $uname = null;
    private $upass = null;
    public function before()
    {
        parent::before();

        $this->assign('parentkey',$this->params['parentkey']);
        $this->assign('itemid',$this->params['itemid']);
        Common::getUserRight('msg','smodify');
        include(BASEPATH.'/include/msg.class.php');
        $configinfo = ORM::factory('sysconfig')->getConfig(0);
        $this->assign('configinfo',$configinfo);
        $uname = $configinfo['cfg_sms_username'];
        $upass = $configinfo['cfg_sms_password'];
        $this->uname = $uname;
        $this->upass = $upass;
        $sms = new Msg($uname,$upass);
        $this->sms = $sms;
    }

    //短信平台首页
    public function action_index()
    {
        $num = $this->getLeftMsg();//剩余短信条数
        $totalnum = $this->getSmsInfo();
        $arr = ORM::factory('sms')->get_all();
        foreach($arr as $row)
        {
            $this->assign($row['msgtype'],$row['msg']);
            $this->assign($row['msgtype'].'_open',$row['isopen']);
        }
        $configinfo = ORM::factory('sysconfig')->getConfig(0);
        $this->assign('config',$configinfo);
        $this->assign('leftmsg',$num);
        $this->assign('totalnum',$totalnum);


        $this->display('stourtravel/sms/sms');
    }
    //购买短信
    public function action_buysms()
    {
        $uname =  $this->uname;
        $upass = md5($this->upass);
        $suittype = Arr::get($_POST,'suittype');
        $price = Arr::get($_POST,'price');
        $num = Arr::get($_POST,'num');
        $buyurl = "http://www.stourweb.com/Sms/buysms/";
        //$buyurl= "http://www.stourweb.com/Sms/buysms/account/".$uname.'/password/'.$upass;
        //$buyurl.='/price/'.$price;
        //$buyurl.='/smsnumber/'.$num;
        $postfields = array(
            'account'=>$uname,
            'password'=>$upass,
            'suittype'=>$suittype,
            'price'=>$price,
            'smsnumber'=>$num

        );

        $out = Common::http($buyurl,'POST',$postfields);
        print_r($out);
        exit;
    }

    /*
     * 查询
     * */
    public function action_ajax_query()
    {

        $querytype = $this->params['querytype'];
        $querydate = $this->params['querydate'];
        if($querytype == 'uselog')
        {
            $templet = 'uselog';
            $out = $this->sms->querySendLog($querydate);

        }
        if($querytype=='faillog')
        {
            $templet='faillog';
            $out=$this->sms->queryFailLog($querydate);

        }
        if($querytype == 'buylog')
        {
            $templet = 'buylog';
            $out =$this->sms->queryBuyLog($querydate);

        }

        $data = json_decode($out)->Data;
        $datalist = array();
        foreach($data as $row)
        {
            $datalist[]=Common::objectToArray($row);
        }


        echo json_encode($datalist);
       // $this->assign('datalist',$datalist);


      //  $this->display('stourtravel/sms/'.$templet);

    }

    /*保存配置*/

    public function action_savemsg()
    {

        $msgtype = Arr::get($_POST,'msgtype');
        if($msgtype!='reg')
        {
            for($i=1;$i<=4;$i++)
            {
                $_open = 'isopen'.$i;
                $_msg = 'msg'.$i;
                $open = Arr::get($_POST,$_open);
                $msg = Arr::get($_POST,$_msg);
                $sql = "update sline_sms_msg set isopen='{$open}',msg='$msg' where msgtype='$msgtype".$i."'";
                DB::query(Database::UPDATE,$sql)->execute();
            }

        }
        else
        {
            $reg_open = Arr::get($_POST,'reg_open');
            $reg_msgcode_open = Arr::get($_POST,'reg_msgcode_open');
            $reg_content = Arr::get($_POST,'reg_content');
            $reg_msgcode_content = Arr::get($_POST,'reg_msgcode_content');
            $reg_findpwd_open = Arr::get($_POST,'reg_findpwd_open');
            $reg_findpwd_content = Arr::get($_POST,'reg_findpwd_content');

            $sql1="update sline_sms_msg set isopen='$reg_open',msg='$reg_content' where msgtype='reg'";
            $sql2="update sline_sms_msg set isopen='$reg_msgcode_open',msg='$reg_msgcode_content' where msgtype='reg_msgcode'";
            $sql3="update sline_sms_msg set isopen='$reg_findpwd_open',msg='$reg_findpwd_content' where msgtype='reg_findpwd'";
            DB::query(Database::UPDATE,$sql1)->execute();
            DB::query(Database::UPDATE,$sql2)->execute();
            DB::query(Database::UPDATE,$sql3)->execute();

        }

        echo json_encode(array('status'=>true));



    }
    public function action_dialog_buylog()
    {
       $this->display('stourtravel/sms/dialog_buylog');
    }
    public function action_dialog_uselog()
    {
        $this->display('stourtravel/sms/dialog_uselog');
    }

    public function action_dialog_faillog()
    {
        $this->display('stourtravel/sms/dialog_faillog');
    }

    public function action_dialog_bind()
    {
        $this->display('stourtravel/sms/dialog_bind');
    }

    public function action_dialog_buysms()
    {
        $this->display('stourtravel/sms/dialog_buysms');
    }
/*
 * 剩余短信条数
 * */
   private function getLeftMsg()
    {

        $out = $this->sms->queryBalance();
        $out = json_decode($out);
        $num = !empty($out->Data) ? $out->Data : 0;
        return $num;

    }

    /*
     * 获取短信系统信息
     * */
   private  function getSmsInfo()
    {

        $out = $this->sms->queryServiceInfo();
        $out = json_decode($out);
        $num = !empty($out->Data) ? $out->Data->TotalSMSBalance : 0;
        return $num;
    }

    /*
 * stdClass to Array
 * */
   private   function objectToArray($array)
    {
        if(is_object($array))
        {
            $array = (array)$array;
        }
        if(is_array($array))
        {
            foreach($array as $key=>$value)
            {
                $array[$key] = objectToArray($value);
            }
        }
        return $array;
    }
    /*
     * 接口请求函数
     * @param string url
     * @param string postfields,post请求附加字段.
     * @return $response
     * */
    private function http($url, $postfields='', $method='GET')
    {

        $ci=curl_init();
        curl_setopt($ci, CURLOPT_POST, true);
        curl_setopt($ci, CURLOPT_RETURNTRANSFER, true);

        if($method=='POST')
        {
            curl_setopt($ci, CURLOPT_POST, TRUE);
            if($postfields!='')curl_setopt($ci, CURLOPT_POSTFIELDS, $postfields);
        }

        curl_setopt($ci, CURLOPT_URL, $url);
        $response = curl_exec($ci);
        curl_close($ci);
        return $response;

    }




	
	
	
	
}
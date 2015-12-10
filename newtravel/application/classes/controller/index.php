<?php defined('SYSPATH') or die('No direct script access.');
class Controller_Index extends Stourweb_Controller{

    public function before()
    {
        parent::before();
        $this->assign('cmsurl', URL::site());

    }
    //后台首页(框架)
    public function action_index()
    {
        //$config = Common::getConfig('menu.产品');

        $configinfo = ORM::factory('sysconfig')->getConfig(0);
        Common::sendInfo();
        $addmodule = Model_Model::getAllModule();
        $menu = Common::getConfig('menu_sub');
        $this->assign('menu',$menu);
        $this->assign('addmodule',$addmodule);
        $this->assign('configinfo',$configinfo);
        $this->display('stourtravel/index');
    }

    //index_home
    public function action_home()
    {
        $this->display('stourtravel/index_home');
    }
    //set_base
    public function action_base()
    {
        $this->display('stourtravel/config/config_index');
    }

    //index_new
    public function action_index_new()
    {
        //$addmodule = ORM::factory('model')->where("id>13")->get_all();
        $addmodule = Model_Model::getAllModule();
        $menu = Common::getConfig('menu_sub');
        $this->assign('menu',$menu);
        $this->assign('addmodule',$addmodule);
        $this->display('stourtravel/index_new');
    }

    //4.0首页
    public function action_index2()
    {

        $starttime = date('Y-m-d',mktime(0, 0 , 0,date("m"),date("d")-date("w")+1,date("Y")));
        $endtime =  date('Y-m-d',mktime(0, 0 , 0,date("m"),date("d")-date("w")+7,date("Y")));
        $addmodule = Model_Model::getAllModule();
        $session = Session::instance();
        $uname = ORM::factory('admin',$session->get('userid'))->get('username');
        $rolename = ORM::factory('role',$session->get('roleid'))->get('rolename');
        $menu = Common::getConfig('menu_sub');
        $this->assign('menu',$menu);
        $this->assign('addmodule',$addmodule);
        $this->assign('username',$uname);
        $this->assign('rolename',$rolename);
        $this->assign('starttime',$starttime);
        $this->assign('endtime',$endtime);
        $this->display('stourtravel/index_four');
    }

    public function action_found()
    {
        $addmodule = Model_Model::getAllModule();
        $menu = Common::getConfig('menu_sub');
        $this->assign('menu',$menu);
        $this->assign('addmodule',$addmodule);
        $this->display('stourtravel/public/found');

    }

    public function action_ajax_get_last_article()
    {
        $article = Common::objectToArray(json_decode(Common::http('www.stourweb.com/Api/index')));

        echo json_encode($article);
    }
    /*
     * 删除缓存
     * */
    public function action_ajax_clearcache()
    {
        $dir = array(SLINEDATA.'/tplcache',SLINEDATA.'/dest',APPPATH.'/cache/tplcache/stourtravel',BASEPATH.'/shouji/application/cache/tplcache/mobile');
        //先删除目录下的文件：
        foreach($dir as $v)
        {
           self::delDirFile($v);
        }
        echo 'ok';
    }

    public function delDirFile($dir)
    {
        $dh=opendir($dir);
        while ($file=readdir($dh))
        {
            if($file!="." && $file!="..")
            {
                $fullpath=$dir."/".$file;
                if(!is_dir($fullpath))
                {
                    unlink($fullpath);
                }
                else
                {
                    self::delDirFile($fullpath);
                }

            }
        }
        closedir($dh);
    }

    //生成HTML
    public function action_ajax_makehtml()
    {
        $this->makeHtml();
        echo 'ok';
    }

    public function action_test()
    {
        $url = "http://www.aiyoushu.com/index.php?genpage=1";
        echo Common::http($url);
    }

    /*
     * 生成HMTL
     * */
    public function makeHtml()
    {

        include(PUBLICPATH.'/vendor/httpdown.class.php');

        //先生成主站html

        $storage = array(
            '/',
            '/lines/',
            '/hotels/',
            '/cars/',
            '/raiders/',
            '/spots/',
            '/visa/',
            '/tuan/',
            '/destination/'
        );

        $http = new HttpDown();//实例化下载类
        foreach($storage as $value)
        {
            $url = $GLOBALS['cfg_basehost'].$value.'index.php?genpage=1';

            $savepath = BASEPATH.$value.'index.html';

            $content = Common::http($url);

            $fp = fopen($savepath,'wb');
            fwrite($fp,$content);
            fclose($fp);




        }
        //生成子站首页静态
        $sql = "select id,weburl,webprefix from sline_destinations where iswebsite=1 and isopen=1";
        $arr = DB::query(1,$sql)->execute()->as_array();
        $datapath=SLINEDATA.'/html/child/';
        if(!is_dir($datapath))mkdir($datapath,0777,true);
        foreach($arr as $row)
        {

            $url = $row['weburl'].'/index.php?genpage=1';
            $savepath = SLINEDATA.'/html/child/'.$row['webprefix'].'_index.html';
			$content = Common::http($url);
			$fp = fopen($savepath,'wb');
            fwrite($fp,$content);
            fclose($fp);
            
        }

    }


    //top 10访问页面
    public function action_ajax_visit_list()
    {
        $type = Arr::get($_GET,'type');
        $time = $this->getTimeRange($type);
        $starttime = $time[0];//开始时间
        $endtime = $time[1];//结束时间
        $sql = "select title,access_url,sum(keynum) as visitcount,referer_domain from sline_stats where access_time>=$starttime and access_time<=$endtime group by access_url  order by sum(keynum) desc  limit 10";


        $arr = DB::query(1,$sql)->execute()->as_array();
        if($arr)
        {
           $out = '';
           foreach($arr as $row)
           {
               $url = $row['referer_domain'].$row['access_url'];
               $out.='<tr>';
               $out.='<td width="40%" height="40"><a target="_blank" href="'.$url.'">'.$url.'</a></td>';
               $out.='<td width="40%">'.$row['title'].'</td>';
               $out.='<td width="20%" align="center">'.$row['visitcount'].'</td>';
               $out.='</tr>';
           }
        }
        echo json_encode(array('trlist'=>$out));


    }

    //订单数量(产品栏目展示)
    public function action_ajax_order_num()
    {
       // $timeArr = $this->getTimeRange(3);
      //  $starttime = $timeArr[0];
       // $endtime = $timeArr[1];
        $arr = ORM::factory('model')->where("isopen=1")->get_all();
        $out = array();
        foreach($arr as $row)
        {
            if($row['pinyin']=='insurance')
            {
                $sql = "select count(*) as num from sline_insurance_booking";
                $sql2="select count(*) as num from sline_insurance_booking where viewstatus=0";
                $ar = DB::query(1,$sql)->execute()->as_array();
                $ar2= DB::query(1,$sql2)->execute()->as_array();
                $count = $ar[0]['num'];
                $count2=$ar2[0]['num'];
                $out[]=array('md'=>$row['pinyin'],'num'=>$count,'unviewnum'=>$count2);
                continue;
            }
            $sql = "select count(*) as num from sline_member_order where typeid='".$row['id']."'";
            $sql2="select count(*) as num from sline_member_order where typeid='".$row['id']."' and viewstatus=0";
            $ar = DB::query(1,$sql)->execute()->as_array();
            $ar2= DB::query(1,$sql2)->execute()->as_array();
            $count = $ar[0]['num'];
            $count2=$ar2[0]['num'];
            $out[]=array('md'=>$row['pinyin'],'num'=>$count,'unviewnum'=>$count2);
        }
        //自定义订单
        $count = 0;
        $count2=0;
        $sql = "select count(*) as num from sline_dzorder";
        $sql2= "select count(*) as num from sline_dzorder where viewstatus=0";
        $row = DB::query(1,$sql)->execute()->as_array();
        $row2= DB::query(1,$sql2)->execute()->as_array();
        $count = $row[0]['num'];
        $count2= $row2[0]['num'];
        $out[]=array('md'=>'zdy','num'=>$count,'unviewnum'=>$count2);

        //私人定制定单
        $count = 0;
        $count2= 0;
        $sql = "select count(*) as num from sline_customize";
        $sql2 ="select count(*) as num from sline_customize where viewstatus=0";
        $row = DB::query(1,$sql)->execute()->as_array();
        $row2= DB::query(1,$sql2)->execute()->as_array();
        $count = $row[0]['num'];
        $count2 =$row2[0]['num'];
        $out[]=array('md'=>'custom','num'=>$count,'unviewnum'=>$count2);
        echo json_encode($out);
    }

    //订单数量(图表展示)
    public function action_ajax_order_num_graph()
    {

        $out = array();
        $type = array(
            '1'=>'line',
            '2'=>'hotel',
            '3'=>'car',
            '5'=>'spot',
            '8'=>'visa',
            '13'=>'tuan',
            '0'=>'ty'
        );
        $starttime=strtotime(Arr::get($_POST,'starttime'));
        $endtime=strtotime(Arr::get($_POST,'endtime'));
        $labels = $this->getLabel($starttime,$endtime);
        foreach($type as $key => $channel)
        {
            $where = intval($key) > 0 ? "and typeid='$key'" : " and typeid>13";
            $num_arr = array();


            $sql = "select count(*) as num, FROM_UNIXTIME(addtime, '%Y-%m-%d') AS statistic_date  from sline_member_order where addtime>='$starttime' and addtime<='$endtime' $where  GROUP BY statistic_date ASC";
            $ar = DB::query(1, $sql)->execute()->as_array();
            $statistic=$data=array();
            foreach($ar as $val)
            {
                $statistic[$val['statistic_date']] = $val['num'];
            }
            foreach($labels as $lab)
            {
                $data[] = isset($statistic[$lab]) ? $statistic[$lab] : 0;
            }
            $out[$channel] = $data;

        }
        $out['labels'] = $labels;

        echo json_encode($out);

    }

    //ip,pv统计
    public function action_ajax_ippv_num()
    {

        $ip=array();
        $pv=array();
        $starttime=strtotime(Arr::get($_POST,'starttime'));
        $endtime=strtotime(Arr::get($_POST,'endtime'));
        $labels = $this->getLabel($starttime,$endtime);

        //统计ip

        $sql = "select  count(distinct ip_address) as num,FROM_UNIXTIME(access_time, '%Y-%m-%d') AS statistic_date from sline_stats  where access_time>=$starttime and access_time<=$endtime group by statistic_date asc";
        $ar = DB::query(1,$sql)->execute()->as_array();
        $statistic=$data=array();
        foreach($ar as $val)
        {
            $statistic[$val['statistic_date']] = $val['num'];
        }
        foreach($labels as $lab)
        {
            $data[] = isset($statistic[$lab]) ? $statistic[$lab] : 0;
        }

        $ip=$data;

        //统计pv
        $sql = "select sum(keynum) as num,FROM_UNIXTIME(access_time, '%Y-%m-%d') AS statistic_date from sline_stats  where access_time>=$starttime and access_time<=$endtime group by statistic_date asc ";
        $ar = DB::query(1,$sql)->execute()->as_array();
        $statistic=$data=array();
        foreach($ar as $val)
        {
            $statistic[$val['statistic_date']] = $val['num'];
        }
        foreach($labels as $lab)
        {
            $data[] = isset($statistic[$lab]) ? $statistic[$lab] : 0;
        }
        $pv = $data;


        $out=array('ip'=>$ip,'pv'=>$pv,'labels'=>$labels);
        echo json_encode($out);


    }

    //会员统计
    public function action_ajax_member_num()
    {
        $out = array();
        $starttime=strtotime(Arr::get($_POST,'starttime'));
        $endtime=strtotime(Arr::get($_POST,'endtime'));
        $labels = $this->getLabel($starttime, $endtime);

        //统计新增会员
        $sql = "select  count(*) as num,FROM_UNIXTIME(jointime, '%Y-%m-%d') AS statistic_date from sline_member  where jointime>=$starttime and jointime<=$endtime group by statistic_date";
        $ar = DB::query(1, $sql)->execute()->as_array();
        $statistic = $data = array();
        foreach ($ar as $val)
        {
            $statistic[$val['statistic_date']] = $val['num'];
        }
        foreach ($labels as $lab)
        {
            $out[] = isset($statistic[$lab]) ? $statistic[$lab] : 0;
        }


        echo json_encode(array('member'=>$out,'labels'=>$labels));


    }

    public function action_ajax_clear_log()
    {
        $query = DB::delete('user_log')->where('logtime', '<', time()-60*60*24*7);
        $query->execute();
        $query= DB::delete('stats')->where('access_time', '<', time()-60*60*24*30);
        $query->execute();
        echo 'ok';
    }

    /**
     * @des
     */
    public function action_feedback()
    {
        $userName=Webconfig::getConfig('cfg_sms_username');
        $password=WebConfig::getConfig('cfg_sms_password');
        $password=empty($password)?'':md5($password);

        $url="http://www.stourweb.com/user/login/do_user_login/account/{$userName}/password/{$password}";
        echo '<script>'.
              'window.open("'.$url.'","_self")'.
              '</script>';


    }
    /*
     * 获取label
     * */
   public function getLabel($starttime,$endtime)
   {
       $label=array();
       for($i=$starttime;$i<=$endtime;$i=$i+60*60*24)
       {
            $lable[]=date('Y-m-d',$i);
       }
       return $lable;
   }


    //获取时间范围
    /*
     * 1:今日
     * 2:昨日
     * 3:本周
     * 4:上周
     * 5:本月
     * 6:上月
     * */
    public function getTimeRange($type)
    {
        switch($type)
        {
            case 1:
                $starttime = strtotime(date('Y-m-d 00:00:00'));
                $endtime = strtotime(date('Y-m-d 23:59:59'));
                break;
            case 2:
                $starttime = strtotime(date('Y-m-d 00:00:00' , strtotime('-1 day')));
                $endtime=strtotime(date('Y-m-d 23:59:59' , strtotime('-1 day')));
                break;
            case 3:
                $starttime = mktime(0, 0 , 0,date("m"),date("d")-date("w")+1,date("Y"));;
                $endtime = time();
                break;
            case 4:
                $starttime = strtotime(date('Y-m-d 00:00:00' , strtotime('last Sunday')));
                $endtime = strtotime(date('Y-m-d H:i:s' ,  strtotime('last Sunday') + 7 * 24 * 3600 - 1));
                break;
            case 5:
                $starttime = strtotime(date('Y-m-01 00:00:00' ,time()));
                $endtime = time();
                break;
            case 6:
                $starttime = strtotime(date('Y-m-01 00:00:00' ,strtotime('-1 month')));
                $endtime = strtotime(date('Y-m-31 23:59:00' ,strtotime('-1 month')));
                break;



        }
        $out = array(
            $starttime,
            $endtime
        );
        return $out;

   }

    //按星期获取起止日期
    public function getTimeByWeekDay($day)
    {
        switch($day)
        {
            case 1:

                $starttime = mktime(0, 0 , 0,date("m"),date("d")-date("w")+1,date("Y"));
                $endtime = mktime(23, 59 , 59,date("m"),date("d")-date("w")+1,date("Y"));

                break;
            case 2:
                $starttime = mktime(0, 0 , 0,date("m"),date("d")-date("w")+2,date("Y"));
                $endtime = mktime(23, 59 , 59,date("m"),date("d")-date("w")+2,date("Y"));
                break;
            case 3:
                $starttime = mktime(0, 0 , 0,date("m"),date("d")-date("w")+3,date("Y"));
                $endtime = mktime(23, 59 , 59,date("m"),date("d")-date("w")+3,date("Y"));
                break;
            case 4:
                $starttime = mktime(0, 0 , 0,date("m"),date("d")-date("w")+4,date("Y"));
                $endtime = mktime(23, 59 , 59,date("m"),date("d")-date("w")+4,date("Y"));
                break;
            case 5:
                $starttime = mktime(0, 0 , 0,date("m"),date("d")-date("w")+5,date("Y"));
                $endtime = mktime(23, 59 , 59,date("m"),date("d")-date("w")+5,date("Y"));
                break;
            case 6:
                $starttime = mktime(0, 0 , 0,date("m"),date("d")-date("w")+6,date("Y"));
                $endtime = mktime(0, 0 , 0,date("m"),date("d")-date("w")+6,date("Y"));
                break;
            case 7:
                $starttime = mktime(0, 0 , 0,date("m"),date("d")-date("w")+7,date("Y"));
                $endtime = mktime(0, 0 , 0,date("m"),date("d")-date("w")+7,date("Y"));
                break;



        }
        $out = array(
            $starttime,
            $endtime
        );
        return $out;
    }
}
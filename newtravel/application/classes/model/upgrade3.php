<?php defined('SYSPATH') or die('No direct access allowed.');
/*
 * 系统升级类(新版本)
 * */

class Model_Upgrade3 {

    private $api_url = 'http://update.souxw.com/service/api_v3.ashx?';
    private $serialnumber = null;
    private $currentversion = null;
    private $appidentity = null;
    private $token = null;//令牌


    public function __construct()
    {
        include(Kohana::find_file('data','license'));
        include(Kohana::find_file('data','version'));
        $this->serialnumber = $SerialNumber;
        $this->currentversion = $cVersion;
        $this->appidentity = $_SERVER['HTTP_HOST'];
    }


    /*
     * 获取token
     * */
    private function getToken()
    {
        $token = trim($this->readToken());
        if (!empty($token))
        {
            $arr = array(
                'action' => 'getupgradestatus',
                'token' => $token
            );
            $params = http_build_query($arr); //生成参数数组
            $url = $this->api_url . $params;
            $data = $this->http($url);
            if ($data['Success'] == 1)
                $this->token = $token;
            else
                $token = '';
        }

        if(empty($token))
        {
            $arr = array(
                'action' => 'gettoken',
                'productcode' => 'stourwebcms',
                'appidentity' => $this->appidentity,
                'serialnumber' => $this->serialnumber
            );
            $params = http_build_query($arr); //生成参数数组
            $url = $this->api_url . $params;
            $data = $this->http($url);
            if ($data['Success'] == 1)
            {
                $this->token = trim($data['Data']);
                $this->writeToken($this->token);
            }
        }
    }

    /*
     * 检测新版本补丁
     * */
    public function  checkNewestPatch()
    {
        $arr = array(
            'action'=>'checknewestpatch',
            'productcode'=>'stourwebcms',
            'currentversion' => $this->currentversion
        );
        $params = http_build_query($arr);//生成参数数组
        $url = $this->api_url.$params;
        return $this->http($url);
    }

    /*
     * 获得最新补丁下载地址
     * */
    public function getNewVersion()
    {
        $this->getToken();
        $arr = array(
            'action'=>'getnewestpatch',
            'token'=>$this->token,
            'currentversion' => $this->currentversion
        );
        $params = http_build_query($arr);//生成参数数组
        $url = $this->api_url.$params;
        return $this->http($url);

    }
    /*
     * 获取已升级的补丁
     * */
    public function getOldPatch($count)
    {
		
        $this->getToken();
		 if(empty($this->token))return array('Success'=>0);
        $arr = array(
            'action'=>'getoldpatch',
            'token'=>$this->token,
            'currentversion' => $this->currentversion,
            'count'=>$count
        );
        $params = http_build_query($arr);//生成参数数组
        $url = $this->api_url.$params;
        return $this->http($url);
    }
    /*
     * 获取最新的升级补丁信息
     * */
    public function getLastPatch()
    {
        $this->getToken();
        $arr = array(
               'action'=>'getlastpatch',
               'token'=>$this->token,
               'currentversion'=>$this->currentversion

        );
        $params = http_build_query($arr);//生成参数数组
        $url = $this->api_url.$params;
        return $this->http($url);
    }

    /*
     * 返回登记升级信息
     * */
   public function regUpgradeStatus($patchurl)
   {
       $arr = array(
           'action'=>'releaseupgraderegist',
           'patchsn'=>$patchurl

       );
       $params = http_build_query($arr);//生成参数数组
       $url = $this->api_url.$params;
       return $this->http($url);
   }

    /*
     * 写token
     * */
    public function writeToken($token)
    {
        $file = BASEPATH.'/data/token.php';
        $fp = fopen($file,'wb');
        flock($fp,3);
        fwrite($fp,$token);
        fclose($fp);

    }

    /*
     * 读token
     * */
    public function readToken()
    {
        $file = BASEPATH.'/data/token.php';
        $token = '';
        if(file_exists($file))
        {
            $token = file_get_contents($file);
        }
        return $token;
    }


     /*
      * 检测版是否是正版
      * */
    public function checkRightV()
    {
        $newversion = $this->getNewVersion();

        return $newversion['Success']==true ? 1 : 0;
    }
    //返回版本号
    public function getMyVersion()
    {
        return $this->currentversion;
    }
    //返回序列号
    public function getSerialnumber()
    {
        return $this->serialnumber;
    }

    /*
        * 写配置文件
        *
        * */
    public static function writeConfig()
    {
        $configfile = SLINEDATA.'/config.cache.inc.php';
        $fp = fopen($configfile,'wb');
        flock($fp,3);
        fwrite($fp,"<"."?php\r\n");
        $arr = ORM::factory('sysconfig')->where('webid','=',0)->get_all();
        foreach($arr as $row)
        {

            if($row['varname']=='cfg_tongjicode')
            {
                fwrite($fp,"\${$row['varname']} = '".addslashes($row['value'])."';\r\n");
            }
            else
            {
                fwrite($fp,"\${$row['varname']} = '".str_replace("'",'',$row['value'])."';\r\n");
            }

        }
        fwrite($fp,"?".">");
        fclose($fp);

    }

    //重写版本号
   public static function rewriteVersion($ver,$beta,$pubdate)
    {
        $file = Kohana::find_file('data','version');
        @chmod($file,0777);
        /*if(!is_writeable($file))
        {
            echo "版本文件'{$file}'不支持写入，无法更新系统！";
            exit();
        }*/
        $versiontype=($beta==1) ? '测试版' : '正式版';
        $pubdate=Common::myDate('Y-m-d',strtotime($pubdate));
        $fp = fopen($file,'w');
        flock($fp,3);
        fwrite($fp,"<"."?php\r\n");
        fwrite($fp,"\$pcode = 'stourwebcms';\r\n");
        fwrite($fp,"\$cVersion ='".$ver."';\r\n");
        fwrite($fp,"\$versiontype ='".$versiontype."';\r\n");
        fwrite($fp,"\$pubdate ='".$pubdate."';\r\n");
        fwrite($fp,"?".">");
        fclose($fp);


    }
    //重写序列号
    public static function rewriteLicense($licenseid)
    {
        $file = Kohana::find_file('data','license');
        @chmod($file,0777);
        if(!is_writeable($file))
        {
            echo "授权文件'{$file}'不支持写入，无法更新系统！";
            exit();
        }

        $fp = fopen($file,'w');
        flock($fp,3);
        fwrite($fp,"<"."?php\r\n");
        fwrite($fp,"\$SerialNumber ='".$licenseid."';\r\n");
        fwrite($fp,"?".">");
        fclose($fp);


    }

    /*
     * 接口请求函数
     * @param string url
     * @param string postfields,post请求附加字段.
     * @return $response
     * */
    private  function http($url, $postfields='', $method='GET')
    {
        $ci=curl_init();

        curl_setopt($ci, CURLOPT_RETURNTRANSFER, 1);

        if($method=='POST')
        {
            curl_setopt($ci, CURLOPT_POST, TRUE);
            if($postfields!='')curl_setopt($ci, CURLOPT_POSTFIELDS, $postfields);
        }

        curl_setopt($ci, CURLOPT_URL, $url);
        $response=json_decode(curl_exec($ci),true);
        curl_close($ci);
        return $response;
    }
   /*
    * 生成大小
    * */
   public function format_bytes($size) {
        $units = array(' B', ' KB', ' MB', ' GB', ' TB');
        for ($i = 0; $size >= 1024 && $i < 4; $i++) $size /= 1024;
        return round($size, 2).$units[$i];
    }
  /*
   * 特殊处理,处理描述
   * */
  public function genDesc($description)
  {
      $out = '<ul>';
      $ar = explode('<br>',$description);
      foreach($ar as $v)
      {
         $out.='<li>'.$v.'</li>';
      }
      $out.='</ul>';
      return $out;
  }







}
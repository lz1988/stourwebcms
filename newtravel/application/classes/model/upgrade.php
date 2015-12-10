<?php defined('SYSPATH') or die('No direct access allowed.');
/*
 * 系统升级类
 * */

class Model_Upgrade {



   /*
    * 获取升级包信息
    * @param $type string
    * */

    public  function getRelease($type)
    {
            include(Kohana::find_file('data','version'));

            $releasecount=0;
            /** 指定WebService路径并初始化一个WebService客户端*/
            $ws = "http://update.souxw.com/service/api.asmx?WSDL";//webservice服务的地址
            $client  = new SoapClient($ws);

            //productcode,currentVersion为发送参数值所对应的参数名（或service端提供的字段名）

            $param = array('productcode' => $pcode,'currentVersion' => $cVersion);
            if($type=='new')
            {
                $arr = $client->__soapCall('GetNewestPatch',array('parameters' => $param));//获取最新程序库
            }
            else if($type=='last')
            {
                $param = array('productcode' => $pcode);
                $arr = $client->__soapCall('GetAllPatch',array('parameters' => $param));
            }
            else if($type == 'lastnew')
            {
                $param = array('productcode' => $pcode);

                $arr = $client->__soapCall('GetLastPatch',array('parameters' => $param));
            }


            return $arr;

    }

    /*
     * 获取升级包数量
     * */
    public  function getReleaseNum()
    {

            $arr=self::getRelease('new');
            $releasecount=0;
            if(isset($arr->GetNewestPatchResult->Patch))
            {
                $releasecount=count($arr->GetNewestPatchResult->Patch);


            }
            return $releasecount;
    }

    /*
     * 获取最新版描述信息
     * */
    public function getNewVInfo()
    {
        $arr=self::getRelease('lastnew');
        $out = array();

        if(isset($arr->GetLastPatchResult))
        {

            $count=count($arr->GetLastPatchResult);
            if($count==1)//针对对象特殊处理,如果只有一个对象不能直接当数组使用,需要进行处理.
            {
                $version=array();
                $version[0]=$arr->GetLastPatchResult;
            }
            else
            {
                $version=$arr->GetLastPatchResult; //两个以上补丁会转成数组.

            }


            for($i=0;isset($version[$i]);$i++)
            {
                $versioncode=$version[$i]->Version;
                $versiontype=($version[$i]->IsBeta==1) ? '测试版' : '正式版';
                $versionname=$version[$i]->Name;
                $desc_arr = explode('<br />',$version[$i]->Description);

                foreach($desc_arr as $de)
                {
                    $desc.="<li>".$de."</li>";
                }
                $pubdate=Common::myDate('Y-m-d',strtotime($version[$i]->ReleaseDate));
                $out['version'] = $versioncode;
                $out['versionname'] = $versionname;
                $out['pubdate'] = $pubdate;
                $out['desc'] = $desc;
                break;

            }


        }
        return $out;
    }

    /*
     * 获取更新包列表
     * */
    public function getReleaseList()
    {

        $arr=self::getRelease('new');


        if(isset($arr->GetNewestPatchResult->Patch))
        {
            $count=count($arr->GetNewestPatchResult->Patch);
            if($count==1)//针对对象特殊处理,如果只有一个对象不能直接当数组使用,需要进行处理.
            {
                $version=array();
                $version[0]=$arr->GetNewestPatchResult->Patch;
            }
            else
            {
                $version=$arr->GetNewestPatchResult->Patch; //两个以上补丁会转成数组.

            }
            $out='';
            $k=1;
            for($i=0;isset($version[$i]);$i++)
            {
                $versioncode=$version[$i]->Version;
                $versiontype=($version[$i]->IsBeta==1) ? '测试版' : '正式版';
                $versionname=$version[$i]->Name;
                $desc = $version[$i]->Description;
                $pubdate=Common::myDate('Y-m-d',strtotime($version[$i]->ReleaseDate));
                $weekarray=array("星期日","星期一","星期二","星期三","星期四","星期五","星期六");

                $out.='<dl>';
                $out.='<dt><img class="fl" src="'.$GLOBALS['cfg_public_url'].'/images/gx-jd-bg.png" ></dt>';
                $out.='<dd>';
                $out.='<s></s>';
                $out.=' <div class="dd-con">';
                $out.=' <p class="tit">'.$pubdate.' 发布V'.$versioncode.'升级包</p>';
                $out.='<ul>';
                $out.='<li>'.$desc.'</li>';

                $out.='</ul>
                          </div>
                        </dd>
                      </dl>';
             /*   $out.='<div class="upmessage">';
                $out.='<div class="time_edition">'.$pubdate.'&nbsp;&nbsp;'.$weekarray[date("w",strtotime($version[$i]->ReleaseDate))].'</div>';
                $out.='<div class="up_content">';
                $out.='<h3>发布版本  stourweb V'.$versioncode.'版本升级包!</h3>';
                $out.= $desc;
                $out.='</div>';
                $out.='</div>';*/

                //$url="http://www.stourweb.com/version/show_{$versionname}.html";
                // $str.="<li>版本号：<a href=\"{$url}\" target=\"_blank\">{$versioncode}</a>（{$versiontype}，发布日期：{$pubdate}）</li>";
                $k++;
                if($k>6)
                {
                    break;
                }

            }
        }



        return $out;
    }

    /*
     * 检测license是否有效
     * @param $url string 当前域名地址
     * @param $pcode string 产品类型
     * @param $cversion string 当前版本号
     * */
    public function checkLicense($url,$licenseid)
    {
        include(Kohana::find_file('data','version'));
        /** 指定WebService路径并初始化一个WebService客户端*/
        $ws = "http://update.souxw.com/service/api_v2.asmx?WSDL"; //v2接口
        $client  = new SoapClient($ws);

        //productcode,currentVersion为发送参数值所对应的参数名（或service端提供的字段名）

        $appIdentity = $url;
        $param = array(
            'productcode' => $pcode,
            'currentVersion' => $cVersion,
            'licence' => array('SerialNumber'=>$licenseid,'AppIdentity'=>$appIdentity));

        $arr = $client->__soapCall('GetNewestPatch',array('parameters' => $param));//获取最新程序库

        $out = !empty($arr->GetNewestPatchResult->Success) ? 1 : 0 ;//是否验证成功.
        return $out;
    }

     /*
      * 检测版是否是正版
      * */
    public function checkRightV()
    {
        include(Kohana::find_file('data','license'));
        $licenseid = $SerialNumber;
        return self::checkLicense($_SERVER['HTTP_HOST'],$licenseid);
    }



    //采用执行文件的方式升级
    public static function doSql2()
    {

        $sqlfile=BASEPATH.'/sql.php';
        if(file_exists($sqlfile))
        {
            $url=$GLOBALS['cfg_basehost'].'/sql.php';
            readfile($url);//执行升级文件.
            @unlink($sqlfile);//删除升级sql文件
        }

    }
    //数据库升级,采用执行sql的方式升级
    public static function doSql()
    {

        $query = '';
        $sqlfile=BASEPATH.'/sql.txt';
        if(file_exists($sqlfile))//如果存在升级文件
        {

            $fp = fopen($sqlfile,'r');
            while(!feof($fp))
            {
                $line = rtrim(fgets($fp, 1024));

                if(preg_match("#;$#", $line))
                {

                    $query .= $line;

                    DB::query(null,$query)->execute();

                    $query='';
                }
                else if(!preg_match("#^(\/\/|--)#", $line))
                {
                    $query .= $line;
                }
            }
            fclose($fp);
            @unlink($sqlfile);//删除升级sql文件
        }


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
        if(!is_writeable($file))
        {
            echo "版本文件'{$file}'不支持写入，无法更新系统！";
            exit();
        }
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




 
}
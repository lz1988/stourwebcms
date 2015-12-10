<?php defined('SYSPATH') or die('No direct script access.');
class Controller_App extends Stourweb_Controller{
    /*
     * 增值应用
     * */
    public function before()
    {
        parent::before();

        $this->assign('parentkey',$this->params['parentkey']);
        $this->assign('itemid',$this->params['itemid']);
    }

    //系统升级
    public function action_upgrade()
    {
        include(Kohana::find_file('data','version'));
        include(Kohana::find_file('data','license'));
        Common::sendInfo();
        $this->assign('version','思途CMS'.$cVersion.$versiontype);
        $this->assign('licenseid',$SerialNumber);
        $this->display('stourtravel/app/upgrade');
    }
    //链接到stourweb站点信息
    public function action_other()
    {
        $type = $this->params['type'];
        switch($type)
        {
            case 'contract':
                $url = "http://www.stourweb.com/Member";
                break;
            case 'moban':
                $url = "http://www.stourweb.com/cms/moban";
                break;
            case 'seo':
                $url = "http://www.stourweb.com/peixun";
                break;
            case 'problem':
                $url = "http://www.stourweb.com/cms/problem";
                break;

        }
        $this->request->redirect($url);

    }

    //ajax检测更新
    public function action_ajax_check_update()
    {
        $model = new Model_Upgrade();
        $out = array();
        $out['newinfo'] = $model->getNewVInfo();
        $out['versionlist']=$model->getReleaseList();
        $out['releasenum']= $model->getReleaseNum();
        echo json_encode($out);



    }
    //ajax检测版本权限
    public function action_ajax_check_right()
    {
        $model = new Model_Upgrade();



        $status=$model->checkRightV();
        $out = array('status'=>$status);

        echo json_encode($out);

    }

    //检测是否有写入权限
    public function action_ajax_checkdir()
    {

        $flag = 0;
        $filename = BASEPATH.'/stcms.txt';
        $fp=@fopen($filename,'w');
        if($fp)
        {

            @fclose($fp);
            @unlink($filename);
            $flag = 1;

        }
        echo json_encode(array('status'=>$flag));
    }

    //升级
    public function action_ajax_upgrade()
    {
        include(Kohana::find_file('data','license'));
        $licenseid = $SerialNumber;
        $url = Arr::get($_POST,'url');
        $model = new Model_Upgrade();
        $flag = $model->checkLicense($url,$licenseid);
        echo json_encode(array('status'=>$flag));



    }



    //升级第一步
    public function action_ajax_upgrade_step1()
    {

        $sql="UPDATE `sline_sysconfig` SET `value`='0' WHERE varname='cfg_web_open' and webid=0 ";
        if(DB::query(1,$sql))
        {
            Model_Upgrade::writeConfig();
            echo json_encode(array('status'=>true));
            exit;
        }

    }
    //升级第2步,备份数据库
    public function action_ajax_upgrade_step2()
    {
        $back = new Model_Backup();
        $back->backupAll();
        echo json_encode(array('status'=>true));
    }
    //升级第3步,下载升级文件
    public function action_ajax_upgrade_step3()
    {
        include(Kohana::find_file('data','version'));
        include(Kohana::find_file('data','license'));
        include(PUBLICPATH.'/vendor/httpdown.class.php');
        include(PUBLICPATH.'/vendor/pclzip.lib.php');
        $weburl = Arr::get($_GET,'weburl');
        $unzippath=BASEPATH; //解压路径
        $savepath=APPPATH."/data/patch/"; //更新包存储路径

        /** 指定WebService路径并初始化一个WebService客户端*/
        //$ws = "http://update.souxw.com/service/api.asmx?WSDL";//webservice服务的地址
        $ws = "http://update.souxw.com/service/api_v2.asmx?WSDL"; //v2接口
        $client  = new SoapClient($ws);
        //productcode,currentVersion为发送参数值所对应的参数名（或service端提供的字段名）
        $appIdentity = $weburl;
        $param = array(
            'productcode' => $pcode,
            'currentVersion' => $cVersion,
            'licence' => array('SerialNumber'=>$SerialNumber,'AppIdentity'=>$appIdentity));

        $arr = $client->__soapCall('GetNewestPatch',array('parameters' => $param));//获取最新程序库

        $filelist='';

        if(isset($arr->GetNewestPatchResult->Data->Patch))
        {

            $count=count($arr->GetNewestPatchResult->Data->Patch);
            if($count==1)//针对对象特殊处理,如果只有一个对象不能直接当数组使用,需要进行处理.
            {
                $version=array();
                $version[0]=$arr->GetNewestPatchResult->Data->Patch;
            }
            else
            {
                $version=$arr->GetNewestPatchResult->Data->Patch; //两个以上补丁会转成数组.
                $version=array_reverse($version);
            }

            for($i=0;isset($version[$i]);$i++)
            {
                //$kbarray[$i]['version']=$version[$i]->Version;
                //$kbarray[$i]['downloadurl']=$version[$i]->Url;


                $downloadurl = $version[$i]->Url; //临时替换
                $filename=$savepath.$version[$i]->FileName;
                $htd = new HttpDown();//实例化下载类
                $htd->OpenUrl($downloadurl);
                $ok = $htd->SaveToBin($filename);

                if($ok) //下载文件成功
                {

                    $archive = new PclZip($filename);
                    if ($archive->extract(PCLZIP_OPT_PATH, $unzippath,PCLZIP_OPT_REPLACE_NEWER) == 0)
                    {
                        die("Error : ".$archive->errorInfo(true));
                        echo json_encode(array('status'=>$archive->errorInfo(true)));
                    }

                    Model_Upgrade::doSql();//执行数据库升级
                    Model_Upgrade::doSql2(); //高级数据库升级.
                    Model_Upgrade::rewriteVersion($version[$i]->Version,$version[$i]->IsBeta,$version[$i]->ReleaseDate);
                    @unlink($filename);

                }

            }



        }
        echo json_encode(array('status'=>true));
        exit();
    }
    //升级第4步
    public function action_ajax_upgrade_step4()
    {
        sleep(2);
        echo json_encode(array('status'=>true));
        exit();
    }
    //升级第5步
    public function action_ajax_upgrade_step5()
    {
        $sql="UPDATE `sline_sysconfig` SET `value`='1' WHERE varname='cfg_web_open' and webid=0 ";
        if(DB::query(1,$sql))
        {
            Model_Upgrade::writeConfig();
            echo json_encode(array('status'=>true));
            exit;
        }

    }

    //绑定授权ID
    public function action_bind()
    {
        include(Kohana::find_file('data','license'));
        $this->assign('licenseid',$SerialNumber);
        $this->display('stourtravel/app/bind');
    }
    //绑定ID
    public function action_ajax_bind_license()
    {
        $licenseid = Arr::get($_POST,'licenseid');
        $weburl = Arr::get($_POST,'weburl');
        $model = new Model_Upgrade();
        $flag = $model->checkLicense($weburl,$licenseid);
        if($flag)
        {
            Model_Upgrade::rewriteLicense($licenseid);
            echo json_encode(array('status'=>'ok'));
        }
        else
        {
            echo json_encode(array('status'=>'false'));
        }
    }


    /*
     * 顶部自定义导航
     * */

    public function action_topusernav()
    {

        $action=$this->params['action'];

            $param = $this->params['action'];
            $right = array(
                'read'=>'slook',
                'save'=>'smodify',
                'addsub'=>'sadd',
                'delete'=>'sdelete',
                'update'=>'smodify'
            );
            $user_action = $right[$param];
            if(!empty($user_action))
                Common::getUserRight('usernav',$user_action);




        $attrtable = 'startplace';//当前操作表

        if(empty($action))
        {
            $this->display('stourtravel/app/top_user_nav');
        }
        else if($action=='read')
        {


            $node=Arr::get($_GET,'node');
            $list=array();
            if($node=='root')//属性组根
            {
                $list=ORM::factory('plugin_leftnav')->where('pid','=','0')->get_all();
                $list[]=array(
                    'leaf'=>true,
                    'id'=>'0add',
                    'kindname'=>'<button class="dest-add-btn df-add-btn" onclick="addSub(0)">添加</button>',
                    'allowDrag'=>false,
                    'allowDrop'=>false,
                    'litpic'=>'add',
                    'displayorder'=>'add'
                );
            }
            else //子级
            {
                $list=ORM::factory('plugin_leftnav')->where('pid','=',$node)->get_all();
                foreach($list as $k=>$v)
                {
                    //$list[$k]['leaf']=true;
                    $list[$k][]=array(
                        'leaf'=>true,
                        'id'=>$node.'add',
                        'kindname'=>'<button class="dest-add-btn df-add-btn" onclick="addSub('.$list[$k]['id'].')">添加</button>',
                        'allowDrag'=>false,
                        'allowDrop'=>false,
                        'litpic'=>'add',
                        'displayorder'=>'add'
                    );
                }
                $list[]=array(
                    'leaf'=>true,
                    'id'=>$node.'add',
                    'kindname'=>'<button class="dest-add-btn df-add-btn" onclick="addSub('.$node.')">添加</button>',
                    'allowDrag'=>false,
                    'allowDrop'=>false,
                    'litpic'=>'add',
                    'displayorder'=>'add'
                );
            }
            echo json_encode(array('success'=>true,'text'=>'','children'=>$list));
        }
        else if($action=='addsub')//添加子级
        {
            $pid=Arr::get($_POST,'pid');
            $model=ORM::factory('plugin_leftnav');
            $model->pid=$pid;
            $model->kindname="自定义";
            $model->displayorder='9999';
            $model->save();

            if($model->saved())
            {
                $model->reload();
                echo json_encode($model->as_array());
            }
        }
        else if($action=='save') //保存修改
        {
            $rawdata=file_get_contents('php://input');
            $field=Arr::get($_GET,'field');

            $data=json_decode($rawdata);
            $id=$data->id;
            if($field)
            {
                $model=ORM::factory('plugin_leftnav',$id);
                if($model->id)
                {

                    $model->$field=$data->$field;
                    $model->save();
                    if($model->saved())
                        echo 'ok';
                    else
                        echo 'no';
                }
            }

        }
        else if($action=='drag') //拖动
        {
            $moveid=Arr::get($_POST,'moveid');
            $overid=Arr::get($_POST,'overid');
            $position=Arr::get($_POST,'position');
            $movemodel=ORM::factory($attrtable,$moveid);
            $overmodel=ORM::factory($attrtable,$overid);
            if($position=='append')
            {
                $movemodel->pid=$overid;
            }
            else
            {
                $movemodel->pid=$overmodel->pid;
            }
            $movemodel->save();
            if($movemodel->saved())
                echo 'ok';
            else
                echo 'no';


        }

        else if($action=='delete')//属性删除
        {
            $rawdata=file_get_contents('php://input');
            $data=json_decode($rawdata);
            $id=$data->id;
            if(!is_numeric($id))
            {
                echo json_encode(array('success'=>false));
                exit;
            }
            $model=ORM::factory('plugin_leftnav',$id);
            $model->delete();

        }
        else if($action=='update')//更新操作
        {
            $id=Arr::get($_POST,'id');
            $field=Arr::get($_POST,'field');
            $val=Arr::get($_POST,'val');
            $model=ORM::factory('plugin_leftnav',$id);
            if($model->id)
            {
                $model->$field=$val;
                $model->save();
                if($model->saved())
                    echo 'ok';
                else
                    echo 'no';
            }
        }

    }

    public function action_mutititle()
    {
        $info = ORM::factory('plugin_autotitle')->get_all();
        $out = array();
        foreach($info as $row)
        {
            $out[$row['name']] = $row['value'];
        }

        $this->assign('info',$out);
        $this->display('stourtravel/tools/muti_title');
    }

    /*
     * 保存
     * */
    public function action_ajax_mutititle_save()
    {

        foreach($_POST as $k=>$v)
        {

            $sql="UPDATE `sline_plugin_autotitle` SET `value`='$v' WHERE name='$k'";
            //echo $sql;
            DB::query(2,$sql)->execute();
        }
        self::rewriteCache();
        echo 'ok';
        exit;
    }

    //更新配置函数
    public function rewriteCache()
    {

        $configfile=SLINEDATA.'/autotitle.cache.inc.php';


        $fp = fopen($configfile,'w');
        flock($fp,3);
        fwrite($fp,"<"."?php\r\n");
        $sql="SELECT `name`,`value` FROM `sline_plugin_autotitle`  ORDER BY id ASC";
        $arr = DB::query(1,$sql)->execute()->as_array();
        foreach($arr as $row)
        {

            fwrite($fp,"\${$row['name']} = '".str_replace("'",'',$row['value'])."';\r\n");

        }
        fwrite($fp,"?".">");
        fclose($fp);
    }










}
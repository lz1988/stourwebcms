<?php defined('SYSPATH') or die('No direct script access.');
/*
 * author:netman
 * description:upgrade
 * date:2015-02-13
 * qq:87482723
 * */
class Controller_Upgrade extends Stourweb_Controller{
    /*
     * 增值应用
     * */
    public function before()
    {
        parent::before();

        $this->assign('parentkey',$this->params['parentkey']);
        $this->assign('itemid',$this->params['itemid']);
    }
    //系统升级页
    public function action_index()
    {
        include(Kohana::find_file('data','version'));
        include(Kohana::find_file('data','license'));
        Common::sendInfo();
        $this->assign('version','思途CMS'.$cVersion.$versiontype);
        $this->assign('licenseid',$SerialNumber);
        $this->display('stourtravel/upgrade/index');
    }
    //ajax检测更新( 首页使用)
    public function action_ajax_check_update()
    {
        $model = new Model_Upgrade3();
        $out = array();
        $info = $model->checkNewestPatch();
        if($info['Success']==1)
        {
            $newinfo['desc'] = $info['Data'][0]['Description'];
            $newinfo['pubdate'] = Common::myDate('Y-m-d',strtotime($info['Data'][0]['ReleaseDate']));
            $newinfo['version'] = $info['Data'][0]['Version'];
            $out['newinfo'] = $newinfo;
        }
        $out['myversion'] = $model->getMyVersion();

        echo json_encode($out);


    }
    //ajax检测版本权限(正版检测)
    public function action_ajax_check_right()
    {
        $model = new Model_Upgrade3();
        $status=$model->checkRightV();
        $out = array('status'=>$status);
        echo json_encode($out);

    }


    /*
     * 升级页面使用
     * 检测升级包(获取包括已升级和未升级的包的列表)
     *
     * */
    public function action_ajax_version()
    {
        $model = new Model_Upgrade3();
        $version = array();
        $info = $model->checkNewestPatch();
        if($info['Success']==1)
        {
            foreach($info['Data'] as $ver)
            {
                $ver_status = $ver['Status']==3 ? '(内测)' : '';
                $ar = array(
                    'desc'=>$model->genDesc($ver['Description']),
                    'pubdate'=>Common::myDate('Y-m-d',strtotime($ver['ReleaseDate'])),
                    'version'=>'思途CMS'.$ver['Version'].$ver_status,
                    'filesize'=>$model->format_bytes($ver['FileSize']),
                    'status'=>'未更新'
                );
                $version[] = $ar;
            }

        }
        $hasnum = count($version);
        if($hasnum<20)
        {
            $oldversion = $model->getOldPatch(20-$hasnum);
            if($oldversion['Success']==1)
            {
                foreach($oldversion['Data'] as $ver)
                {
                    $ver_status = $ver['Status']==3 ? '(内测)' : '';
                    $ar = array(
                        'desc'=>$model->genDesc($ver['Description']),
                        'pubdate'=>Common::myDate('Y-m-d',strtotime($ver['ReleaseDate'])),
                        'version'=>'思途CMS'.$ver['Version'].$ver_status,
                        'filesize'=>$model->format_bytes($ver['FileSize']),
                        'status'=>'已更新'
                    );
                    $version[] = $ar;
                }

            }
        }
        print_r(json_encode($version));//输出版本信息

    }



    //绑定授权ID
    public function action_bind()
    {
        $model = new Model_Upgrade3();
        $serial = $model->getSerialnumber();
        $this->assign('licenseid',$serial);
        $this->display('stourtravel/upgrade/bind');
    }
    //绑定ID
    public function action_ajax_bind_license()
    {
        $licenseid = Arr::get($_POST,'licenseid');
        $model = new Model_Upgrade3();
        $model->rewriteLicense($licenseid);
        $flag = $this->checkLicense();
        if($flag)
        {
            echo json_encode(array('status'=>1,'msg'=>'序列号绑定成功'));
        }
        else
        {
            echo json_encode(array('status'=>0,'msg'=>'序列号错误'));
        }
    }
    /*
     * ajax执行升级(每次只升级一个升级包)
     * */
    public function action_ajax_upgrade()
    {
        $out = array();
        if(!$this->checkdir())//检测目录写权限
        {
            $out['status'] = 0;
            $out['msg'] = '没有权限操作,请打开网站目录写权限';//目录无写权限
            echo json_encode($out);
            exit;

        }
        if(!$this->checkLicense())//检测序列号是否正确
        {
            $out['status'] = 0;
            $out['msg'] = '序列号验证失败,请检查序列号';//序列号错误
            $out['type'] = 'license_err';
            echo json_encode($out);
            exit;

        }


        $model = new Model_Upgrade3();
        $info = $model->getNewVersion();
        if($info['Success']==1)
        {
            if(!empty($info['Data']))
            {
                include(PUBLICPATH.'/vendor/httpdown.class.php');
                include(PUBLICPATH.'/vendor/pclzip.lib.php');
                $versionlist = array_reverse($info['Data']);
                $unzippath=BASEPATH; //解压路径
                $savepath=APPPATH."/data/patch/"; //更新包存储路径
                $ver = $versionlist[0];
                $downloadurl = $ver['Url'];
                $filename=$savepath.$ver['Name'].'.zip';
                $htd = new HttpDown();//实例化下载类
                $htd->OpenUrl($downloadurl);
                $ok = $htd->SaveToBin($filename);
                if($ok) //下载文件成功
                {
                    $archive = new PclZip($filename);
                    $extractResult = $archive->extract(PCLZIP_OPT_PATH, $unzippath,PCLZIP_CB_PRE_EXTRACT, 'preExtractCallBack',PCLZIP_OPT_REPLACE_NEWER);
                    if ($extractResult == 0 || $this->exists_extract_error($extractResult))
                    {
                        //die("Error : ".$archive->errorInfo(true));
                        $out['status'] = 0;
                        $out['msg'] = '升级文件解压失败,请检查目录及子目录是否有写权限';//目录无写权限
                        echo json_encode($out);
                        exit;
                    }
                    else
                    {
                        @unlink($filename);
                    }
                    //数据库升级
                    if(file_exists(BASEPATH.'/sql.php'))
                    {
                        $sqlfile=BASEPATH.'/sql.php';
                        $url=$GLOBALS['cfg_basehost'].'/sql.php';
                        $flag = Common::http($url);
                        if(strlen($flag) > 3)
                        {
                            $out['status'] = 0;
                            $out['msg'] ='数据库升级失败,请检查'.$flag;//数据库升级有错误,执行失败
                            echo json_encode($out);
                            exit;
                        }
                        else
                        {
                            @unlink($sqlfile);
                        }
                    }

                    //反馈版本信息
                    $regstatus = $model->regUpgradeStatus($downloadurl);
                    //版本包升级成功
                    if($regstatus['Success']==1)
                    {
                        //写版本
                        $pubdate = Common::myDate('Y-m-d',strtotime($ver['ReleaseDate']));
                        $version = $ver['Version'];
                        $model->rewriteVersion($version,0,$pubdate);

                        //@unlink($filename);
                        $out['status'] = 1;
                        $out['currentversion'] = '思途CMS'.$ver['Version'];
                        echo json_encode($out);
                        exit;
                    }
                    else
                    {
                        $out['status'] = 0;
                        $out['msg'] ='更新服务器登记版本失败!';
                        echo json_encode($out);
                        exit;
                    }
                }
                else
                {
                    $out['status'] = 0;
                    $out['msg'] ='下载升级包失败!';
                    echo json_encode($out);
                    exit;
                }

            }
            else
            {
                $out['status'] = 0;
                $out['msg'] ='此版本为官方内测版本,不能升级!';
                echo json_encode($out);
                exit;
            }

        }
        else
        {
            $out['status'] = 0;
            $out['msg'] ='获取新版本信息失败!';
            echo json_encode($out);
            exit;
        }

    }

    /*
     * 备份数据库
     *
     * */
    public function action_ajax_backup_database()
    {
        set_time_limit(0);

        $back = new Model_Backup();
        $back->backupAll();
        echo json_encode(array('status'=>true));
    }



    //检测解压条目中是否存在失败条目
    public function exists_extract_error($listContent)
    {
        if(!$listContent)
            return true;

        foreach($listContent as $entry)
        {
            if( $entry['status'] != 'ok' && $entry['status'] != 'already_a_directory' )
            {
                return true;
            }
        }

        return false;
    }

    //检测是否有写入权限
    public function checkdir()
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
        return $flag;
    }
    //检测license是否有效
    public function checkLicense()
    {
        $flag = 0;
        $model = new Model_Upgrade3();
        $info = $model->getLastPatch();
        if($info['Success']==1)
        {
            $flag = 1;
        }
        return $flag;

    }




    public function action_test()
    {
        //$model = new Model_Upgrade3();
        //$version = $model->getNewVersion();
        $flag = Common::http('http://www.lvyou.com/sql.php');
        echo $flag;

    }









}

//后台目录替换
function preExtractCallBack($p_event, &$p_header)
{

    $backdir = $GLOBALS['cfg_backdir'] ? $GLOBALS['cfg_backdir'] : 'newtravel';
    if(strpos($p_header['filename'],'newtravel')!==false)
    {
        $p_header['filename'] = str_replace('newtravel',$backdir,$p_header['filename']);
        if($p_header['stored_filename']=='newtravel/')
        {
            $p_header['stored_filename']=$backdir.'/';
        }
    }
    return 1;
}
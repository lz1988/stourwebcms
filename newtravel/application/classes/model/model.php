<?php defined('SYSPATH') or die('No direct access allowed.');

class Model_Model extends ORM {

    /*
     * 创建模型
     * */
    public static function createModel($arr)
    {
        $flag = 0;
        if(!self::checkWriteRight())return $flag;//检测是否有权限
        $modulename = $arr['modulename'];
        $pinyin = $arr['pinyin'];
        $addtable = $pinyin.'_extend_field';

        $sql = "insert into sline_model(modulename,pinyin,maintable,addtable,issystem)";
        $sql.= "values('$modulename','$pinyin','model_archive','$addtable',0)";
        $status = DB::query(2,$sql)->execute();
        $typeid = $status[0];//typeid
        if($typeid)
        {
            self::createTupianContent($typeid);
            self::createAddTable($pinyin,$modulename);
            self::createPageTemplet($pinyin,$modulename);
            self::createRightModule($typeid);
            self::createDestTable($pinyin);
            self::createNavItem($typeid,$pinyin,$modulename);
            self::createModuleDir($typeid,$pinyin,$modulename);
            self::writeHtaccess($pinyin,$modulename);
            $flag = 1;
        }
        return $flag;
    }
    public static function createTupianContent($typeid)
    {
        DB::query(null,"insert into sline_model_content(webid,typeid,columnname,chinesename,issystem,isopen,isrealfield) values(0,$typeid,'tupian','图片',1,1,0)")->execute();
    }
    /*
     * 创建模型附加表
     * */
    public  function createAddTable($pinyin,$modulename)
    {
       $sql = "CREATE TABLE `sline_".$pinyin."_extend_field` (
            `id` INT(11) NOT NULL AUTO_INCREMENT COMMENT '自增id',
            `productid` INT(11) NULL DEFAULT NULL COMMENT '产品id',
            PRIMARY KEY (`id`),
            INDEX `id` (`id`)
        )
        COMMENT='".$modulename."字段扩展表'
        COLLATE='utf8_general_ci'
        ENGINE=MyISAM;";
        DB::query(null,$sql)->execute();

    }
    /*
     * 创建模型目的地表
     * */
    public function createDestTable($pinyin)
    {
        $sql = "CREATE TABLE `sline_".$pinyin."_kindlist` (
                `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
                `kindid` INT(11) UNSIGNED NOT NULL DEFAULT '0',
                `seotitle` VARCHAR(255) NULL DEFAULT NULL,
                `keyword` VARCHAR(255) NULL DEFAULT NULL,
                `description` VARCHAR(255) NULL DEFAULT NULL,
                `tagword` VARCHAR(255) NULL DEFAULT NULL,
                `jieshao` TEXT NULL,
                `isfinishseo` INT(1) UNSIGNED NOT NULL DEFAULT '0',
                `displayorder` INT(4) UNSIGNED NULL DEFAULT '9999',
                `isnav` INT(1) UNSIGNED NULL DEFAULT '0' COMMENT '是否导航',
                `ishot` INT(1) UNSIGNED NULL DEFAULT '0' COMMENT '是否热门',
                `shownum` INT(8) NULL DEFAULT NULL,
                `templetpath` VARCHAR(255) NULL DEFAULT NULL,
                PRIMARY KEY (`id`),
                INDEX `kindid` (`kindid`)
            )
            COMMENT='模型目的地表'
            COLLATE='utf8_general_ci'
            ENGINE=MyISAM";
        DB::query(null,$sql)->execute();
    }
    /*
     * 创建模型页面模板配置信息
     * */
    public function createPageTemplet($pinyin,$modulename)
    {
        $arr = array(
            array('kindname'=>'首页','pagename'=>'index'),
            array('kindname'=>'列表页','pagename'=>'list'),
            array('kindname'=>'详细页','pagename'=>'show')
        );
        $sql = "insert into sline_page(pid,kindname,pagename) values (0,'$modulename','')";
        $status = DB::query(2,$sql)->execute();
        $pid = $status[0];
        if($pid)
        {
          foreach($arr as $row)
          {
              $kindname = $modulename.$row['kindname'];
              $pagename = $pinyin.'_'.$row['pagename'];
              $sql = "insert into sline_page(pid,kindname,pagename) values ('$pid','$kindname','$pagename')";
              DB::query(2,$sql)->execute();
          }
        }

    }

    /*
     * 创建模型右侧模块配置信息
     * */
    public function createRightModule($typeid)
    {
        $arr = array(
            array('pagename'=>'栏目首页','shortname'=>'index'),
            array('pagename'=>'栏目列表页','shortname'=>'search'),
            array('pagename'=>'栏目详细页','shortname'=>'show')
        );
        foreach($arr as $row)
        {
          $aid = Common::getLastAid('sline_module_config',0);
          $sql = "insert into sline_module_config(webid,aid,pagename,shortname,typeid,moduleids)";
          $sql.= "values(0,'$aid','{$row['pagename']}','{$row['shortname']}','$typeid','')";
          DB::query(2,$sql)->execute();
        }


    }
    /*
     * 创建模型导航信息到主导航
     * */
    public function createNavItem($typeid,$pinyin,$modulename)
    {
       $sql = "insert into sline_nav(webid,typeid,typename,shortname,url,linktype,isopen,issystem) values ";
       $sql.="('0','$typeid','$modulename','$modulename','/{$pinyin}/',1,1,1)";
       DB::query(2,$sql)->execute();
    }
    /*
     * 创建目录,复制控制器到相应目录
     * */
    public function createModuleDir($typeid,$pinyin,$modulename)
    {
        $destdir = BASEPATH.'/'.$pinyin;
        if(!file_exists($destdir))
        {
            mkdir($destdir);
        }
        $need_file_arr = array('index.php','show.php','booking.php');
        foreach($need_file_arr as $file)
        {
            $sourcefile = BASEPATH.'/tongyong/'.$file;
            $destfile = $destdir.'/'.$file;
            copy($sourcefile,$destfile);
        }
        self::writeConfigFile($typeid,$pinyin,$modulename);


    }
    public function writeConfigFile($typeid,$pinyin,$modulename)
    {
        $file = BASEPATH.'/'.$pinyin.'/config.php';
        $fp = fopen($file,'wb');
        flock($fp,3);
        fwrite($fp,"<?php\r\n");
        fwrite($fp,"\$module_pinyin='".$pinyin."';\r\n");
        fwrite($fp,"\$typeid='".$typeid."';\r\n");
        fwrite($fp,"\$module_name='".$modulename."';\r\n");
        fwrite($fp,"\$module_dest_table='sline_".$pinyin."_kindlist';\r\n");
        fwrite($fp,"\$module_extend_table='sline_".$pinyin."_extend_field';\r\n");
        fclose($fp);

    }

    /*
     * 写伪静态规则
     * */
    public function writeHtaccess($pinyin,$modulename)
    {

        $file = BASEPATH.'/.htaccess';
        $fp = fopen($file,"a+");
        flock($fp,3);
        fwrite($fp,"\r\n");
        fwrite($fp,'#'.$modulename."\r\n");
        fwrite($fp,'RewriteRule ^'.$pinyin.'/([a-z0-9]+)(/)?$ '.$pinyin.'/index.php?dest_id=$1'."\r\n");
        fwrite($fp,'RewriteRule ^'.$pinyin.'/([a-z0-9]+)-([0-9_]+)?$ '.$pinyin.'/index.php?dest_id=$1&attrid=$2'."\r\n");
        fwrite($fp,'RewriteRule ^'.$pinyin.'/([a-z0-9]+)-([0-9_]+)-([0-9]+)?$ '.$pinyin.'/index.php?dest_id=$1&attrid=$2&pageno=$3'."\r\n");
        fwrite($fp,'RewriteRule ^'.$pinyin.'/show_([0-9]+)+\.html$ '.$pinyin.'/show.php?aid=$1');
        fclose($fp);

    }

    /*
     * 获取当前模型名称
     * */
    public static function getModuleName($typeid)
    {
        $row = ORM::factory('model',$typeid)->as_array();
        return $row['modulename'];
    }
    /*
     * 获取模型信息
     * */
    public static function getModuleInfo($typeid)
    {
        $row = ORM::factory('model',$typeid)->as_array();
        return $row;
    }

    /*
     * 获取扩展表名称
     * */
    public static function getExtendTable($typeid)
    {
        $row = ORM::factory('model',$typeid)->as_array();
        return $row['addtable'];

    }

    public static function getAllModule()
    {
        $arr = ORM::factory('model')->where('isopen=1 and id>13')->get_all();

        return $arr;
    }
    /*
     * 检测是否有写权限
     * */
    public function checkWriteRight()
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

    public static  function updateNav($typeid,$isopen)
    {
        $model = ORM::factory('nav')->where("typeid='$typeid'")->find();
        if($model->id)
        {
            $model->isopen = $isopen;
            $model->save();

        }

    }


    /*
    * 删除模型
    * */
    public static function deleteModel($typdinfo)
    {
        $flag = 0;
        if (!self::checkWriteRight()) return $flag; //检测是否有权限

        $typeid = $typdinfo->id;
        $modulename = $typdinfo->modulename;
        $pinyin = $typdinfo->pinyin;

        self::deleteTupianContent($typeid);
        self::deleteAddTable($pinyin, $modulename);
        self::deletePageTemplet($pinyin, $modulename);
        self::deleteRightModule($typeid);
        self::deleteDestTable($pinyin);
        self::deleteNavItem($typeid, $pinyin, $modulename);
        self::deleteModuleDir($typeid, $pinyin, $modulename);
        self::deleteHtaccess($pinyin, $modulename);

        $sql = "delete from sline_model where id={$typeid}";
        DB::query(Database::DELETE, $sql)->execute();

        $flag = 1;
        return $flag;
    }

    public static function deleteTupianContent($typeid)
    {
        DB::query(null, "delete from sline_model_content where webid=0 and typeid={$typeid}")->execute();
    }

    /*
     * 创建模型附加表
     * */
    public function deleteAddTable($pinyin, $modulename)
    {
        $sql = "DROP TABLE IF EXISTS `sline_" . $pinyin . "_extend_field`;";
        DB::query(null, $sql)->execute();
    }

    /*
     * 创建模型目的地表
     * */
    public function deleteDestTable($pinyin)
    {
        $sql = "DROP TABLE IF EXISTS `sline_" . $pinyin . "_kindlist`;";
        DB::query(null, $sql)->execute();
    }

    /*
     * 创建模型页面模板配置信息
     * */
    public function deletePageTemplet($pinyin, $modulename)
    {
        $sql = "select id from sline_page where pid=0 and kindname='{$modulename}' and pagename=''";
        $status = DB::query(DataBase::SELECT, $sql)->execute()->as_array();
        $id = $status[0]['id'];
        if ($id)
        {
            $sql = "delete from sline_page where pid={$id}";
            DB::query(2, $sql)->execute();

            $sql = "delete from sline_page where id={$id}";
            $status = DB::query(2, $sql)->execute();
        }
    }

    /*
     * 创建模型右侧模块配置信息
     * */
    public function deleteRightModule($typeid)
    {
        $sql = "delete from sline_module_config where webid=0 and typeid={$typeid}";
        DB::query(2, $sql)->execute();
    }

    /*
     * 创建模型导航信息到主导航
     * */
    public function deleteNavItem($typeid, $pinyin, $modulename)
    {
        $sql = "delete from sline_nav where webid=0 and typeid={$typeid} and typename='{$modulename}'";
        DB::query(2, $sql)->execute();
    }

    /*
     * 创建目录,复制控制器到相应目录
     * */
    public function deleteModuleDir($typeid, $pinyin, $modulename)
    {
        $destdir = BASEPATH . '/' . $pinyin;
        if (is_dir($destdir))
        {
            $need_file_arr = array('index.php', 'show.php', 'booking.php','config.php','func.php');
            foreach ($need_file_arr as $file)
            {
                $destfile = $destdir . '/' . $file;
                unlink($destfile);
            }

            rmdir($destdir);
        }
    }

    /*
     * 写伪静态规则
     * */
    public function deleteHtaccess($pinyin, $modulename)
    {

        $file = BASEPATH . '/.htaccess';
        $fp = fopen($file, "r");
        $content = fread($fp, filesize($file));
        fclose($fp);

        $fp = fopen($file, "wb");
        flock($fp, 3);

        $content = str_ireplace('#' . $modulename . "\r\n", '', $content);
        $content = str_ireplace('RewriteRule ^' . $pinyin . '/([a-z0-9]+)(/)?$ ' . $pinyin . '/index.php?dest_id=$1' . "\r\n", '', $content);
        $content = str_ireplace('RewriteRule ^' . $pinyin . '/([a-z0-9]+)-([0-9_]+)?$ ' . $pinyin . '/index.php?dest_id=$1&attrid=$2' . "\r\n", '', $content);
        $content = str_ireplace('RewriteRule ^' . $pinyin . '/([a-z0-9]+)-([0-9_]+)-([0-9]+)?$ ' . $pinyin . '/index.php?dest_id=$1&attrid=$2&pageno=$3' . "\r\n", '', $content);
        $content = str_ireplace('RewriteRule ^' . $pinyin . '/show_([0-9]+)+\.html$ ' . $pinyin . '/show.php?aid=$1', '', $content);

        fwrite($fp, $content);
        fclose($fp);
    }


}
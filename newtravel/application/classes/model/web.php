<?php defined('SYSPATH') or die('No direct access allowed.');
/*
 * 站点管理类
 * */

class Model_Web {

    /**
     *  新建站点初始化数据
     *
     * @access    public
     * @return
     */
    public static function initData($webid)
    {



        $file=APPPATH.'data/init/childsiteinit.txt';
        $file_handle = fopen($file, "r");
        $query = '';
        while (!feof($file_handle))
        {
            $line = fgets($file_handle,4096);

            if(preg_match("#;#", $line))
            {
                $query .= $line;
                $query = str_replace('{webid}',$webid,$query);
                $query = str_replace('{fenhao}',';',$query);

                DB::query(2,$query)->execute();
                $query='';
            }
            else
            {
                $query .= $line;
            }


        }
        fclose($file_handle);

    }
    /*
     * 清除导航
     * */
    public static function delNav($siteid)
    {
        $sql = "delete from sline_nav where webid='$siteid'";
        DB::query(Database::DELETE,$sql)->execute();
    }
    /*
     * 清除右侧模块
     * */
    public static function delRightModule($siteid)
    {
        $sql = "delete from sline_module_config where webid='$siteid'";
        DB::query(Database::DELETE,$sql)->execute();
    }

    /*
   * 生成站点列表(前台使用)
   * */
    public static function genWeblist()
    {
        $out = array();
        $sql = "select webprefix,id,weburl,kindname from sline_destinations where iswebsite=1 ";
        $arr = DB::query(1,$sql)->execute()->as_array();
        foreach($arr as $row)
        {
            $out[$row['webprefix']]=array(
                'webprefix'=>$row['webprefix'],
                'weburl'=>$row['weburl'],
                'kindname'=>$row['kindname'],
                'webid'=>$row['id']
            );
        }
        $weblist = "<?php \$weblist= ".var_export($out,true).";";
        $webfile = BASEPATH.'/data/weblist.php';
        $fp = fopen($webfile,'wb');
        flock($fp,3);
        fwrite($fp,$weblist);
        fclose($fp);

    }
    /*
     * 生成配置文件
     * */
    public static function createDefaultConfig($siteid)
    {
        $m = new Model_Sysconfig();
        $m->writeConfig($siteid);
    }





}
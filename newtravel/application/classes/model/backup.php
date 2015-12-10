<?php defined('SYSPATH') or die('No direct access allowed.');
/*
 * 数据库备份操作类
 * */

class Model_Backup {


    public $alltables=array();
    public $sqlstr;
    public $views;
    public $tables;
    public $db;
    public $backdir;
    public function __construct()
    {


        $this->backdir = BASEPATH.'/data/backup/';

        $result = DB::query(Database::SELECT,"show tables")->execute();

        foreach($result as $re)
        {
            foreach($re as $r)
            {
                if(in_array($r,array('sline_admin','sline_stats','sline_stat','sline_tagword','sline_talist','sline_tmptag','sline_search')))
                    continue;
                $this->alltables[]=$r;
                $result2=DB::query(Database::SELECT,"show create table $r")->execute();


                foreach($result2[0] as $key=>$value)
                {
                    if($key=='View')
                    {
                        $this->views[]=$r;
                    }
                    if($key=='Table')
                    {
                        $this->tables[]=$r;
                    }
                }

            }
        }

    }



    //备份全部数据
    public function backupAll()
    {
        $tablelist = $this->tables;
        $folder = time();//以当前时间作为目录.
        $this->createFolder(time());//初始目录结构
        $path = $this->backdir.$folder;


        foreach($tablelist as $table)
        {
            $pos = stripos($table, 'sline_');
            if($pos !== false && $pos == 0)
            {
                $path1 = $path.'/tables/'.$table.'.sql';
                $path2 = $path.'/data/'.$table.'.sql';

                $flag1 = $this->backupTableStruct($table,$path1);
                $flag2 = $this->backupTableData($table,$path2);
            }
        }
        return true;
    }

    /*
	  备份表结构
	*/
    public function backupTableStruct($tablename,$file)
    {
        $query = DB::query(Database::SELECT,"show create table $tablename");
        $result=$query->execute()->as_array();

        $values=array_values($result[0]);


        if(empty($values[0]))
            return 0;
        //return $values[1];
        $flag = $this->writeData($file,$values[1]);
        return $flag;
    }
    /*
    备份表数据
    */
    public function backupTableData($tablename,$file)
    {
        $query = DB::query(Database::SELECT,"select * from $tablename");
        $result=$query->execute()->as_array();
        $filesize = intval(2048 * 1024 * 0.982);
        if(empty($result))
            return 1;
        $str='';
        foreach($result as $re)
        {
            if(strlen($str) <= $filesize)
            {
                $str.="insert into $tablename values(";
                foreach($re as $key=>$value)
                {
                    $value=mysql_real_escape_string($value);
                    $str.="'".$value."',";

                }
                $str=substr($str,0,-1).");\r\n";
            }
            else
            {
                $flag = $this->writeData($file,$str);
                $str ='';
            }
        }
        if(!empty($str))
        {
            $flag = $this->writeData($file,$str);
        }
        return $flag;

    }
    /*将数据写入文件*/
    public function writeData($file,$data,$mod='a+')
    {

        $fp = @fopen($file, $mod);
        @flock($fp, 2);
        if(!fwrite($fp, $data))
        {
            @fclose($fp);
            $status = 0;
        }
        else
        {

            $status = 1;
            fclose($fp);
        }
        return $status;
    }
    public function recoverStruct($table,$path)
    {
        $str=file_get_contents($path);
        if(!empty($str))
        {
            $status1= DB::query(Database::INSERT, "drop table if exists $table")->execute();
            $status2=DB::query(null,$str)->execute();
            return $status2;
        }
        else
            return false;
    }
    //还原表数据
    public function recoverData($table,$path)
    {
        if(!file_exists($path))
            return true;
        $contents =file_get_contents($path);
        $str_arr=explode("\r\n",$contents);
        foreach($str_arr as $v)
        {
            if(!empty($v))
                DB::query(null,$v)->execute();
        }
        return true;


    }

    //建立初始结构
    public function createFolder($timestamp)
    {
        $backuppath = $this->backdir;

        $mainpath=$backuppath.'/'.$timestamp;
        if(!file_exists($mainpath))
            mkdir($mainpath);
        $tablepath=$mainpath.'/tables';
        if(!file_exists($tablepath))
        {
            mkdir($tablepath);
        }
        $datapath=$mainpath.'/data';
        if(!file_exists($datapath))
        {
            mkdir($datapath);
        }

    }



 
}
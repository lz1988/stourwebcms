<?php defined('SYSPATH') or die('No direct access allowed.');

class Model_Weblist extends ORM {

   
    
    /*
 * 保存底部导航列表
 * @param int webid
 * @return array
 * */
    public function save($data)
    {
        $webname = ARR::get($data,'webname');

        $id = ARR::get($data,'id');

        for($i=0;isset($webname[$i]);$i++)
        {
            $obj = $this->where('id','=',$id[$i])->find();
            $obj->webname = $webname[$i];
            $obj->update();
            $obj->clear();
        }

    }


    /**
     *  新建站点初始化数据
     *
     * @access    public
     * @return
     */
    public function initData($webid,$webprefix)
    {



        $file=SLINEDATA.'/init/init.txt';
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

                $this->get_sql($query,2);
                $query='';
            }
            else
            {
                $query .= $line;
            }


        }
        fclose($file_handle);
        $defaultConfig=SLINEDATA.'/init/config.cache.txt';
        $destConfig=BASEPATH.'/sline/data/config/config.cache.'.$webprefix.'.inc.php';

        @copy($defaultConfig,$destConfig);

    }
    /**
     *  检测webprefix是否存在
     *
     * @access    public
     * @return   bool
     */
    public function checkPrefixExist($webprefix)
    {
        $flag = $this->where('webprefix','=',$webprefix)->find_all()->count();
        return $flag;

    }

   public  function getLastWebid()
    {


        $sql="select max(webid) as webid from sline_weblist order by id desc";
        $result = DB::query(1,$sql)->execute();
        $row = $result->current();


        //$row=$this->get_sql($sql);
        if(is_array($row))
        {
            $webid=$row['webid']+1;
        }

        return $webid;

    }



}
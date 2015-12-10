<?php defined('SYSPATH') or die('No direct access allowed.');
/*
 * 主导航模型
 * */

class Model_Nav extends ORM {

    protected  $_table_name = 'nav';

    /*
     * 获取主导航列表
     * @param int webid
     * @return array
     * */
    public function getNav($webid)
    {
        $arr = $this->where('webid','=',$webid)
                    ->and_where('pid','=','0')
                    ->order_by('displayorder','asc')
                    ->get_all();
        return $arr;

    }
    /*
   * 保存主导航列表
   * @param int webid
   * @return array
   * */
    public function saveNav($data)
    {
        $shortname = ARR::get($data,'shortname');
        $displayorder = ARR::get($data,'displayorder');
        $linktitle = ARR::get($data,'linktitle');
        $id = ARR::get($data,'id');
        $kind = ARR::get($data,'kind');
        $isopen = ARR::get($data,'isopen');
        for($i=0;isset($shortname[$i]);$i++)
        {
            $obj = $this->where('id','=',$id[$i])->find();
            $obj->shortname = $shortname[$i];
            $obj->displayorder = $displayorder[$i];
            $obj->kind = $kind[$i];
            $obj->linktitle = $linktitle[$i];
            $obj->isopen = $isopen[$i];
            $obj->update();
            $obj->clear();
        }




    }



    /*
     * 获取未设置信息数量
     * @param string column
     * @param int webid
     * @return int count
     * */
    public function getUnsetCount($column,$webid)
    {


        $arr = $this->where("$column is null and webid=$webid and pid=0",'','') ->get_all();
        return intval(count($arr));//返回数量

    }

    public function myTest()
    {
        $sql = "select * from sline_nav where webid=0 and pid=0";
        $arr = $this->get_sql($sql);
        return $arr;
    }

}
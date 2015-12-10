<?php defined('SYSPATH') or die('No direct access allowed.');

class Model_FooterNav extends ORM {

    protected  $_table_name = 'serverlist';
    /*
     * 获取底部导航列表
     * @param int webid
     * @return array
     * */
    public function getFooterNav($webid)
    {
        $arr = $this->where('webid','=',$webid)
            ->order_by('displayorder','asc')
            ->get_all();
        return $arr;
    }
        /*
    * 保存底部导航列表
    * @param int webid
    * @return array
    * */
    public function saveNav($data)
    {
        $servername = ARR::get($data,'servername');
        $displayorder = ARR::get($data,'displayorder');
        $id = ARR::get($data,'id');
        $isdisplay = ARR::get($data,'isdisplay');
        for($i=0;isset($servername[$i]);$i++)
        {
            $obj = $this->where('id','=',$id[$i])->find();
            $obj->servername = $servername[$i];
            $obj->displayorder = $displayorder[$i];
            $obj->isdisplay = $isdisplay[$i];
            $obj->update();
            $obj->clear();
        }

    }

}
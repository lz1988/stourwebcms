<?php defined('SYSPATH') or die('No direct script access.');
class Controller_Corp extends Stourweb_Controller{

    public function before()
    {
        parent::before();
        $this->assign('seoinfo',Common::getChannelSeo(4));
        $this->assign('cmsurl', URL::site());
    }

    //目的地列表
    public function action_index()
    {

        $sql="select * from sline_serverlist where isdisplay=1 order by displayorder asc";
        $list = DB::query(1,$sql)->execute()->as_array();
        $this->assign('list',$list);
        $this->display('corp/index');
    }

     //详情
    public function action_show()
    {
        $id=$this->params['id'];

        //详细信息
        $sql="select * from sline_serverlist where id='$id'";
        $row = DB::query(1,$sql)->execute()->as_array();

        if(empty($row[0])) exit('no data');

        $this->assign('info',$row[0]);
        $this->display('corp/show');
    }
}
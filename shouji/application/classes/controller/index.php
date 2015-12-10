<?php defined('SYSPATH') or die('No direct script access.');
class Controller_Index extends Stourweb_Controller{

    public function before()
    {
        parent::before();
        $this->assign('cmsurl', URL::site());
    }

    //手机版首页
    public function action_index()
    {
        $seotitle = Common::getSysPara('cfg_indextitle');
        $keyword = Common::getSysPara('cfg_keywords');
        $description = Common::getSysPara('cfg_description');
        $this->assign('seotitle',$seotitle);
        $this->assign('keyword',$keyword);
        $this->assign('description',$description);
        $this->display('index');

    }

}
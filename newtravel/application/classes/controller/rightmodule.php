<?php defined('SYSPATH') or die('No direct script access.');
class Controller_Rightmodule extends Stourweb_Controller{

    /*
     * 右侧模块控制器
     * */

	   public function action_index()
	   {
		   $this->display('stourtravel/drag');
	   }

}
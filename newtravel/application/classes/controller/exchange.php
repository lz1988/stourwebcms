<?php defined('SYSPATH') or die('No direct script access.');
/*
 * 积分兑换管理控制器
 * */
class Controller_Exchange  extends Stourweb_Controller{
    public function before()
    {
        parent::before();
        Common::getUserRight('exchange','smodify');
        $this->assign('parentkey',$this->params['parentkey']);
        $this->assign('itemid',$this->params['itemid']);
        $this->assign('weblist',Common::getWebList());

    }
	/*
	 *积分设置
	*/
	public function action_set()
	{
        $this->display('stourtravel/exchange/jifen_set');
	}
	

	

}
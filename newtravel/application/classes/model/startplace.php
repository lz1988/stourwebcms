<?php defined('SYSPATH') or die('No direct access allowed.');

class Model_Startplace extends ORM {

    protected  $_table_name = 'startplace';
	public static function getList()
	{
		 $model=ORM::factory('startplace');
		 $list=$model->where('pid=0')->get_all();
		 foreach($list as $k=>$v)
		 {
			 $list[$k]['children']=$model->where("pid={$v['id']} and isopen=1")->get_all();
		 }
		 return $list;
	}
}
<?php defined('SYSPATH') or die('No direct access allowed.');

class Model_Car_Kindlist extends ORM {

    protected  $_table_name = 'car_kindlist';
	
	
	public function deleteClear()
	{
		$this->delete();
	}

}
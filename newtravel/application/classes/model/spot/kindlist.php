<?php defined('SYSPATH') or die('No direct access allowed.');

class Model_Spot_Kindlist extends ORM {

    protected  $_table_name = 'spot_kindlist';
	
	
	public function deleteClear()
	{
		$this->delete();
	}

}
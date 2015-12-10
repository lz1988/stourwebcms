<?php defined('SYSPATH') or die('No direct access allowed.');

class Model_Tuan_Kindlist extends ORM {

    protected  $_table_name = 'tuan_kindlist';
	
	
	public function deleteClear()
	{
		$this->delete();
	}

}
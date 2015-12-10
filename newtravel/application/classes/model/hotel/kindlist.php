<?php defined('SYSPATH') or die('No direct access allowed.');

class Model_Hotel_Kindlist extends ORM {

    protected  $_table_name = 'hotel_kindlist';
	
	
	public function deleteClear()
	{
		$this->delete();
	}

}
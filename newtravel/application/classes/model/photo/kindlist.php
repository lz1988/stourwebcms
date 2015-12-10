<?php defined('SYSPATH') or die('No direct access allowed.');

class Model_Photo_Kindlist extends ORM {

    protected  $_table_name = 'photo_kindlist';
	
	
	public function deleteClear()
	{
		$this->delete();
	}

}
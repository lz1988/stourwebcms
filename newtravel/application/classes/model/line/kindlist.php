<?php defined('SYSPATH') or die('No direct access allowed.');

class Model_Line_Kindlist extends ORM {

    protected  $_table_name = 'line_kindlist';
	
	
	public function deleteClear()
	{
		$this->delete();
	}

}
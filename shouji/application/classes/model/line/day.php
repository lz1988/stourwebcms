<?php defined('SYSPATH') or die('No direct access allowed.');

class Model_Line_Day extends ORM {
    protected  $_table_name = 'line_day';
	
	public function deleteClear()
	{
		$this->delete();
	}
}
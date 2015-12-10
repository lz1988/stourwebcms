<?php defined('SYSPATH') or die('No direct access allowed.');

class Model_Tuan_Attr extends ORM {

    protected  $_table_name = 'tuan_attr';
	
	
	public function deleteClear()
	{
		$this->delete();
	}

}
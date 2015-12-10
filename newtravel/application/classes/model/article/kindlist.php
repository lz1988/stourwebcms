<?php defined('SYSPATH') or die('No direct access allowed.');

class Model_Article_Kindlist extends ORM {

    protected  $_table_name = 'article_kindlist';
	
	
	public function deleteClear()
	{
		$this->delete();
	}

}
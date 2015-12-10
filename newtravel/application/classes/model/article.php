<?php defined('SYSPATH') or die('No direct access allowed.');

class Model_Article extends ORM {

    protected  $_table_name = 'article';
    
	public function deleteClear()
	{    
		// Common::deleteRelativeImage($this->litpic);
		// Common::deleteContentImage($this->content);
		 $this->delete();
	}
}
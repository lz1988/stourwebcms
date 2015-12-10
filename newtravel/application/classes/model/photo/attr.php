<?php defined('SYSPATH') or die('No direct access allowed.');

class Model_Photo_Attr extends ORM {

    protected  $_table_name = 'photo_attr';
    
	public function deleteClear()
	{    
		// Common::deleteRelativeImage($this->litpic);
		// Common::deleteContentImage($this->content);
		// $this->delete();
	}
}
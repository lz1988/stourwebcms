<?php defined('SYSPATH') or die('No direct access allowed.');

class Model_Photo extends ORM {

    protected  $_table_name = 'photo';
    
	public function deleteClear()
	{    
	
	     
		 Common::deleteRelativeImage($this->litpic);
		 
		 $pictures=ORM::factory('photo_picture')->where("pid={$this->id}")->find_all()->as_array();
		 foreach($pictures as $picture)
		 {
			 if($picture->id)
			   $picture->deleteClear();
		 }
		// Common::deleteRelativeImage($this->litpic);
		 
		// Common::deleteContentImage($this->content);
		 $this->delete();
	}
}
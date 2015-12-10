<?php defined('SYSPATH') or die('No direct access allowed.');

class Model_Visa extends ORM {

	public function deleteClear()
	{    
		 Common::deleteRelativeImage($this->litpic);
		 $this->delete();
	}
}
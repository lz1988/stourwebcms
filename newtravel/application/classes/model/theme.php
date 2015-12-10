<?php defined('SYSPATH') or die('No direct access allowed.');

class Model_Theme extends ORM {
     
	 public function deleteClear()
	 {
		 $this->delete();
	 }
}
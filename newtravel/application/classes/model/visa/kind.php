<?php defined('SYSPATH') or die('No direct access allowed.');

class Model_Visa_Kind extends ORM {
 
     public function deleteClear()
	 {
		 $this->delete();  
	 }
}
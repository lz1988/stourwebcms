<?php defined('SYSPATH') or die('No direct access allowed.');

class Model_Car extends ORM {
    
	public function deleteClear()
	{
		
		 $suits=ORM::factory('car_suit')->where("carid={$this->id}")->find_all()->as_array(); 
		 foreach($suits as $suit)
		 {
			 $suit->deleteClear();
		 }
		 Common::deleteRelativeImage($this->litpic);
		 $piclist=explode(',',$this->piclist);
		 foreach($piclist as $k=>$v)
		 {
			  $img_arr=explode('||',$v);
			  Common::deleteRelativeImage($img_arr[0]);
		 }
		 $this->delete();
	}
   
}
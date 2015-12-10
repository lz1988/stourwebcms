<?php defined('SYSPATH') or die('No direct access allowed.');

class Model_Hotel extends ORM {
      public function deleteClear()
	  {
		  
		 $rooms=ORM::factory('hotel_room')->where("hotelid={$this->id}")->find_all()->as_array();
		 foreach($rooms as $room)
		 {
			 if($room->id)
			 $room->deleteClear();
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
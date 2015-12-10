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
		/* Common::deleteRelativeImage($this->litpic);
		 $piclist=explode(',',$this->piclist);
		 foreach($piclist as $k=>$v)
		 {
			  $img_arr=explode('||',$v);
			  Common::deleteRelativeImage($img_arr[0]);
		 }*/
		 $this->delete();
	  }
    /*
     * 更新最低报价
     * */
     public static function updateMinPrice($hotelid)
     {
         $sql = "SELECT MIN(price) as price FROM sline_hotel_room_price WHERE hotelid='$hotelid' and price>0 and day>=UNIX_TIMESTAMP()";
         $ar = DB::query(1,$sql)->execute()->as_array();
         $price = $ar[0]['price'] ? $ar[0]['price'] : 0;
         $model = ORM::factory('hotel',$hotelid);
         $model->price = $price;
         $model->update();


     }
}
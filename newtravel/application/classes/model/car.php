<?php defined('SYSPATH') or die('No direct access allowed.');

class Model_Car extends ORM {
    
	public function deleteClear()
	{
		
		 $suits=ORM::factory('car_suit')->where("carid={$this->id}")->find_all()->as_array(); 
		 foreach($suits as $suit)
		 {
			 $suit->deleteClear();
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
    public static function updateMinPrice($carid)
    {
        $sql = "SELECT MIN(adultprice) as price FROM sline_car_suit_price WHERE carid='$carid' and adultprice>0";
        $ar = DB::query(1,$sql)->execute()->as_array();
        $price = $ar[0]['adultprice'] ? $ar[0]['adultprice'] : 0;
        $model = ORM::factory('car',$carid);
        $model->price = $price;
        $model->update();


    }
   
}
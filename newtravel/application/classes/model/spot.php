<?php defined('SYSPATH') or die('No direct access allowed.');

class Model_Spot extends ORM {

    protected  $_table_name = 'spot';
    
	public function deleteClear()
	{    
	     $tickets=ORM::factory('spot_ticket')->where("spotid={$this->id}")->find_all()->as_array(); 
		 foreach($tickets as $ticket)
		 {
			 $ticket->deleteClear();
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
    public static function updateMinPrice($spotid)
    {
        $sql = "SELECT MIN(cast(ourprice as unsigned)) as price FROM sline_spot_ticket WHERE spotid='$spotid'";
        $ar = DB::query(1,$sql)->execute()->as_array();
        $price = $ar[0]['price'] ? $ar[0]['price'] : 0;
        $model = ORM::factory('spot',$spotid);
        $model->price = $price;
        $model->update();


    }
}
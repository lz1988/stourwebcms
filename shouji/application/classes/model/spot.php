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
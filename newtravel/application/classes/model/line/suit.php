<?php defined('SYSPATH') or die('No direct access allowed.');

class Model_Line_Suit extends ORM {
    protected  $_table_name = 'line_suit';
	
	public function deleteClear()
	{
	   if($this->id)
       {
           DB::delete('line_suit_price')->where("suitid={$this->id}")->execute();
           $this->delete();

       }

	}
}
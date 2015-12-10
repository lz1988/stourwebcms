<?php defined('SYSPATH') or die('No direct access allowed.');

class Model_Car_Suit extends ORM {
    public function deleteClear()
	{
	    DB::delete('car_suit_price')->where("suitid={$this->id}")->execute();
		$this->delete();
	}
}
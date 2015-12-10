<?php defined('SYSPATH') or die('No direct access allowed.');

class Model_Car_Suit_Type extends ORM {
    public function deleteClear()
	{
		$this->delete();
	}
}
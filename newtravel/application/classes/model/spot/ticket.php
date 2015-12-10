<?php defined('SYSPATH') or die('No direct access allowed.');

class Model_Spot_Ticket extends ORM {

    protected  $_table_name = 'spot_ticket';
    
	public function deleteClear()
	{
		 $this->delete();
	}
}
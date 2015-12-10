<?php defined('SYSPATH') or die('No direct access allowed.');

class Model_Hotel_Rank extends ORM {
      
	   
	 public static function getList($webid=0)
	 {
	     return ORM::factory('hotel_rank')->where("webid=$webid")->get_all();	 
	 }

}
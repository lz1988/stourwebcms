<?php defined('SYSPATH') or die('No direct access allowed.');

class Model_Spot_Attr extends ORM {

    protected  $_table_name = 'spot_attr';
    
	public function deleteClear()
	{
		 $this->delete();
	}
	public static function getAttrnameList($attrid_str,$separator=',')
	{
		$attrid_arr=explode(',',$attrid_str);
		foreach($attrid_arr as $k=>$v)
		{
			$attr=ORM::factory('spot_attr',$v);
			
			if($attr->attrname)
			$attr_str.=$attr->attrname.$separator;
		}
		$attr_str=trim($attr_str,$separator);
	    return $attr_str;
		
	}
}
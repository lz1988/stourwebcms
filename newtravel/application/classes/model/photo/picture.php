<?php defined('SYSPATH') or die('No direct access allowed.');

class Model_Photo_Picture extends ORM {

    protected  $_table_name = 'photo_picture';
	public function deleteClear()
	{    
		// Common::deleteRelativeImage($this->litpic);
		// Common::deleteContentImage($this->content);
		 $this->delete();
	}
    public static function getPicturesByPid($pid)
    {
        if(empty($pid))
            return null;
        $list=ORM::factory('photo_picture')->where("pid=$pid")->get_all();
        $result=array();
        foreach($list as $k=>$v)
        {
            $result[]=array('litpic'=>$v['litpic'],'desc'=>$v['description']);
        }
        return $result;
    }
}
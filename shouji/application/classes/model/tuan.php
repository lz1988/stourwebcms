<?php defined('SYSPATH') or die('No direct access allowed.');

class Model_Tuan extends ORM {

    protected  $_table_name = 'tuan';
    
	public function deleteClear()
	{    
		 Common::deleteRelativeImage($this->litpic);
		 $piclist=explode(',',$this->piclist);
		 foreach($piclist as $k=>$v)
		 {
			  $img_arr=explode('||',$v);
			  Common::deleteRelativeImage($img_arr[0]);
		 }
		 $this->delete();
	}

    /*
     * 处理图片
     * */
    public static  function  handlePicture($piclist)
    {
        $pic_arr = explode(',',$piclist);
        $out = array();
        foreach($pic_arr as $row)
        {
            $pic = explode('||',$row);
            $p = $pic[0];
            $out[]['litpic'] = $p;

        }
        return $out;
    }
}
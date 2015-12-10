<?php defined('SYSPATH') or die('No direct access allowed.');

class Model_Destinations extends ORM{
	 
    public function deleteCascade()
	{
		
	}
	//删除目的地
	public function deleteClear()
	{
		$children=ORM::factory('destinations')->where("pid={$this->id}")->find_all()->as_array();
		foreach($children as $child)
		{
			$child->deleteClear();
		}
		$this->updateSibling('del');
		Common::deleteRelativeImage($this->litpic);
		$piclist=explode(',',$this->piclist);
		 foreach($piclist as $k=>$v)
		 {
			  $img_arr=explode('||',$v);
			  Common::deleteRelativeImage($img_arr[0]);
		 }
	    $this->delete();
		
	}
	//更新其他产品的目的地关联列表 
	public function updateSibling($action='add')
	{
	   $kindid=$this->id;	
	   $table=array("1"=>"line_kindlist","2"=>"hotel_kindlist","3"=>"car_kindlist","4"=>"article_kindlist","5" =>"spot_kindlist","6"=>"photo_kindlist","13"=>"tuan_kindlist");
	   foreach($table as $tablename)
	   {
		 if($action=='add')
		 {
		    $model_num=ORM::factory($tablename)->where("kindid=$kindid")->count_all();
			if($model_num<1)
			{
				
				$model=ORM::factory($tablename);
				$model->kindid=$kindid;
				$model->save();
			}
		 }
		 else if($action=='del')
		 {
		     $models=ORM::factory($tablename)->where("kindid=$kindid")->find_all()->as_array();
			 foreach($models as $m)
			 {
				 $m->delete();
			 }
		 }
	
	   }	
	   return true;
	}
	/*
	   根据目的地ID字符串（逗号分隔) ，返回目的地名称
	*/
	public static function getKindnameList($kindid_str,$separator=',')
	{
		$kind_arr=explode(',',$kindid_str);
		foreach($kind_arr as $k=>$v)
		{
			$dest=ORM::factory('destinations',$v);
			
			if($dest->kindname)
			$dest_str.=$dest->kindname.$separator;
		}
		$dest_str=trim($dest_str,$separator);
	    return $dest_str;
	}
	/*
	   获取目的地的所有祖先目的地
	*/
	public static function getParents($id)
	{
		
		$first_dest=ORM::factory('destinations',$id);
		if(!$first_dest->id)
		   return null;
		$cid=$first_dest->pid;
		while(true)
		{
			$cur_dest=ORM::factory('destinations',$cid);
			
			if($cur_dest->id==0)
			  return null;
			$new_row['id']=$cur_dest->id;
			$new_row['kindname']=$cur_dest->id;
			$parents[]=$new_row;  
			
			if($cur_dest->pid==0)
			{
				break;
			}
			$cid=$cur_dest->pid;
			
			
		}
		return $parents;
	}
    /*
     * 根据目的地ID字符串（逗号分隔) ，返回目的地数组
     */
	public static function getKindlistArr($kindid_str)
    {
        $kindid_arr=explode(',',$kindid_str);
        $kind_arr=array();
        foreach($kindid_arr as $v)
        {
            $dest=ORM::factory('destinations',$v);
            if($dest->id)
            {
                $kind_arr[]=$dest->as_array();
            }

        }
        return $kind_arr;

    }
}
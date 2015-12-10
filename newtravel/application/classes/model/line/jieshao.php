<?php defined('SYSPATH') or die('No direct access allowed.');

class Model_Line_Jieshao extends ORM {
    protected  $_table_name = 'line_jieshao';
	
	public function deleteClear()
	{
		
		//DB::delete('line_suit_price')->where("suitid={$this->id}")->execute();
		$this->delete();
	}

    public function deleteByLineId($lineid)
    {
        $sql = "delete from sline_line_jieshao where lineid = '$lineid'";
        $this->query($sql,3);
    }
}
<?php
class Model_Help extends ORM {

    protected  $_table_name = 'help';
    
	public function deleteClear()
	{    
        // Common::deleteContentImage($this->body);
		 $this->delete();
	}
}
<?php defined('SYSPATH') or die('No direct access allowed.');

class Model_Admin extends ORM {

    public function deleteClear()
    {
        $this->delete();
    }
}
<?php defined('SYSPATH') or die('No direct access allowed.');
/*
 * 通用模型工厂
 * @author:netman
 * */
class Model_Tongyong extends ORM {

    public function __construct($tablename)
    {
        $this->_table_name = $tablename;
        $this->_object_name = $tablename;
        $this->_actual_model_name = 'model_'.strtolower($tablename);
        parent::_initialize();
    }




}
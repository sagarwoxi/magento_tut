<?php

class Webonise_Pdfupload_Model_Mysql4_Example_Collection extends Mage_Core_Model_Mysql4_Collection_Abstract
{
    public function _construct()
    {
        parent::_construct();
        $this->_init('pdfupload/example');
    }
}
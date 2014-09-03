<?php

class Webonise_Pdfupload_Model_Mysql4_Example extends Mage_Core_Model_Abstract
{
    public function _construct()
    {
        parent::_construct();
        $this->_init('pdfupload/example');
    }
}
<?php

class Webonise_Pdfupload_Model_Mysql4_tut_webonise_pdfupload_example extends Mage_Core_Model_Abstract
{
    public function _construct()
    {
        // Note that the web_id refers to the key field in your database table.
        $this->_init('pdfupload/example', 'id');
    }
}
<?php
class Webonise_PdfUpload_Model_Mysql4_Pdfupload extends Mage_Core_Model_Mysql4_Abstract
{
    protected function _construct()
    {
        $this->_init("pdfupload/pdfupload", "pdfupload_id");
    }
}
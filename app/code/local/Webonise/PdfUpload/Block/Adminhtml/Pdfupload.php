<?php


class Webonise_PdfUpload_Block_Adminhtml_Pdfupload extends Mage_Adminhtml_Block_Widget_Grid_Container{

	public function __construct()
	{

	$this->_controller = "adminhtml_pdfupload";
	$this->_blockGroup = "pdfupload";
	$this->_headerText = Mage::helper("pdfupload")->__("Pdfupload Manager");
	$this->_addButtonLabel = Mage::helper("pdfupload")->__("Add New Item");
	parent::__construct();
	
	}

}
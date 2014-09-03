<?php
	
class Webonise_PdfUpload_Block_Adminhtml_Pdfupload_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
		public function __construct()
		{

				parent::__construct();
				$this->_objectId = "pdfupload_id";
				$this->_blockGroup = "pdfupload";
				$this->_controller = "adminhtml_pdfupload";
				$this->_updateButton("save", "label", Mage::helper("pdfupload")->__("Save Item"));
				$this->_updateButton("delete", "label", Mage::helper("pdfupload")->__("Delete Item"));

				$this->_addButton("saveandcontinue", array(
					"label"     => Mage::helper("pdfupload")->__("Save And Continue Edit"),
					"onclick"   => "saveAndContinueEdit()",
					"class"     => "save",
				), -100);



				$this->_formScripts[] = "

							function saveAndContinueEdit(){
								editForm.submit($('edit_form').action+'back/edit/');
							}
						";
		}

		public function getHeaderText()
		{
				if( Mage::registry("pdfupload_data") && Mage::registry("pdfupload_data")->getId() ){

				    return Mage::helper("pdfupload")->__("Edit Item '%s'", $this->htmlEscape(Mage::registry("pdfupload_data")->getId()));

				} 
				else{

				     return Mage::helper("pdfupload")->__("Add Item");

				}
		}
}
<?php
class Webonise_PdfUpload_Block_Adminhtml_Pdfupload_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs
{
		public function __construct()
		{
				parent::__construct();
				$this->setId("pdfupload_tabs");
				$this->setDestElementId("edit_form");
				$this->setTitle(Mage::helper("pdfupload")->__("Item Information"));
		}
		protected function _beforeToHtml()
		{
				$this->addTab("form_section", array(
				"label" => Mage::helper("pdfupload")->__("Item Information"),
				"title" => Mage::helper("pdfupload")->__("Item Information"),
				"content" => $this->getLayout()->createBlock("pdfupload/adminhtml_pdfupload_edit_tab_form")->toHtml(),
				));
				return parent::_beforeToHtml();
		}

}

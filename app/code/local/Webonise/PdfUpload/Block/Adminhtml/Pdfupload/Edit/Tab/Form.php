<?php
class Webonise_PdfUpload_Block_Adminhtml_Pdfupload_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form
{
		protected function _prepareForm()
		{

				$form = new Varien_Data_Form();
				$this->setForm($form);
				$fieldset = $form->addFieldset("pdfupload_form", array("legend"=>Mage::helper("pdfupload")->__("Item information")));

				
						$fieldset->addField("name", "text", array(
						"label" => Mage::helper("pdfupload")->__("Name"),
						"name" => "name",
						));
									
						$fieldset->addField('file', 'image', array(
						'label' => Mage::helper('pdfupload')->__('File'),
						'name' => 'file',
						'note' => '(*.jpg, *.png, *.gif)',
						));

				if (Mage::getSingleton("adminhtml/session")->getPdfuploadData())
				{
					$form->setValues(Mage::getSingleton("adminhtml/session")->getPdfuploadData());
					Mage::getSingleton("adminhtml/session")->setPdfuploadData(null);
				} 
				elseif(Mage::registry("pdfupload_data")) {
				    $form->setValues(Mage::registry("pdfupload_data")->getData());
				}
				return parent::_prepareForm();
		}
}

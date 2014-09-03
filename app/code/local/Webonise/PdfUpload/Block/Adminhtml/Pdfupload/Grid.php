<?php

class Webonise_PdfUpload_Block_Adminhtml_Pdfupload_Grid extends Mage_Adminhtml_Block_Widget_Grid
{

		public function __construct()
		{
				parent::__construct();
				$this->setId("pdfuploadGrid");
				$this->setDefaultSort("pdfupload_id");
				$this->setDefaultDir("DESC");
				$this->setSaveParametersInSession(true);
		}

		protected function _prepareCollection()
		{
				$collection = Mage::getModel("pdfupload/pdfupload")->getCollection();
				$this->setCollection($collection);
				return parent::_prepareCollection();
		}
		protected function _prepareColumns()
		{
				$this->addColumn("pdfupload_id", array(
				"header" => Mage::helper("pdfupload")->__("ID"),
				"align" =>"right",
				"width" => "50px",
			    "type" => "number",
				"index" => "pdfupload_id",
				));
                
				$this->addColumn("name", array(
				"header" => Mage::helper("pdfupload")->__("Name"),
				"index" => "name",
				));
			$this->addExportType('*/*/exportCsv', Mage::helper('sales')->__('CSV')); 
			$this->addExportType('*/*/exportExcel', Mage::helper('sales')->__('Excel'));

				return parent::_prepareColumns();
		}

		public function getRowUrl($row)
		{
			   return $this->getUrl("*/*/edit", array("id" => $row->getId()));
		}


		
		protected function _prepareMassaction()
		{
			$this->setMassactionIdField('pdfupload_id');
			$this->getMassactionBlock()->setFormFieldName('pdfupload_ids');
			$this->getMassactionBlock()->setUseSelectAll(true);
			$this->getMassactionBlock()->addItem('remove_pdfupload', array(
					 'label'=> Mage::helper('pdfupload')->__('Remove Pdfupload'),
					 'url'  => $this->getUrl('*/adminhtml_pdfupload/massRemove'),
					 'confirm' => Mage::helper('pdfupload')->__('Are you sure?')
				));
			return $this;
		}
			

}
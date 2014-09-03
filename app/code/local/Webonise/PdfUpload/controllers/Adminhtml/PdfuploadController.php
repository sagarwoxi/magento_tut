<?php

class Webonise_PdfUpload_Adminhtml_PdfuploadController extends Mage_Adminhtml_Controller_Action
{
		protected function _initAction()
		{
				$this->loadLayout()->_setActiveMenu("pdfupload/pdfupload")->_addBreadcrumb(Mage::helper("adminhtml")->__("Pdfupload  Manager"),Mage::helper("adminhtml")->__("Pdfupload Manager"));
				return $this;
		}
		public function indexAction() 
		{
			    $this->_title($this->__("PdfUpload"));
			    $this->_title($this->__("Manager Pdfupload"));

				$this->_initAction();
				$this->renderLayout();
		}
		public function editAction()
		{			    
			    $this->_title($this->__("PdfUpload"));
				$this->_title($this->__("Pdfupload"));
			    $this->_title($this->__("Edit Item"));
				
				$id = $this->getRequest()->getParam("id");
				$model = Mage::getModel("pdfupload/pdfupload")->load($id);
				if ($model->getId()) {
					Mage::register("pdfupload_data", $model);
					$this->loadLayout();
					$this->_setActiveMenu("pdfupload/pdfupload");
					$this->_addBreadcrumb(Mage::helper("adminhtml")->__("Pdfupload Manager"), Mage::helper("adminhtml")->__("Pdfupload Manager"));
					$this->_addBreadcrumb(Mage::helper("adminhtml")->__("Pdfupload Description"), Mage::helper("adminhtml")->__("Pdfupload Description"));
					$this->getLayout()->getBlock("head")->setCanLoadExtJs(true);
					$this->_addContent($this->getLayout()->createBlock("pdfupload/adminhtml_pdfupload_edit"))->_addLeft($this->getLayout()->createBlock("pdfupload/adminhtml_pdfupload_edit_tabs"));
					$this->renderLayout();
				} 
				else {
					Mage::getSingleton("adminhtml/session")->addError(Mage::helper("pdfupload")->__("Item does not exist."));
					$this->_redirect("*/*/");
				}
		}

		public function newAction()
		{

		$this->_title($this->__("PdfUpload"));
		$this->_title($this->__("Pdfupload"));
		$this->_title($this->__("New Item"));

        $id   = $this->getRequest()->getParam("id");
		$model  = Mage::getModel("pdfupload/pdfupload")->load($id);

		$data = Mage::getSingleton("adminhtml/session")->getFormData(true);
		if (!empty($data)) {
			$model->setData($data);
		}

		Mage::register("pdfupload_data", $model);

		$this->loadLayout();
		$this->_setActiveMenu("pdfupload/pdfupload");

		$this->getLayout()->getBlock("head")->setCanLoadExtJs(true);

		$this->_addBreadcrumb(Mage::helper("adminhtml")->__("Pdfupload Manager"), Mage::helper("adminhtml")->__("Pdfupload Manager"));
		$this->_addBreadcrumb(Mage::helper("adminhtml")->__("Pdfupload Description"), Mage::helper("adminhtml")->__("Pdfupload Description"));


		$this->_addContent($this->getLayout()->createBlock("pdfupload/adminhtml_pdfupload_edit"))->_addLeft($this->getLayout()->createBlock("pdfupload/adminhtml_pdfupload_edit_tabs"));

		$this->renderLayout();

		}
		public function saveAction()
		{

			$post_data=$this->getRequest()->getPost();


				if ($post_data) {

					try {

						
				 //save image
		try{

if((bool)$post_data['file']['delete']==1) {

	        $post_data['file']='';

}
else {

	unset($post_data['file']);

	if (isset($_FILES)){

		if ($_FILES['file']['name']) {

			if($this->getRequest()->getParam("id")){
				$model = Mage::getModel("pdfupload/pdfupload")->load($this->getRequest()->getParam("id"));
				if($model->getData('file')){
						$io = new Varien_Io_File();
						$io->rm(Mage::getBaseDir('media').DS.implode(DS,explode('/',$model->getData('file'))));	
				}
			}
						$path = Mage::getBaseDir('media') . DS . 'pdfupload' . DS .'pdfupload'.DS;
						$uploader = new Varien_File_Uploader('file');
						$uploader->setAllowedExtensions(array('pdf'));
						$uploader->setAllowRenameFiles(false);
						$uploader->setFilesDispersion(false);
						$destFile = $path.$_FILES['file']['name'];
						$filename = $uploader->getNewFileName($destFile);
						$uploader->save($path, $filename);

						$post_data['filename']='pdfupload/pdfupload/'.$filename;
		}
    }
}

        } catch (Exception $e) {
				Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
				$this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
				return;
        }
//save image


						$model = Mage::getModel("pdfupload/pdfupload")
						->addData($post_data)
						->setId($this->getRequest()->getParam("id"))
						->save();

						Mage::getSingleton("adminhtml/session")->addSuccess(Mage::helper("adminhtml")->__("Pdfupload was successfully saved"));
						Mage::getSingleton("adminhtml/session")->setPdfuploadData(false);

						if ($this->getRequest()->getParam("back")) {
							$this->_redirect("*/*/edit", array("id" => $model->getId()));
							return;
						}
						$this->_redirect("*/*/");
						return;
					} 
					catch (Exception $e) {
						Mage::getSingleton("adminhtml/session")->addError($e->getMessage());
						Mage::getSingleton("adminhtml/session")->setPdfuploadData($this->getRequest()->getPost());
						$this->_redirect("*/*/edit", array("id" => $this->getRequest()->getParam("id")));
					return;
					}

				}
				$this->_redirect("*/*/");
		}



		public function deleteAction()
		{
				if( $this->getRequest()->getParam("id") > 0 ) {
					try {
						$model = Mage::getModel("pdfupload/pdfupload");
						$model->setId($this->getRequest()->getParam("id"))->delete();
						Mage::getSingleton("adminhtml/session")->addSuccess(Mage::helper("adminhtml")->__("Item was successfully deleted"));
						$this->_redirect("*/*/");
					} 
					catch (Exception $e) {
						Mage::getSingleton("adminhtml/session")->addError($e->getMessage());
						$this->_redirect("*/*/edit", array("id" => $this->getRequest()->getParam("id")));
					}
				}
				$this->_redirect("*/*/");
		}

		
		public function massRemoveAction()
		{
			try {
				$ids = $this->getRequest()->getPost('pdfupload_ids', array());
				foreach ($ids as $id) {
                      $model = Mage::getModel("pdfupload/pdfupload");
					  $model->setId($id)->delete();
				}
				Mage::getSingleton("adminhtml/session")->addSuccess(Mage::helper("adminhtml")->__("Item(s) was successfully removed"));
			}
			catch (Exception $e) {
				Mage::getSingleton("adminhtml/session")->addError($e->getMessage());
			}
			$this->_redirect('*/*/');
		}
			
		/**
		 * Export order grid to CSV format
		 */
		public function exportCsvAction()
		{
			$fileName   = 'pdfupload.csv';
			$grid       = $this->getLayout()->createBlock('pdfupload/adminhtml_pdfupload_grid');
			$this->_prepareDownloadResponse($fileName, $grid->getCsvFile());
		} 
		/**
		 *  Export order grid to Excel XML format
		 */
		public function exportExcelAction()
		{
			$fileName   = 'pdfupload.xml';
			$grid       = $this->getLayout()->createBlock('pdfupload/adminhtml_pdfupload_grid');
			$this->_prepareDownloadResponse($fileName, $grid->getExcelFile($fileName));
		}
}

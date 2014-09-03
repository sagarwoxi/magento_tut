<?php
 
class Webonise_Pdfupload_Adminhtml_ExampleController extends Mage_Adminhtml_Controller_Action
{
 
    public function indexAction()
    {
 
        $this->loadLayout();
        $this->renderLayout();
    }
 
    public function newAction()
    {
        $this->_forward('edit');
    }
 
    public function editAction()
    {
        $id = $this->getRequest()->getParam('id', null);
        $model = Mage::getModel('awesome/example');
        if ($id) {
            $model->load((int) $id);
            if ($model->getId()) {
                $data = Mage::getSingleton('adminhtml/session')->getFormData(true);
                if ($data) {
                    $model->setData($data)->setId($id);
                }
            } else {
                Mage::getSingleton('adminhtml/session')->addError(Mage::helper('pdfupload')->__('Example does not exist'));
                $this->_redirect('*/*/');
            }
        }
        Mage::register('example_data', $model);
 
        $this->loadLayout();
        $this->getLayout()->getBlock('head')->setCanLoadExtJs(true);
        $this->renderLayout();
    }
 
    public function saveAction()
    {   //var_dump($this->getRequest()->getPost());exit;
        $uploader = new Varien_File_Uploader('pdfname');
        $uploader->setAllowedExtensions(array('pdf'));
        $uploader->setAllowRenameFiles(true);
        $uploader->setFilesDispersion(false);
        $path = Mage::getBaseDir('media') . DS . 'pdf' . DS ;
        if(!is_dir($path)){
            mkdir($path, 0777, true);
        }
        $uploader->save($path, $_FILES['pdfname']['name'] );             
        $newFilename = $uploader->getUploadedFileName();
        /*var_dump($newFilename);exit;
        var_dump($_FILES['pdfname']['name']);exit;
        var_dump($this->getRequest()->getPost());exit;
        $path = Mage::getBaseDir('media') . DS . 'pdf' . DS ;
        var_dump($path);exit;*/

        if ($data = $this->getRequest()->getPost())
        {
            $model = Mage::getModel('pdfupload/example');
            $id = $this->getRequest()->getParam('id');
            /*$id = $this->getRequest()->getParam('id');
            $data["filename"] = $newFilename;
            $model->setId($this->getRequest()->getParam('id'))
                    ->setTitle($data['title'])
                    ->setFilename($data['filename'])
                    ->save();
            var_dump($data);exit;*/
            if ($id) {
                $model->load($id);
            }
            $model->setData($data);
            
            Mage::getSingleton('adminhtml/session')->setFormData($data);
            try {
                if ($id) {
                    $model->setId($id);
                }
                $model->save();
                
            //echo "<pre>";print_r($model->save());echo "</pre>";exit;
                if (!$model->getId()) {
                    Mage::throwException(Mage::helper('pdfupload')->__('Error saving example'));
                }
 
                Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('pdfupload')->__('Example was successfully saved.'));
                Mage::getSingleton('adminhtml/session')->setFormData(false);
 
                // The following line decides if it is a "save" or "save and continue"
                if ($this->getRequest()->getParam('back')) {
                    $this->_redirect('*/*/edit', array('id' => $model->getId()));
                } else {
                    $this->_redirect('*/*/');
                }
 
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                if ($model && $model->getId()) {
                    $this->_redirect('*/*/edit', array('id' => $model->getId()));
                } else {
                    $this->_redirect('*/*/');
                }
            }
 
            return;
        }
        Mage::getSingleton('adminhtml/session')->addError(Mage::helper('pdfupload')->__('No data found to save'));
        $this->_redirect('*/*/');
    }
 
    public function deleteAction()
    {
        if ($id = $this->getRequest()->getParam('id')) {
            try {
                $model = Mage::getModel('awesome/example');
                $model->setId($id);
                $model->delete();
                Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('pdfupload')->__('The example has been deleted.'));
                $this->_redirect('*/*/');
                return;
            }
            catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
                return;
            }
        }
        Mage::getSingleton('adminhtml/session')->addError(Mage::helper('adminhtml')->__('Unable to find the example to delete.'));
        $this->_redirect('*/*/');
    }
 
}
<?php
class Webonise_PdfUpload_Adminhtml_PdfuploadbackendController extends Mage_Adminhtml_Controller_Action
{
	public function indexAction()
    {
       $this->loadLayout();
	   $this->_title($this->__("PDF management"));
	   $this->renderLayout();
    }
}
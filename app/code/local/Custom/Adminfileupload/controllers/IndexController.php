<?php
class Custom_Adminfileupload_IndexController extends Mage_Adminhtml_Controller_Action
{  
    public function indexAction()
    {
        $this->loadLayout();
         
        $block = $this->getLayout()->createBlock('core/text', 'green-block')->setText('<h1>File Upload Form For Fronend</h1>');
        $this->_addContent($block);
         
        $this->_setActiveMenu('admin_menu')->renderLayout();      
        //echo $this->__('Our News module is ready');
    }   
}
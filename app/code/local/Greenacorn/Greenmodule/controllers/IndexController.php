<?php
class Greenacorn_Greenmodule_IndexController extends Mage_Adminhtml_Controller_Action
{  
    public function indexAction()
    {
        $this->loadLayout();
         
        $block = $this->getLayout()->createBlock('core/text', 'green-block')->setText('<h1>Green Acorn Web Design</h1>');
        $this->_addContent($block);
         
        $this->_setActiveMenu('green_menu')->renderLayout();      
    }   
}
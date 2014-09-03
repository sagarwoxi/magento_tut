<?php
class Webonise_PdfUpload_IndexController extends Mage_Core_Controller_Front_Action{
    public function IndexAction() {
      
	  $this->loadLayout();   
	  $this->getLayout()->getBlock("head")->setTitle($this->__("Pdf displayt"));
	        $breadcrumbs = $this->getLayout()->getBlock("breadcrumbs");
      $breadcrumbs->addCrumb("home", array(
                "label" => $this->__("Home Page"),
                "title" => $this->__("Home Page"),
                "link"  => Mage::getBaseUrl()
		   ));

      $breadcrumbs->addCrumb("pdf displayt", array(
                "label" => $this->__("Pdf displayt"),
                "title" => $this->__("Pdf displayt")
		   ));

      $this->renderLayout(); 
	  
    }
}
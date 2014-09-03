<?php
 
class Webonise_Pdfupload_Block_Adminhtml_Example extends Mage_Adminhtml_Block_Widget_Grid_Container
{
    protected $_addButtonLabel = 'Upload New File';
 
    public function __construct()
    {
        parent::__construct();
        $this->_controller = 'adminhtml_example';
        $this->_blockGroup = 'pdfupload';
        $this->_headerText = Mage::helper('pdfupload')->__('File Upload');
    }

    protected function _prepareLayout()
	{
	   $this->setChild( 'grid',
	       $this->getLayout()->createBlock( $this->_blockGroup.'/' . $this->_controller . '_grid',
	       $this->_controller . '.grid')->setSaveParametersInSession(true) );
	   return parent::_prepareLayout();
	}
}
<?php
 
class Webonise_Pdfupload_Block_Adminhtml_Example_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
    public function __construct()
    {
        parent::__construct();
        $this->setId('example_grid');
        $this->setDefaultSort('id');
        $this->setDefaultDir('desc');
        $this->setSaveParametersInSession(true);
    }
 
    protected function _prepareCollection()
    {
        $collection = Mage::getModel('pdfupload/example')->getCollection();
        $this->setCollection($collection);
        return parent::_prepareCollection();
    }
 
    protected function _prepareColumns()
    {
        $this->addColumn('id', array(
            'header'    => Mage::helper('pdfupload')->__('ID'),
            'align'     =>'right',
            'width'     => '50px',
            'index'     => 'id',
        ));
 
        $this->addColumn('title', array(
            'header'    => Mage::helper('pdfupload')->__('Title'),
            'align'     =>'left',
            'index'     => 'title',
        ));
 
        $this->addColumn('filename', array(
            'header'    => Mage::helper('pdfupload')->__('Filename'),
            'align'     =>'left',
            'index'     => 'filename',
        ));
 
        /*$this->addColumn('other', array(
            'header'    => Mage::helper('awesome')->__('Other'),
            'align'     => 'left',
            'index'     => 'other',
        ));*/
 
        return parent::_prepareColumns();
    }
 
    public function getRowUrl($row)
    {
        return $this->getUrl('*/*/edit', array('id' => $row->getId()));
    }
}
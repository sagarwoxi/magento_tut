<?php

/**
 * Students grid class
 */
class Certification_Student_Block_Adminhtml_Student_Grid
    extends Mage_Adminhtml_Block_Widget_Grid
{

    /**
     * Set some default on the grid
     */
    public function __construct()
    {
        parent::__construct();
        $this->setId('student_grid');

        //The 'id' matches the columnId
        $this->setDefaultSort('id');
        $this->setDefaultDir('asc');
        $this->setSaveParametersInSession(true);
    }

    /**
     * Set the desired collection on our grid
     * @return Mage_Adminhtml_Block_Widget_Grid
     */
    protected function _prepareCollection()
    {
        $collection = Mage::getModel('student/student')->getCollection();
        $this->setCollection($collection);
        return parent::_prepareCollection();
    }

    /**
     *
     * @return Mage_Adminhtml_Block_Widget_Grid
     */
    protected function _prepareColumns()
    {
        $this->addColumn('id', array(
            'header' => Mage::helper('adminhtml')->__('ID'),
            'align' => 'right',
            'width' => '50px',
            //must match the column
            'index' => 'student_id',
        ));

        $this->addColumn('firstname', array(
            'header' => Mage::helper('adminhtml')->__('Name'),
            'align' => 'left',
            //must match the column
            'index' => 'firstname',
        ));
        $this->addColumn('lastname', array(
            'header' => Mage::helper('adminhtml')->__('Lastname'),
            'align' => 'left',
            //must match the column
            'index' => 'lastname',
        ));
        $this->addColumn('gender', array(
            'header' => Mage::helper('adminhtml')->__('Gender'),
            'align' => 'left',
            'type' => 'options',
            'options' => array(1 => 'Male', 2 => 'Female'),
            //must match the column
            'index' => 'gender',
        ));
        $this->addColumn('created_at', array(
            'header' => Mage::helper('adminhtml')->__('Created at'),
            'align' => 'left',
            //must match the column
            'type' => 'datetime',
            'index' => 'created_at',
        ));

        return parent::_prepareColumns();
    }

    /**
     * Get row url
     * @param Varien_Object $row
     * @return string
     */
    public function getRowUrl($row)
    {
        return $this->getUrl('*/*/edit', array('id' => $row->getId()));
    }

}
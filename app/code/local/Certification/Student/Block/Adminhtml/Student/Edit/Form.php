<?php

/**
 * Student form class
 */
class Certification_Student_Block_Adminhtml_Student_Edit_Form
    extends Mage_Adminhtml_Block_Widget_Form
{

    /**
     * Prepare student form
     * @return Mage_Adminhtml_Block_Widget_Form
     */
    protected function _prepareForm()
    {
        if (Mage::getSingleton('adminhtml/session')->getStudentData()) {
            $data = Mage::getSingleton('adminhtml/session')->getStudentData();
        } elseif (Mage::registry('student_data')) {
            $data = Mage::registry('student_data')->getData();
        } else {
            $data = array();
        }

        $form = new Varien_Data_Form(array(
            'id' => 'edit_form',
            'action' => $this->getUrl('*/*/save', array('id' => $this->getRequest()->getParam('id'))),
            'method' => 'post',
            'enctype' => 'multipart/form-data',
        ));

        $form->setUseContainer(true);

        $this->setForm($form);

        $fieldset = $form->addFieldset('student_form', array(
            'legend' => Mage::helper('student')->__('Student Information')
        ));

        $fieldset->addField('firstname', 'text', array(
            'label' => Mage::helper('student')->__('Firstname'),
            'class' => 'required-entry',
            'required' => true,
            //must map the column
            'name' => 'firstname',
            'note' => Mage::helper('student')->__('Firstname'),
        ));

        $fieldset->addField('lastname', 'text', array(
            'label' => Mage::helper('student')->__('Lastname'),
            'class' => 'required-entry',
            'required' => true,
            'name' => 'lastname',
        ));

        $fieldset->addField('gender', 'select', array(
            'label' => Mage::helper('student')->__('Gender'),
            'class' => 'required-entry',
            'required' => true,
            'name' => 'gender',
            'values' => array(1 => 'Male', 2 => 'Female')
        ));

        $form->setValues($data);

        return parent::_prepareForm();
    }
}
<?php
 
class Webonise_Pdfupload_Block_Adminhtml_Example_Edit_Form extends Mage_Adminhtml_Block_Widget_Form
{
    protected function _prepareForm()
    {
        if (Mage::getSingleton('adminhtml/session')->getExampleData())
        {
            $data = Mage::getSingleton('adminhtml/session')->getExamplelData();
            Mage::getSingleton('adminhtml/session')->getExampleData(null);
        }
        elseif (Mage::registry('example_data'))
        {
            $data = Mage::registry('example_data')->getData();
        }
        else
        {
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
 
        $fieldset = $form->addFieldset('example_form', array(
             'legend' =>Mage::helper('pdfupload')->__('Example Information')
        ));
 
        $fieldset->addField('title', 'text', array(
             'label'     => Mage::helper('pdfupload')->__('Name'),
             'class'     => 'required-entry',
             'required'  => true,
             'name'      => 'title',
             'note'     => Mage::helper('pdfupload')->__('Title'),
        ));
 
        $fieldset->addField('pdfname', 'file', array(
             'label'     => Mage::helper('pdfupload')->__('File Name'),
             'class'     => 'required-entry',
             'required'  => true,
             'name'      => 'pdfname',
        ));
 
        /*$fieldset->addField('other', 'text', array(
             'label'     => Mage::helper('awesome')->__('Other'),
             'class'     => 'required-entry',
             'required'  => true,
             'name'      => 'other',
        ));*/
 
        $form->setValues($data);
 
        return parent::_prepareForm();
    }
}
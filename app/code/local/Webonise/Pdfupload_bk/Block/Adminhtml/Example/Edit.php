<?php
 
class Webonise_Pdfupload_Block_Adminhtml_Example_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
    public function __construct()
    {
        parent::__construct();
 
        $this->_objectId = 'id';
        $this->_blockGroup = 'pdfupload';
        $this->_controller = 'adminhtml_example';
        $this->_mode = 'edit';
 
        /*$this->_addButton('save_and_continue', array(
                  'label' => Mage::helper('adminhtml')->__('Save And Continue Edit'),
                  'onclick' => 'saveAndContinueEdit()',
                  'class' => 'save',
        ), -100);*/
        $this->_updateButton('save', 'label', Mage::helper('pdfupload')->__('Upload'));
 
        $this->_formScripts[] = "
            function toggleEditor() {
                if (tinyMCE.getInstanceById('form_content') == null) {
                    tinyMCE.execCommand('mceAddControl', false, 'edit_form');
                } else {
                    tinyMCE.execCommand('mceRemoveControl', false, 'edit_form');
                }
            }
 
            function saveAndContinueEdit(){
                editForm.submit($('edit_form').action+'back/edit/');
            }
        ";
    }
 
    public function getHeaderText()
    {
        if (Mage::registry('example_data') && Mage::registry('example_data')->getId())
        {
            return Mage::helper('pdfupload')->__('Edit Example "%s"', $this->htmlEscape(Mage::registry('example_data')->getName()));
        } else {
            return Mage::helper('pdfupload')->__('New File Upload');
        }
    }

    protected function _prepareLayout()
    {
        if ($this->_blockGroup && $this->_controller && $this->_mode) {
            $this->setChild('form', $this->getLayout()->createBlock($this->_blockGroup . '/' . $this->_controller . '_' . $this->_mode . '_form'));
        }
        return parent::_prepareLayout();
    }
 
}
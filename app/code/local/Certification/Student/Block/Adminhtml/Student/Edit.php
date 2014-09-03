<?php
/**
 * Student form container class
 */
class Certification_Student_Block_Adminhtml_Student_Edit
    extends Mage_Adminhtml_Block_Widget_Form_Container
{
    protected $_blockGroup = 'student';
    protected $_controller = 'adminhtml_student';
    protected $_mode = 'edit';

    /**
     * Get student form header text
     * @return string
     */
    public function getHeaderText()
    {
        if (Mage::registry('student_data') && Mage::registry('student_data')->getId()) {
            return Mage::helper('student')->__('Edit Student "%s"', $this->htmlEscape(Mage::registry('student_data')->getFirstname()));
        } else {
            return Mage::helper('student')->__('New Student');
        }
    }
}
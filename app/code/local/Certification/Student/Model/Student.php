<?php
/**
 * Student model class
 */
class Certification_Student_Model_Student
    extends Mage_Core_Model_Abstract
{
    /**
     * This syntax is used in Mage::getModel()
     */
    protected function _construct()
    {
        $this->_init('student/student');
    }
}

<?php
/**
 * Student collection class
 */
class Certification_Student_Model_Resource_Student_Collection
    extends Mage_Core_Model_Resource_Db_Collection_Abstract
{
    protected function _construct()
    {
        $this->_init('student/student');
    }
}
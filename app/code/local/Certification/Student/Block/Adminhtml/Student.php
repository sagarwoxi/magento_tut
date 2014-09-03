<?php

/**
 * Student grid container
 */
class Certification_Student_Block_Adminhtml_Student
    extends Mage_Adminhtml_Block_Widget_Grid_Container
{
    protected $_addButtonLabel = 'Add new student';
    protected $_headerText = 'Students';

    protected $_controller = 'adminhtml_student';
    protected $_blockGroup = 'student';
}
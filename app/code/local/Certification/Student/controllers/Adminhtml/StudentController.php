<?php

/**
 * Adminhtml student controller
 */
class Certification_Student_Adminhtml_StudentController
    extends Mage_Adminhtml_Controller_Action
{

    public function indexAction()
    {
        $this->_forward('list');
    }

    /**
     * List action for students grid
     */
    public function listAction()
    {
        $this->loadLayout();
        $this->renderLayout();
    }

    /**
     * Add new action
     */
    public function newAction()
    {
        $this->_forward('edit');
    }

    /**
     * Edit student action
     */
    public function editAction()
    {
        $studentId = (int) $this->getRequest()->getParam('id');

        $student = Mage::getModel('student/student');
        if ($studentId) {
            $student->load($studentId);
            if ($student->getId()) {
                $data = Mage::getSingleton('adminhtml/session')->getFormData(true);
                if ($data) {
                    $student->setData($data)->setId($studentId);
                }
            } else {
                Mage::getSingleton('adminhtml/session')
                    ->addError(Mage::helper('student')
                        ->__('Student doesn\'nt exists.'));
                $this->_redirect('*/*/');
            }
        }
        Mage::register('student_data', $student);

        $this->loadLayout();
        // $this->getLayout()->getBlock('head')->setCanLoadExtJs(true);
        $this->renderLayout();
    }

    /**
     * Save student action
     */
    public function saveAction()
    {
        if ($data = $this->getRequest()->getPost()) {
            $student = Mage::getModel('student/student');
            $id = $this->getRequest()->getParam('id');
            if ($id) {
                $student->load($id);
            }
            $student->setData($data);
            $student->setCreatedAt(date('Y-m-d H:i:s'));

            Mage::getSingleton('adminhtml/session')->setFormData($data);
            try {
                if ($id) {
                    $student->setId($id);
                }
                $student->save();

                if (!$student->getId()) {
                    Mage::throwException(Mage::helper('student')->__('Error saving student'));
                }

                Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('student')->__('Student was successfully saved.'));
                Mage::getSingleton('adminhtml/session')->setFormData(false);
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());

                $this->_redirect('*/*/');
            }

        }
        $this->_redirect('*/*/');
    }
}
<?php

declare(strict_types=1);

namespace App;

class StudentController
{
    private $_studentModel;
    private $_studentView;

    public function __construct(Student $model, StudentView $view)
    {
        $this->_studentModel = $model;
        $this->_studentView = $view;
    }

    public function setStudentName(string $name): void
    {
        $this->_studentModel->setName($name);
    }

    public function getStudentName(): string
    {
        return $this->_studentModel->getName();
    }

    public function setStudentRollNo(string $rollNo): void
    {
        $this->_studentModel->setRollNo($rollNo);
    }

    public function getStudentRollNo(): string
    {
        return $this->_studentModel->getRollNo();
    }

    public function updateView(): void
    {
        $this->_studentView->printStudentDetails($this->_studentModel->getName(), $this->_studentModel->getRollNo());
    }
}

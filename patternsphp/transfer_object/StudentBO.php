<?php

declare(strict_types=1);

require_once __DIR__ . '/ArrayList.php';
require_once __DIR__ . '/StudentVO.php';

class StudentBO
{
    //list is working as a database
    private $students;

    public function __construct()
    {
        $this->students = new ArrayList();
        $student1 = new StudentVO("Robert", 0);
        $student2 = new StudentVO("Jhon", 1);
        $this->students->Add($student1);
        $this->students->Add($student2);
    }

    public function deleteStudent(StudentVO $student): void
    {
        $this->students->remove($student->getRollNo());
        print sprintf("Student: Roll No %s , deleted from database" . PHP_EOL, $student->getRollNo());
    }

    //retrive list of students from the database
    public function getAllStudents(): ArrayList
    {
        return $this->students;
    }

    public function getStudent(int $RollNo): ?StudentVO
    {
        return $this->students->GetObj($RollNo);
    }

    public function updateStudent(StudentVO $student): void
    {
        $this->students->GetObj($student->getRollNo());
        print sprintf("Student: Roll No %s , updated in the database" . PHP_EOL, $student->getRollNo());
    }
}

<?php

declare(strict_types=1);

require_once __DIR__ . '/ArrayList.php';

class StudentDaoImpl implements StudentDao
{
    //list is working as a database
    private $students;

    public function __construct()
    {
        $this->students = new ArrayList();
        $student1 = new Student("Robert", 0);
        $student2 = new Student("Jhon", 1);
        $this->students->Add($student1);
        $this->students->Add($student2);
    }

    public function deleteStudent(Student $student): void
    {
        $this->students->remove($student->getRollNo());
        print sprintf("Student: Roll No %s , deleted from database", $student->getRollNo() . PHP_EOL);
    }

    //retrive list of students from the database
    public function getAllStudents()
    {
        return $this->students;
    }

    public function getStudent(int $RollNo): Student
    {
        return $this->students->GetObj($RollNo);
    }

    public function updateStudent(Student $student): void
    {
        $this->students->GetObj($student->getRollNo());
        print sprintf("Student: Roll No %s , updated from database", $student->getRollNo() . PHP_EOL);
    }
}

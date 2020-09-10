<?php

require_once __DIR__ . '/StudentBO.php';

$studentBusinessObject = new StudentBO();

//print all students
$students = $studentBusinessObject->getAllStudents();
foreach ($students->list as $student) {
    print sprintf("Student: [RollNo: %s , Name: %s]" . PHP_EOL, $student->getRollNo(), $student->getName());
}

//update student
$student = $studentBusinessObject->getStudent(0);
$student->setName("Michael");
$studentBusinessObject->updateStudent($student);

//get the student
$student = $studentBusinessObject->getStudent(0);
print sprintf("Student: [RollNo: %s , Name: %s]" . PHP_EOL, $student->getRollNo(), $student->getName());

<?php
require_once __DIR__ . '/Student.php';
require_once __DIR__ . '/StudentDao.php';
require_once __DIR__ . '/StudentDaoImpl.php';

$studentDao = new StudentDaoImpl();
$students = $studentDao->getAllStudents();

//print all students
foreach ($student as $students) {
    print sprintf("Student: [RollNo: %s , Name: %s", $student->getRollNo(), $student->getName());
}

//update student
$student = $studentDao->getAllStudents()->GetKey(0);
$student->setName("Michael");
$studentDao->updateStudent($student);

//get the student
$studentDao->getStudent(0);
print sprintf("Student: [RollNo: %s , Name: %s", $student->getRollNo(), $student->getName());

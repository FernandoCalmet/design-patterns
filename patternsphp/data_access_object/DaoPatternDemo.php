<?php
require_once __DIR__ . '/Student.php';
require_once __DIR__ . '/StudentDao.php';
require_once __DIR__ . '/StudentDaoImpl.php';

$studentDao = new StudentDaoImpl();

//print all students
$students = $studentDao->getAllStudents();
foreach ($students->list as $student) {
    print sprintf("Student: [RollNo: %s , Name: %s]" . PHP_EOL, $student->getRollNo(), $student->getName());
}

//update student
$student = $studentDao->getStudent(0);
$student->setName("Michael");
$studentDao->updateStudent($student);

//get the student
$student = $studentDao->getStudent(0);
print sprintf("Student: [RollNo: %s , Name: %s]" . PHP_EOL, $student->getRollNo(), $student->getName());

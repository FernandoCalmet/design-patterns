<?php
require_once __DIR__ . '/Student.php';
require_once __DIR__ . '/StudentDao.php';
require_once __DIR__ . '/StudentDaoImpl.php';

$student = new Student();
$studentDao = new StudentDaoImpl();
$students = $studentDao->getAllStudents();

//print all students
foreach ($student as $students) {
    print sprintf("Student: [RollNo: %s , Name: %s]", $student->getRollNo(), $student->getName() . PHP_EOL);
}

//update student
$student = $studentDao->getAllStudents()->GetObj(0);
$student->setName("Michael");
$studentDao->updateStudent($student);

//get the student
$studentDao->getStudent(0);
print(PHP_EOL);
print sprintf("Student: [RollNo: %s , Name: %s]", $student->getRollNo(), $student->getName());

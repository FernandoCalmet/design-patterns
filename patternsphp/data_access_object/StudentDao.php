<?php

declare(strict_types=1);

require_once __DIR__ . '/ArrayList.php';

interface StudentDao
{
    public function getAllStudents();
    public function getStudent(int $rollNo): Student;
    public function updateStudent(Student $student): void;
    public function deleteStudent(Student $student): void;
}

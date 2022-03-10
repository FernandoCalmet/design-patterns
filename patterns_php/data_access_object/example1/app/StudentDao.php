<?php

declare(strict_types=1);

namespace App;

interface StudentDao
{
    public function getAllStudents(): ArrayList;
    public function getStudent(int $rollNo): ?Student;
    public function updateStudent(Student $student): void;
    public function deleteStudent(Student $student): void;
}

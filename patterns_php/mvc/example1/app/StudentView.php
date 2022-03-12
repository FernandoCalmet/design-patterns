<?php

declare(strict_types=1);

namespace App;

class StudentView
{
    public function printStudentDetails(string $studentName, string $studentRollNo): void
    {
        print("Student: " . PHP_EOL);
        print sprintf("Name: %s", $studentName . PHP_EOL);
        print sprintf("Roll No: %s", $studentRollNo . PHP_EOL);
    }
}

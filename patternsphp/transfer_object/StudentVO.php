<?php

declare(strict_types=1);

class StudentVO
{
    private $_name;
    private $_rollNo;

    public function __construct(string $name, int $rollNo)
    {
        $this->_name = $name;
        $this->_rollNo = $rollNo;
    }

    public function getName(): string
    {
        return $this->_name;
    }

    public function setName(string $name): void
    {
        $this->_name = $name;
    }

    public function getRollNo(): int
    {
        return $this->_rollNo;
    }

    public function setRollNo(int $rollNo): void
    {
        $this->_rollNo = $rollNo;
    }
}

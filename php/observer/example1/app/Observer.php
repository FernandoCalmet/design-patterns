<?php

declare(strict_types=1);

namespace App;

abstract class Observer
{
    protected $_subject;

    public function __construct()
    {
        $this->_subject = new Subject();
    }

    public function getSubject(): Subject
    {
        return $this->_subject;
    }

    public function setSubject(Subject $subject): void
    {
        $this->_subject = $subject;
    }

    public abstract function update(): void;
}

<?php

declare(strict_types=1);

include_once __DIR__ . '/Observer.php';
include_once __DIR__ . '/Subject.php';

class BinaryObserver extends Observer
{
    public function __construct(Subject $subject)
    {
        $this->setSubject($subject);
        $this->getSubject()->attach($this);
    }

    public function update(): void
    {
        $result = decbin($this->getSubject()->getState());
        print sprintf("Binary String: %s" . PHP_EOL, $result);
    }
}

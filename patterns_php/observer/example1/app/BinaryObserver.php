<?php

declare(strict_types=1);

namespace App;

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

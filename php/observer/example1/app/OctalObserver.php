<?php

declare(strict_types=1);

namespace App;

class OctalObserver extends Observer
{
    public function __construct(Subject $subject)
    {
        $this->setSubject($subject);
        $this->getSubject()->attach($this);
    }

    public function update(): void
    {
        $result = decoct($this->getSubject()->getState());
        print sprintf("Octal String: %s" . PHP_EOL, $result);
    }
}

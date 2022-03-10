<?php

declare(strict_types=1);

namespace App;

class HexaObserver extends Observer
{
    public function __construct(Subject $subject)
    {
        $this->setSubject($subject);
        $this->getSubject()->attach($this);
    }

    public function update(): void
    {
        $result = dechex($this->getSubject()->getState());
        print sprintf("Hex String: %s" . PHP_EOL, $result);
    }
}

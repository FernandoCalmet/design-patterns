<?php

declare(strict_types=1);

namespace App;

class Subject
{
    private $_observers = array();
    private $_state;

    public function getState(): int
    {
        return $this->_state;
    }

    public function setState(int $state): void
    {
        $this->_state = $state;
        $this->notifyAllObservers();
    }

    public function attach(Observer $observer): void
    {
        array_push($this->_observers, $observer);
    }

    public function notifyAllObservers(): void
    {
        foreach ($this->_observers as $observer) {
            $observer->update();
        }
    }
}

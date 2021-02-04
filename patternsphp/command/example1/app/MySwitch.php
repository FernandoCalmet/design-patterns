<?php

namespace App;

class MySwitch
{
    protected Command $onCommand;
    protected Command $offCommand;

    public function __construct(Command $onCommand, Command $offCommand)
    {
        $this->onCommand = $onCommand;
        $this->offCommand = $offCommand;
    }

    public function on()
    {
        $this->onCommand->execute();
    }

    public function off()
    {
        $this->offCommand->execute();
    }
}

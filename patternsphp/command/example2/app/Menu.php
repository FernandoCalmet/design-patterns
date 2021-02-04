<?php

namespace App;

class Menu
{
    protected Command $openCommand;
    protected Command $closeCommand;
    protected Command $saveCommand;

    public function __construct(Command $openCommand, $closeCommand, $saveCommand)
    {
        $this->openCommand = $openCommand;
        $this->closeCommand = $closeCommand;
        $this->saveCommand = $saveCommand;
    }

    public function open()
    {
        $this->openCommand->execute();
    }

    public function close()
    {
        $this->closeCommand->execute();
    }

    public function save()
    {
        $this->saveCommand->execute();
    }
}

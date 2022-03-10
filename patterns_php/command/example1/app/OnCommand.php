<?php

namespace App;

class OnCommand implements Command
{
    protected Lamp $lamp;

    public function __construct(Lamp $lamp)
    {
        $this->lamp = $lamp;
    }

    public function execute()
    {
        $this->lamp->on();
    }
}

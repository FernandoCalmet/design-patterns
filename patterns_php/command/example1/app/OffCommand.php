<?php

namespace App;

class OffCommand implements Command
{
    protected Lamp $lamp;

    public function __construct(Lamp $lamp)
    {
        $this->lamp = $lamp;
    }

    public function execute()
    {
        $this->lamp->off();
    }
}

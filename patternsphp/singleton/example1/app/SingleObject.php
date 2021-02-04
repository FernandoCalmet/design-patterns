<?php

declare(strict_types=1);

namespace App;

class SingleObject
{
    private function __construct()
    {
        //do nothing
    }

    //Get the only object available
    public static function getInstance()
    {
        $instance = null;

        if ($instance === null) {
            $instance = new static();
        }

        return $instance;
    }

    public function showMessage(): void
    {
        print sprintf("Hello World!" . PHP_EOL);
    }
}

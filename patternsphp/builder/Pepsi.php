<?php

declare(strict_types=1);

include_once __DIR__ . '/ColdDrink.php';

class Pepsi extends ColdDrink
{
    public function price(): float
    {
        return 35.0;
    }

    public function name(): string
    {
        return "Pepsi";
    }
}

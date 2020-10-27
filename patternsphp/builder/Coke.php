<?php

declare(strict_types=1);

include_once __DIR__ . '/ColdDrink.php';

class Coke extends ColdDrink
{
    public function price(): float
    {
        return 30.0;
    }

    public function name(): string
    {
        return "Coke";
    }
}

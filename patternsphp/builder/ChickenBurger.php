<?php

declare(strict_types=1);

include_once __DIR__ . '/Burger.php';

class ChickenBurger extends Burger
{
    public function price(): float
    {
        return 50.0;
    }

    public function name(): string
    {
        return "Chicken Burger";
    }
}

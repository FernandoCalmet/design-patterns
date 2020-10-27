<?php

declare(strict_types=1);

include_once __DIR__ . '/Burger.php';

class VegBurger extends Burger
{
    public function price(): float
    {
        return 25.0;
    }

    public function name(): string
    {
        return "Veg Burger";
    }
}

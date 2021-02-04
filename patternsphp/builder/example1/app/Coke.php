<?php

declare(strict_types=1);

namespace App;

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

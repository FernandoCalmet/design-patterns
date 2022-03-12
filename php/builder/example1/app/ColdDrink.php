<?php

declare(strict_types=1);

namespace App;

abstract class ColdDrink implements Item
{
    public function packing(): Packing
    {
        return new Bottle();
    }

    public abstract function price(): float;
}

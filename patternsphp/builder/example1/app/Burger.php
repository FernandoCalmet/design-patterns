<?php

declare(strict_types=1);

namespace App;

abstract class Burger implements Item
{
    public function packing(): Packing
    {
        return new Wrapper();
    }

    public abstract function price(): float;
}

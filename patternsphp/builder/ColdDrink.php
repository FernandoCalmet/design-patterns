<?php

declare(strict_types=1);

include_once __DIR__ . '/Item.php';
include_once __DIR__ . '/Packing.php';
include_once __DIR__ . '/Bottle.php';

abstract class ColdDrink implements Item
{
    public function packing(): Packing
    {
        return new Bottle();
    }

    public abstract function price(): float;
}

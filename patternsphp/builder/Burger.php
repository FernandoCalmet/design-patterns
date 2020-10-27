<?php

declare(strict_types=1);

include_once __DIR__ . '/Item.php';
include_once __DIR__ . '/Packing.php';
include_once __DIR__ . '/Wrapper.php';

abstract class Burger implements Item
{
    public function packing(): Packing
    {
        return new Wrapper();
    }

    public abstract function price(): float;
}

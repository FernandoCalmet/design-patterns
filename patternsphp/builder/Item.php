<?php

declare(strict_types=1);

include_once __DIR__ . '/Packing.php';

interface Item
{
    public function name(): string;
    public function packing(): Packing;
    public function price(): float;
}

<?php

declare(strict_types=1);

namespace App;

interface Item
{
    public function name(): string;
    public function packing(): Packing;
    public function price(): float;
}

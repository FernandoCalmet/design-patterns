<?php

declare(strict_types=1);

namespace App;

class Circle implements Shape
{
    public function draw(): void
    {
        print sprintf("Shape: Circle" . PHP_EOL);
    }
}

<?php

declare(strict_types=1);

namespace App;

class Rectangle implements Shape
{
    public function draw(): void
    {
        print sprintf("Inside Rectangle::draw() method." . PHP_EOL);
    }
}

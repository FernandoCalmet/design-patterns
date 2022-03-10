<?php

declare(strict_types=1);

namespace App;

class Square implements Shape
{
    public function draw(): void
    {
        print sprintf("Inside Square::draw() method." . PHP_EOL);
    }
}

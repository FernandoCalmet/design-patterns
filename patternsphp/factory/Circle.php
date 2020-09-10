<?php

declare(strict_types=1);

require_once __DIR__ . '/Shape.php';

class Circle implements Shape
{
    public function draw(): void
    {
        print sprintf("Inside Circle::draw() method." . PHP_EOL);
    }
}

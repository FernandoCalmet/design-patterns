<?php

declare(strict_types=1);

require_once __DIR__ . '/Shape.php';

class Square implements Shape
{
    public function draw(): void
    {
        print sprintf("Inside Square::draw() method." . PHP_EOL);
    }
}

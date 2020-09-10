<?php

declare(strict_types=1);

require_once __DIR__ . '/Shape.php';

class Rectangle implements Shape
{
    public function draw(): void
    {
        print sprintf("Shape: Rectangle" . PHP_EOL);
    }
}

<?php

declare(strict_types=1);

include_once __DIR__ . '/Shape.php';

abstract class ShapeDecorator implements Shape
{
    protected $decoratedShape;

    public function __construct(Shape $decoratedShape)
    {
        $this->decoratedShape = $decoratedShape;
    }

    public function draw(): void
    {
        $this->decoratedShape->draw();
    }
}

<?php

declare(strict_types=1);

namespace App;

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

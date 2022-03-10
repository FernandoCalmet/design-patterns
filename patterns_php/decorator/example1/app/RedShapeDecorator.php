<?php

declare(strict_types=1);

namespace App;

class RedShapeDecorator extends ShapeDecorator
{
    public function __construct(Shape $decoratedShape)
    {
        parent::__construct($decoratedShape);
    }

    public function draw(): void
    {
        $this->decoratedShape->draw();
        $this->setRedBorder($this->decoratedShape);
    }

    private function setRedBorder(Shape $decoratedShape): void
    {
        print sprintf("Border Color: Red" . PHP_EOL);
    }
}

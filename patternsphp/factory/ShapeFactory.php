<?php

declare(strict_types=1);

include_once __DIR__ . '/Circle.php';
include_once __DIR__ . '/Rectangle.php';
include_once __DIR__ . '/Square.php';

class ShapeFactory
{
    //use getShape method to get object of type shape
    public function getShape(string $shapeType): Shape
    {
        if ($shapeType == null) {
            return null;
        }
        if (strcasecmp($shapeType, "CIRCLE")) {
            return new Circle();
        } else if (strcasecmp($shapeType, "RECTANGLE")) {
            return new Rectangle();
        } else if (strcasecmp($shapeType, "SQUARE")) {
            return new Square();
        }

        return null;
    }
}

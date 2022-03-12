<?php

declare(strict_types=1);

namespace App;

class ShapeFactory
{
    //use getShape method to get object of type shape
    public function getShape(string $shapeType): Shape
    {
        if ($shapeType == null) {
            return null;
        }
        if (strcasecmp($shapeType, "CIRCLE") == 0) {
            return new Circle();
        } else if (strcasecmp($shapeType, "RECTANGLE") == 0) {
            return new Rectangle();
        } else if (strcasecmp($shapeType, "SQUARE") == 0) {
            return new Square();
        }

        return null;
    }
}

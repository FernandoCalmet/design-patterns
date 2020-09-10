<?php

include_once __DIR__ . '/ShapeFactory.php';

$shapeFactory = new ShapeFactory();

//get an object of Circle and call its draw method.
$shape1 = $shapeFactory->getShape("CIRCLE");

//call draw method of Circle
$shape1->draw();

//get an object of Rectangle and call its draw method.
$shape2 = $shapeFactory->getShape("RECTANGLE");

//call draw method of Rectangle
$shape2->draw();

//get an object of Square and call its draw method.
$shape3 = $shapeFactory->getShape("SQUARE");

//call draw method of square
$shape3->draw();

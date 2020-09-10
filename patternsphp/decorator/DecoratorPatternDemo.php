<?php

include_once __DIR__ . '/Circle.php';
include_once __DIR__ . '/Rectangle.php';
include_once __DIR__ . '/RedShapeDecorator.php';

$circle = new Circle();
$redCircle = new RedShapeDecorator($circle);
$rectangle = new Rectangle();
$redRectangle = new RedShapeDecorator($rectangle);

print sprintf("Circle with normal border %s", $circle->draw() . PHP_EOL);
print sprintf("Circle of red border %s", $redCircle->draw() . PHP_EOL);
print sprintf("Rectangle with normal border %s", $rectangle->draw() . PHP_EOL);
print sprintf("Rectangle of red border %s", $redRectangle->draw() . PHP_EOL);

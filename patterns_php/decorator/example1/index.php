<?php

use App\{Circle, Rectangle, RedShapeDecorator};

require 'vendor/autoload.php';

$circle = new Circle();
$redCircle = new RedShapeDecorator($circle);
$rectangle = new Rectangle();
$redRectangle = new RedShapeDecorator($rectangle);

print sprintf("Circle with normal border %s", $circle->draw() . PHP_EOL);
print sprintf("Circle of red border %s", $redCircle->draw() . PHP_EOL);
print sprintf("Rectangle with normal border %s", $rectangle->draw() . PHP_EOL);
print sprintf("Rectangle of red border %s", $redRectangle->draw() . PHP_EOL);

<?php

require 'vendor/autoload.php';

use App\Calculator;

$calculator = new Calculator();

var_dump($calculator->execute(4, 8));

//var_dump($calculator->subtraction(10, 5));

//var_dump($calculator->addition(3, 3));

//var_dump($calculator->multiplication(2, 25));

<?php

include_once __DIR__ . '/MealBuilder.php';
include_once __DIR__ . '/Meal.php';

$mealBuilder = new MealBuilder();

$vegMeal = $mealBuilder->prepareVegMeal();
print sprintf("Veg Meal", PHP_EOL);
$vegMeal->showItems();
print sprintf("Total Cost: ", $vegMeal->getCost(), PHP_EOL);

$nonVegMeal = $mealBuilder->prepareNonVegMeal();
print sprintf("Non-Veg Meal", PHP_EOL);
$nonVegMeal->showItems();
print sprintf("Total Cost: ", $nonVegMeal->getCost(), PHP_EOL);

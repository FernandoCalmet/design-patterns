<?php

declare(strict_types=1);

include_once __DIR__ . '/Meal.php';
include_once __DIR__ . '/VegBurger.php';
include_once __DIR__ . '/ChickenBurger.php';
include_once __DIR__ . '/Coke.php';
include_once __DIR__ . '/Pepsi.php';

class MealBuilder
{
    public function prepareVegMeal(): Meal
    {
        $meal = new Meal();
        $meal->addItem(new VegBurger());
        $meal->addItem(new Coke());
        return $meal;
    }

    public function prepareNonVegMeal(): Meal
    {
        $meal = new Meal();
        $meal->addItem(new ChickenBurger());
        $meal->addItem(new Pepsi());
        return $meal;
    }
}

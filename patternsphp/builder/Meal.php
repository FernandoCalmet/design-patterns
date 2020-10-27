<?php

declare(strict_types=1);

include_once __DIR__ . '/Item.php';

class Meal
{
    private $items = array();

    public function addItem(Item $item): void
    {
        array_push($this->items, $item);
    }

    public function getCost(): float
    {
        $cost = 0.0;

        foreach ($this->items as $item) {
            $cost += $item->price();
        }

        return $cost;
    }

    public function showItems(): void
    {
        foreach ($this->items as $item) {
            print sprintf("Item: ", $item->name() . PHP_EOL);
            print sprintf(", Packing: ", $item->packing()->pack() . PHP_EOL);
            print sprintf(", Price: ", $item->price() . PHP_EOL);
            print sprintf(PHP_EOL);
        }
    }
}

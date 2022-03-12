# Builder Pattern

El patrón de constructor construye un objeto complejo usando objetos simples y usando un enfoque paso a paso. Este tipo de patrón de diseño se incluye en el patrón de creación, ya que este patrón proporciona una de las mejores formas de crear un objeto.

Una clase Builder construye el objeto final paso a paso. Este constructor es independiente de otros objetos.

## Implementación

Hemos considerado un caso comercial de restaurante de comida rápida donde una comida típica podría ser una hamburguesa y una bebida fría. La hamburguesa puede ser una hamburguesa vegetariana o una hamburguesa de pollo y se empacará con una envoltura. La bebida fría puede ser una coca cola o una pepsi y se envasa en una botella.

Vamos a crear una interfaz de artículo que represente alimentos como hamburguesas y bebidas frías y clases concretas que implementen la interfaz de artículo y una interfaz de embalaje que represente el empaque de artículos alimenticios y clases concretas que implementen la interfaz de embalaje, ya que la hamburguesa se empacaría en envoltorio y bebida fría. sería empaquetado como botella.

Luego creamos una clase Meal con ArrayList of Item y MealBuilder para construir diferentes tipos de objetos Meal combinando Item. BuilderPatternDemo, nuestra clase de demostración utilizará MealBuilder para crear una comida.

![UML Diagram](builder_pattern_uml_diagram.jpg)

## Paso 1

Cree un elemento de interfaz que represente el producto alimenticio y el embalaje.

> Item.php

```php
<?php

declare(strict_types=1);

include_once __DIR__ . '/Packing.php';

interface Item
{
    public function name(): string;
    public function packing(): Packing;
    public function price(): float;
}
```

> Packing.php

```php
<?php

declare(strict_types=1);

interface Packing
{
    public function pack(): string;
}
```

## Paso 2

Cree clases concretas implementando la interfaz Packing.

> Wrapper.php

```php
<?php

declare(strict_types=1);

include_once __DIR__ . '/Packing.php';

class Wrapper implements Packing
{
    public function pack(): string
    {
        return "Wrapper";
    }
}
```

> Bottle.php

```php
<?php

declare(strict_types=1);

include_once __DIR__ . '/Packing.php';

class Bottle implements Packing
{
    public function pack(): string
    {
        return "Bottle";
    }
}
```

## Paso 3

Cree clases abstractas implementando la interfaz del elemento que proporciona funcionalidades predeterminadas.

> Burger.php

```php
<?php

declare(strict_types=1);

include_once __DIR__ . '/Item.php';
include_once __DIR__ . '/Packing.php';
include_once __DIR__ . '/Wrapper.php';

abstract class Burger implements Item
{
    public function packing(): Packing
    {
        return new Wrapper();
    }

    public abstract function price(): float;
}
```

> ColdDrink.php

```php
<?php

declare(strict_types=1);

include_once __DIR__ . '/Item.php';
include_once __DIR__ . '/Packing.php';
include_once __DIR__ . '/Bottle.php';

abstract class ColdDrink implements Item
{
    public function packing(): Packing
    {
        return new Bottle();
    }

    public abstract function price(): float;
}
```

## Paso 4

Crear clases concretas que amplíen las clases de hamburguesas y bebidas frías

> VegBurger.php

```php
<?php

declare(strict_types=1);

include_once __DIR__ . '/Burger.php';

class VegBurger extends Burger
{
    public function price(): float
    {
        return 25.0;
    }

    public function name(): string
    {
        return "Veg Burger";
    }
}
```

> ChickenBurger.php

```php
<?php

declare(strict_types=1);

include_once __DIR__ . '/Burger.php';

class ChickenBurger extends Burger
{
    public function price(): float
    {
        return 50.0;
    }

    public function name(): string
    {
        return "Chicken Burger";
    }
}
```

> Coke.php

```php
<?php

declare(strict_types=1);

include_once __DIR__ . '/ColdDrink.php';

class Coke extends ColdDrink
{
    public function price(): float
    {
        return 30.0;
    }

    public function name(): string
    {
        return "Coke";
    }
}
```

> Pepsi.php

```php
<?php

declare(strict_types=1);

include_once __DIR__ . '/ColdDrink.php';

class Pepsi extends ColdDrink
{
    public function price(): float
    {
        return 35.0;
    }

    public function name(): string
    {
        return "Pepsi";
    }
}
```

## Paso 5

Cree una clase Meal con objetos Item definidos anteriormente.

> Meal.php

```php
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
```

## Paso 6

Cree una clase MealBuilder, la clase de constructor real responsable de crear objetos Meal.

> MealBuilder.php

```php
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
```

## Paso 7

BuiderPatternDemo usa MealBuider para demostrar el patrón del constructor.

> BuilderPatternDemo.php

```php
<?php

include_once __DIR__ . '/MealBuilder.php';
include_once __DIR__ . '/Meal.php';

$mealBuilder = new MealBuilder();

$vegMeal = $mealBuilder->prepareVegMeal();
print sprintf("Veg Meal" . PHP_EOL);
$vegMeal->showItems();
print sprintf("Total Cost: ", $vegMeal->getCost() . PHP_EOL);

print sprintf(PHP_EOL);
print sprintf(PHP_EOL);

$nonVegMeal = $mealBuilder->prepareNonVegMeal();
print sprintf("Non-Veg Meal" . PHP_EOL);
$nonVegMeal->showItems();
print sprintf("Total Cost: ", $nonVegMeal->getCost() . PHP_EOL);
```

## Paso 8

Verifique la salida.

```note
Veg Meal
Item : Veg Burger, Packing : Wrapper, Price : 25.0
Item : Coke, Packing : Bottle, Price : 30.0
Total Cost: 55.0


Non-Veg Meal
Item : Chicken Burger, Packing : Wrapper, Price : 50.5
Item : Pepsi, Packing : Bottle, Price : 35.0
Total Cost: 85.5
```

---
:octocat: [Check more about me.](https://github.com/FernandoCalmet)

[![ko-fi](https://www.ko-fi.com/img/githubbutton_sm.svg)](https://ko-fi.com/T6T41JKMI)

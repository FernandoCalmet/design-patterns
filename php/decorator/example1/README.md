# Decorator Pattern

El patrón de decorador permite al usuario agregar una nueva funcionalidad a un objeto existente sin alterar su estructura. Este tipo de patrón de diseño se incluye en el patrón estructural, ya que este patrón actúa como un envoltorio para la clase existente.

Este patrón crea una clase decoradora que envuelve la clase original y proporciona funcionalidad adicional manteniendo intacta la firma de los métodos de clase.

Estamos demostrando el uso del patrón decorador a través del siguiente ejemplo en el que decoraremos una forma con algún color sin alterar la clase de forma.

## Implementación

Vamos a crear una interfaz Shape y clases concretas implementando la interfaz Shape. Luego crearemos una clase decoradora abstracta ShapeDecorator implementando la interfaz Shape y teniendo el objeto Shape como su variable de instancia.

RedShapeDecorator es una clase concreta que implementa ShapeDecorator.

DecoratorPatternDemo, nuestra clase de demostración utilizará RedShapeDecorator para decorar objetos Shape.

![UML Diagram](decorator_pattern_uml_diagram.jpg)

## Paso 1

Crea una interfaz.

> Shape.php

```php
<?php

declare(strict_types=1);

interface Shape
{
    public function draw(): void;
}
```

## Paso 2

Crea clases concretas implementando la misma interfaz.

> Rectangle.php

```php
<?php

declare(strict_types=1);

require_once __DIR__ . '/Shape.php';

class Rectangle implements Shape
{
    public function draw(): void
    {
        print sprintf("Shape: Rectangle" . PHP_EOL);
    }
}
```

> Circle.php

```php
<?php

declare(strict_types=1);

require_once __DIR__ . '/Shape.php';

class Circle implements Shape
{
    public function draw(): void
    {
        print sprintf("Shape: Circle" . PHP_EOL);
    }
}
```

## Paso 3

Cree una clase decoradora abstracta implementando la interfaz Shape.

> ShapeDecorator.php

```php
<?php

declare(strict_types=1);

include_once __DIR__ . '/Shape.php';

abstract class ShapeDecorator implements Shape
{
    protected $decoratedShape;

    public function __construct(Shape $decoratedShape)
    {
        $this->decoratedShape = $decoratedShape;
    }

    public function draw(): void
    {
        $this->decoratedShape->draw();
    }
}
```

## Paso 4

Cree una clase de decorador concreta ampliando la clase ShapeDecorator.

> RedShapeDecorator.php

```php
<?php

declare(strict_types=1);

include_once __DIR__ . '/Shape.php';
include_once __DIR__ . '/ShapeDecorator.php';

class RedShapeDecorator extends ShapeDecorator
{
    public function __construct(Shape $decoratedShape)
    {
        parent::__construct($decoratedShape);
    }

    public function draw(): void
    {
        $this->decoratedShape->draw();
        $this->setRedBorder($this->decoratedShape);
    }

    private function setRedBorder(Shape $decoratedShape): void
    {
        print sprintf("Border Color: Red" . PHP_EOL);
    }
}
```

## Paso 5

Utilice RedShapeDecorator para decorar objetos Shape.

> DecoratorPatternDemo.php

```php
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
```

## Paso 6

Verifique la salida.

```note
Shape: Circle
Circle with normal border

Shape: Circle
Border Color: Red
Circle of red border

Shape: Rectangle
Rectangle with normal border

Shape: Rectangle
Border Color: Red
Rectangle of red border
```

---

:octocat: [Check more about me.](https://github.com/FernandoCalmet)

[![ko-fi](https://www.ko-fi.com/img/githubbutton_sm.svg)](https://ko-fi.com/T6T41JKMI)

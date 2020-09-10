# Factory Pattern

El patrón de fábrica es uno de los patrones de diseño más utilizados en Java. Este tipo de patrón de diseño se incluye en el patrón de creación, ya que este patrón proporciona una de las mejores formas de crear un objeto.

En el patrón de fábrica, creamos un objeto sin exponer la lógica de creación al cliente y nos referimos al objeto recién creado usando una interfaz común.

## Implementación

Vamos a crear una interfaz Shape y clases concretas implementando la interfaz Shape. Una clase de fábrica ShapeFactory se define como el siguiente paso.

FactoryPatternDemo, nuestra clase de demostración utilizará ShapeFactory para obtener un objeto Shape. Pasará información (CÍRCULO / RECTÁNGULO / CUADRADO) a ShapeFactory para obtener el tipo de objeto que necesita.

![UML Diagram](factory_pattern_uml_diagram.jpg)

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
        print sprintf("Inside Rectangle::draw() method." . PHP_EOL);
    }
}
```

> Square.php

```php
<?php

declare(strict_types=1);

require_once __DIR__ . '/Shape.php';

class Square implements Shape
{
    public function draw(): void
    {
        print sprintf("Inside Square::draw() method." . PHP_EOL);
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
        print sprintf("Inside Circle::draw() method." . PHP_EOL);
    }
}
```

## Paso 3

Cree una fábrica para generar un objeto de clase concreta basado en información dada.

> ShapeFactory.php

```php
<?php

declare(strict_types=1);

include_once __DIR__ . '/Circle.php';
include_once __DIR__ . '/Rectangle.php';
include_once __DIR__ . '/Square.php';

class ShapeFactory
{
    //use getShape method to get object of type shape
    public function getShape(string $shapeType): Shape
    {
        if ($shapeType == null) {
            return null;
        }
        if (strcasecmp($shapeType, "CIRCLE")) {
            return new Circle();
        } else if (strcasecmp($shapeType, "RECTANGLE")) {
            return new Rectangle();
        } else if (strcasecmp($shapeType, "SQUARE")) {
            return new Square();
        }

        return null;
    }
}
```

## Paso 4

Utilice Factory para obtener un objeto de una clase concreta pasando una información como el tipo.

> FactoryPatternDemo.php

```php
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
```

## Paso 5

Verifique la salida.

```note
Inside Circle::draw() method.
Inside Rectangle::draw() method.
Inside Square::draw() method.
```

---

:octocat: [Check more about me.](https://github.com/FernandoCalmet)

[![ko-fi](https://www.ko-fi.com/img/githubbutton_sm.svg)](https://ko-fi.com/T6T41JKMI)

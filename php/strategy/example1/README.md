# Strategy Pattern

En el patrón de estrategia, el comportamiento de una clase o su algoritmo se puede cambiar en tiempo de ejecución. Este tipo de patrón de diseño se incluye en el patrón de comportamiento.

En el patrón de estrategia, creamos objetos que representan varias estrategias y un objeto de contexto cuyo comportamiento varía según su objeto de estrategia. El objeto de estrategia cambia el algoritmo de ejecución del objeto de contexto.

## Implementación

Vamos a crear una interfaz de estrategia que defina una acción y clases de estrategia concretas implementando la interfaz de estrategia. El contexto es una clase que usa una estrategia.

StrategyPatternDemo, nuestra clase de demostración, utilizará objetos de contexto y estrategia para demostrar el cambio en el comportamiento del contexto en función de la estrategia que implementa o utiliza.

![UML Diagram](strategy_pattern_uml_diagram.jpg)

## Paso 1

Crea una interfaz.

> Strategy.php

```php
<?php

declare(strict_types=1);

interface Strategy
{
    public function doOperation(int $num1, int $num2): int;
}
```

## Paso 2

Crea clases concretas implementando la misma interfaz.

> OperationAdd.php

```php
<?php

declare(strict_types=1);

class OperationAdd implements Strategy
{
    public function doOperation(int $num1, int $num2): int
    {
        return $num1 + $num2;
    }
}
```

> OperationSubstract.php

```php
<?php

declare(strict_types=1);

class OperationSubstract implements Strategy
{
    public function doOperation(int $num1, int $num2): int
    {
        return $num1 - $num2;
    }
}
```

> OperationMultiply.php

```php
<?php

declare(strict_types=1);

class OperationMultiply implements Strategy
{
    public function doOperation(int $num1, int $num2): int
    {
        return $num1 * $num2;
    }
}
```

## Paso 3

Crear clase de contexto.

> Context.php

```php
<?php

declare(strict_types=1);

include_once __DIR__ . '/Strategy.php';

class Context
{
    private $strategy;

    public function __construct(Strategy $strategy)
    {
        $this->strategy = $strategy;
    }

    public function executeStrategy(int $num1, int $num2): int
    {
        return $this->strategy->doOperation($num1, $num2);
    }
}
```

## Paso 4

Utilice el contexto para ver cambios en el comportamiento cuando cambia su estrategia.

> StrategyPatternDemo.php

```php
<?php

declare(strict_types=1);

include_once __DIR__ . '/Context.php';
include_once __DIR__ . '/OperationAdd.php';
include_once __DIR__ . '/OperationSubstract.php';
include_once __DIR__ . '/OperationMultiply.php';

$context = new Context(new OperationAdd());
print sprintf("10 + 5 = " . $context->executeStrategy(10, 5) . PHP_EOL);
$context = new Context(new OperationSubstract());
print sprintf("10 - 5 = " . $context->executeStrategy(10, 5) . PHP_EOL);
$context = new Context(new OperationMultiply());
print sprintf("10 * 5 = " . $context->executeStrategy(10, 5) . PHP_EOL);
```

## Paso 5

Verifique la salida.

```note
10 + 5 = 15
10 - 5 = 5
10 * 5 = 50
```

---

:octocat: [Check more about me.](https://github.com/FernandoCalmet)

[![ko-fi](https://www.ko-fi.com/img/githubbutton_sm.svg)](https://ko-fi.com/T6T41JKMI)

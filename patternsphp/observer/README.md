# Observer Pattern

El patrón de observador se usa cuando existe una relación de uno a muchos entre objetos, por ejemplo, si un objeto se modifica, sus objetos dependientes deben notificarse automáticamente. El patrón de observador se incluye en la categoría de patrón de comportamiento.

## Implementación

El patrón de observador utiliza tres clases de actores. Sujeto, observador y cliente. El sujeto es un objeto que tiene métodos para adjuntar y separar observadores de un objeto cliente. Hemos creado una clase abstracta Observador y una clase concreta Sujeto que está ampliando la clase Observador.

![UML Diagram](observer_pattern_uml_diagram.jpg)

## Paso 1

Crear clase de Subject.

> Subject.php

```php
<?php

declare(strict_types=1);

include_once __DIR__ . '/Observer.php';

class Subject
{
    private $_observers = array();
    private $_state;

    public function getState(): int
    {
        return $this->_state;
    }

    public function setState(int $state): void
    {
        $this->_state = $state;
        $this->notifyAllObservers();
    }

    public function attach(Observer $observer): void
    {
        array_push($this->_observers, $observer);
    }

    public function notifyAllObservers(): void
    {
        foreach ($this->_observers as $observer) {
            $observer->update();
        }
    }
}
```

## Paso 2

Crear clase de observador.

> Observer.php

```php
<?php

declare(strict_types=1);

include_once __DIR__ . '/Subject.php';

abstract class Observer
{
    protected $_subject;

    public function __construct()
    {
        $this->_subject = new Subject();
    }

    public function getSubject(): Subject
    {
        return $this->_subject;
    }

    public function setSubject(Subject $subject): void
    {
        $this->_subject = $subject;
    }

    public abstract function update(): void;
}
```

## Paso 3

Crea clases de observadores concretas

> BinaryObserver.php

```php
<?php

declare(strict_types=1);

include_once __DIR__ . '/Observer.php';
include_once __DIR__ . '/Subject.php';

class BinaryObserver extends Observer
{
    public function __construct(Subject $subject)
    {
        $this->setSubject($subject);
        $this->getSubject()->attach($this);
    }

    public function update(): void
    {
        $result = decbin($this->getSubject()->getState());
        print sprintf("Binary String: %s" . PHP_EOL, $result);
    }
}
```

> OctalObserver.php

```php
<?php

declare(strict_types=1);

include_once __DIR__ . '/Observer.php';
include_once __DIR__ . '/Subject.php';

class OctalObserver extends Observer
{
    public function __construct(Subject $subject)
    {
        $this->setSubject($subject);
        $this->getSubject()->attach($this);
    }

    public function update(): void
    {
        $result = decoct($this->getSubject()->getState());
        print sprintf("Octal String: %s" . PHP_EOL, $result);
    }
}
```

> HexaObserver.php

```php
<?php

declare(strict_types=1);

include_once __DIR__ . '/Observer.php';
include_once __DIR__ . '/Subject.php';

class HexaObserver extends Observer
{
    public function __construct(Subject $subject)
    {
        $this->setSubject($subject);
        $this->getSubject()->attach($this);
    }

    public function update(): void
    {
        $result = dechex($this->getSubject()->getState());
        print sprintf("Hex String: %s" . PHP_EOL, $result);
    }
}
```

## Paso 4

Utilice Sujeto y objetos observadores concretos.

> ObserverPatternDemo.php

```php
<?php

include_once __DIR__ . '/Subject.php';
include_once __DIR__ . '/HexaObserver.php';
include_once __DIR__ . '/OctalObserver.php';
include_once __DIR__ . '/BinaryObserver.php';

$subject = new Subject();

new HexaObserver($subject);
new OctalObserver($subject);
new BinaryObserver($subject);

print sprintf("First state change: 15" . PHP_EOL);
$subject->setState(15);
print sprintf("Second state change: 10" . PHP_EOL);
$subject->setState(10);
```

## Paso 5

Verifique la salida.

```note
First state change: 15
Hex String: F
Octal String: 17
Binary String: 1111
Second state change: 10
Hex String: A
Octal String: 12
Binary String: 1010
```

---

:octocat: [Check more about me.](https://github.com/FernandoCalmet)

[![ko-fi](https://www.ko-fi.com/img/githubbutton_sm.svg)](https://ko-fi.com/T6T41JKMI)

# Singleton Pattern

El patrón singleton es uno de los patrones de diseño más simples de Java. Este tipo de patrón de diseño se incluye en el patrón de creación, ya que este patrón proporciona una de las mejores formas de crear un objeto.

Este patrón involucra una sola clase que es responsable de crear un objeto mientras se asegura de que solo se cree un objeto. Esta clase proporciona una forma de acceder a su único objeto al que se puede acceder directamente sin necesidad de crear una instancia del objeto de la clase.

## Implementación

Vamos a crear una clase SingleObject. La clase SingleObject tiene su constructor como privado y tiene una instancia estática de sí mismo.

La clase SingleObject proporciona un método estático para llevar su instancia estática al mundo exterior. SingletonPatternDemo, nuestra clase de demostración utilizará la clase SingleObject para obtener un objeto SingleObject.

![UML Diagram](singleton_pattern_uml_diagram.jpg)

## Paso 1

Crea una clase Singleton.

> SingleObject.php

```php
<?php

declare(strict_types=1);

class SingleObject
{
    private function __construct()
    {
        //do nothing
    }

    //Get the only object available
    public static function getInstance()
    {
        $instance = null;

        if ($instance === null) {
            $instance = new static();
        }

        return $instance;
    }

    public function showMessage(): void
    {
        print sprintf("Hello World!" . PHP_EOL);
    }
}
```

## Paso 2

Obtenga el único objeto de la clase singleton.

> SingletonPatternDemo.php

```php
<?php

include_once __DIR__ . '/SingleObject.php';

//illegal construct
//Compile Time Error: The constructor SingleObject() is not visible
//$object = new SingleObject();

//Get the only object available
$object = SingleObject::getInstance();

//show the message
$object->showMessage();
```

## Paso 3

Verifique la salida.

```note
Hello World!
```

---

:octocat: [Check more about me.](https://github.com/FernandoCalmet)

[![ko-fi](https://www.ko-fi.com/img/githubbutton_sm.svg)](https://ko-fi.com/T6T41JKMI)

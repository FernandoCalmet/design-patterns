# Strategy Pattern

En el patrón de estrategia, el comportamiento de una clase o su algoritmo se puede cambiar en tiempo de ejecución. Este tipo de patrón de diseño se incluye en el patrón de comportamiento.

En el patrón de estrategia, creamos objetos que representan varias estrategias y un objeto de contexto cuyo comportamiento varía según su objeto de estrategia. El objeto de estrategia cambia el algoritmo de ejecución del objeto de contexto.

## Implementación

Vamos a crear una interfaz de estrategia que defina una acción y clases de estrategia concretas implementando la interfaz de estrategia. El contexto es una clase que usa una estrategia.

Para este caso se aplicara el ejemplo con estados de ordenes de compra.

## Paso 1

Crear un proyecto con Laravel

```bash
composer create-project laravel/laravel strategy
```

## Paso 2

Crea un controlador **PurchaseOrderController**

```bash
php artisan make:controller PurchaseOrderController
```

## Paso 3

Aplicamos el patron strategy cuando una clase define muchos comportamientos y estas se representan con multiples condicionales, esto dara mayor dificultad en ir agregando mas estados como lo podemos apreciar en la siguiente clase.

> app/Http/Controllers/PurchaseOrderController.php

```php
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PurchaseOrderController extends Controller
{
    public function getFollowingStates(Request $request)
    {
        $state = $request->input('state');

        if ($state == 'in_transit') {
            return ['cancelled', 'at_destination'];
        }

        if ($state == 'at_destination') {
            return ['cancelled', 'certified'];
        }

        if ($state == 'certified') {
            return ['cancelled', 'billed', 'payed'];
        }

        if ($state == 'billed') {
            return ['certified', 'payed'];
        }

        if ($state == 'payed') {
            return ['certified'];
        }

        return [];  
    }
}
```

## Paso 4

Ahora definimos una interfaz para definir un contrato para poder ejecutar los cambios de estados posibles.

> app/Strategies/PurchaseOrderStatesInterface.php

```php
<?php

namespace App\Strategies;

interface PurchaseOrderStatesInterface
{
    public function getFollowingStates();
}
```

## Paso 5

Crear una carpeta **PurchaseOrderStates**  para agrupar una clase concreta para cada estado.

Ahora pasamos cada condicional del **PurchaseOrderController** en cada clase concreta del estado correspondiente.

> app/Strategies/PurchaseOrderStates/InTransit.php

```php
<?php

namespace App\Strategies\PurchaseOrderStates;

use App\Strategies\PurchaseOrderStatesInterface;

class InTransit implements PurchaseOrderStatesInterface
{
    public function getFollowingStates()
    {
        return ['cancelled', 'at_destination'];
    }
}
```

> app/Strategies/PurchaseOrderStates/AtDestination.php

```php
<?php

namespace App\Strategies\PurchaseOrderStates;

use App\Strategies\PurchaseOrderStatesInterface;

class AtDestination implements PurchaseOrderStatesInterface
{
    public function getFollowingStates()
    {
        return ['cancelled', 'certified'];
    }
}
```

> app/Strategies/PurchaseOrderStates/Certified.php

```php
<?php

namespace App\Strategies\PurchaseOrderStates;

use App\Strategies\PurchaseOrderStatesInterface;

class Certified implements PurchaseOrderStatesInterface
{
    public function getFollowingStates()
    {
        return ['cancelled', 'billed', 'payed'];
    }
}
```

> app/Strategies/PurchaseOrderStates/Billed.php

```php
<?php

namespace App\Strategies\PurchaseOrderStates;

use App\Strategies\PurchaseOrderStatesInterface;

class Billed implements PurchaseOrderStatesInterface
{
    public function getFollowingStates()
    {
        return ['certified', 'payed'];
    }
}
```

> app/Strategies/PurchaseOrderStates/Payed.php

```php
<?php

namespace App\Strategies\PurchaseOrderStates;

use App\Strategies\PurchaseOrderStatesInterface;

class Payed implements PurchaseOrderStatesInterface
{
    public function getFollowingStates()
    {
        return ['certified'];
    }
}
```

> app/Strategies/PurchaseOrderStates/Cancelled.php

```php
<?php

namespace App\Strategies\PurchaseOrderStates;

use App\Strategies\PurchaseOrderStatesInterface;

class Cancelled implements PurchaseOrderStatesInterface
{
    public function getFollowingStates($state)
    {
        return [];
    }
}
```

## Paso 6

Crear la clase Contexto para poder llamar a cada estado. Para ello creamos la carpeta **Values**

> app/Values/PurchaseOrderStatusValues.php

```php
<?php

namespace App\Values;

use App\Strategies\PurchaseOrderStates\AtDestination;
use App\Strategies\PurchaseOrderStates\Billed;
use App\Strategies\PurchaseOrderStates\Cancelled;
use App\Strategies\PurchaseOrderStates\Certified;
use App\Strategies\PurchaseOrderStates\InTransit;
use App\Strategies\PurchaseOrderStates\Payed;

final class PurchaseOrderStatusValues
{
    const STRATEGY = [
        'in_transit' => InTransit::class,
        'cancelled' => Cancelled::class,
        'billed' => Billed::class,
        'payed' => Payed::class,
        'certified' => Certified::class,
        'at_destination' => AtDestination::class
    ];
}
```

## Paso 7

Actualizar el controlador, importar el contexto y ahora podemos usar la interface para manejar los estados.

> PurchaseOrderController.php

```php
<?php

namespace App\Http\Controllers;

use App\Values\PurchaseOrderStatusValues;
use Illuminate\Http\Request;

class PurchaseOrderController extends Controller
{
    public function getFollowingStates(Request $request)
    {
        $state = $request->input('state');

        $strategyClass = PurchaseOrderStatusValues::STRATEGY[$state];
        
        return (new $strategyClass)->getFollowingStates();
    }
}
```

## Paso 8

Ejecutar en localhost:8080

```php
php artisan serve
```

Pruebe y verifique la salidas con la colección de Postman: [Importar Colección](https://www.getpostman.com/collections/a3d0cc8506495fb5ab8b).

[![Run in Postman](https://run.pstmn.io/button.svg)](https://www.getpostman.com/collections/a3d0cc8506495fb5ab8b)  
  
HTTP Method | URL | Param Key | Param Value
--- | --- | --- | ---
GET | `/api/get-following-states` | state | in_transit
GET | `/api/get-following-states` | state | cancelled
GET | `/api/get-following-states` | state | billed
GET | `/api/get-following-states` | state | payed
GET | `/api/get-following-states` | state | certified
GET | `/api/get-following-states` | state | at_destination

---

:octocat: [Check more about me.](https://github.com/FernandoCalmet)

[![ko-fi](https://www.ko-fi.com/img/githubbutton_sm.svg)](https://ko-fi.com/T6T41JKMI)

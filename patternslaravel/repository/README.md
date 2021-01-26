# Repository Pattern

El patrón de repositorio ha ganado bastante popularidad desde que se introdujo por primera vez como parte del diseño basado en dominios en 2004. Esencialmente, proporciona una abstracción de datos, de modo que su aplicación puede funcionar con una abstracción simple que tiene una interfaz que se aproxima el de una colección. La adición, eliminación, actualización y selección de elementos de esta colección se realiza a través de una serie de métodos sencillos, sin la necesidad de lidiar con problemas de bases de datos como conexiones, comandos, cursores o lectores. El uso de este patrón puede ayudar a lograr un acoplamiento flexible y puede mantener ignorante la persistencia de los objetos de dominio. Aunque el patrón es muy popular (o quizás debido a esto), también se malinterpreta y se utiliza con frecuencia. Hay muchas formas diferentes de implementar el patrón Repository. Consideremos algunos de ellos y sus méritos e inconvenientes.

## Paso 1

Crear un proyecto con Laravel

```bash
composer create-project laravel/laravel repository
```

## Paso 2

```bash
php artisan make:controller UserController
php artisan make:controller TicketController
```

## Paso 3

Editar la clase Model del User.

> app/Models/User.php

```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'users';

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
    ];

    public function cars()
    {
        return $this->hasMany(Car::class);
    }
}
```

## Paso 4

Crear los modelos de **Car** y **Ticket**.

```bash
php artisan make:model Car
php artisan make:model Ticket
```

## Paso 5

Editar los modelos agregados.

> app/Models/Car.php

```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;

    protected $table = 'cars';

    protected $fillable = [
        'patent',
        'user_id'
    ];

    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }
}
```

> app/Models/Ticket.php

```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    protected $table = 'tickets';

    protected $fillable = [
        'date',
        'amount',
        'car_id'
    ];

    public function car()
    {
        return $this->belongsTo(Car::class);
    }
}
```

## Paso 6

Crear una carpeta **Repositories** en app, y crear la clase **BaseRepository**

```php
<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

class BaseRepository
{
    protected $model;
    private $relations;

    public function __construct(Model $model, array $relations = [])
    {
        $this->model = $model;
        $this->relations = $relations;
    }

    public function all()
    {
        $query = $this->model;

        if (!empty($this->relations)) {
            $query = $query->with($this->relations);
        }

        return $query->get();
    }

    public function get(int $id)
    {
        return $this->model->find($id);
    }

    public function save(Model $model)
    {
        $model->save();

        return $model;
    }

    public function delete(Model $model)
    {
        $model->delete();

        return $model;
    }
}
```

## Paso 7

Crear una carpeta **Repositories** en app, y crear la clase **UserRepository**

> app/Repositories/UserRepository.php

```php
<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository extends  BaseRepository
{
    public function __construct(User $user)
    {
        parent::__construct($user);
    }

    public function getWithSameFirstAndLastName(string $name)
    {
        $first = $this->model->where('first_name', $name);

        return $this->model->where('last_name', $name)
            ->union($first)
            ->get();
    }
}
```

## Paso 8

Implementamos el repository del user al controlador.

> app/Http/Controllers/UserController.php

```php
<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;

class UserController extends Controller
{
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function index()
    {
        $users = $this->userRepository->all();

        return response()->json($users);
    }

    public function show(int $id)
    {
        $user = $this->userRepository->get($id);

        return response()->json($user);
    }

    public function store(Request $request)
    {
        $user = new User($request->all());
        $user = $this->userRepository->save($user);

        return response()->json($user);
    }

    public function update(Request $request, User $user)
    {
        $user->fill($request->all());
        $user = $this->userRepository->save($user);

        return response()->json($user);
    }

    public function destroy(User $user)
    {
        $user = $this->userRepository->delete($user);

        return response()->json($user);
    }

    public function getWithSameFirstAndLastName()
    {
        $name = request()->get('name');

        /*
         * Logica de negocio
         * ...
         * ...
         */

        $users = $this->userRepository->getWithSameFirstAndLastName($name);

        return response()->json($users);
    }
}
```

> app/Http/Controllers/TicketController.php

```php
<?php

namespace App\Http\Controllers;

use App\Models\Ticket;

class TicketController extends Controller
{
    public function index()
    {
        $tickets = Ticket::get();

        return response()->json($tickets);
    }
}
```

## Paso 9

Agregamos las rutas del controlador.

> Routes/api.php

```php
<?php

use App\Http\Controllers\TicketController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('users/with-same-first-and-last-name', [UserController::class, 'getWithSameFirstAndLastName']);
Route::apiResource('users', UserController::class);

Route::apiResource('tickets', TicketController::class);
```

---

:octocat: [Check more about me.](https://github.com/FernandoCalmet)

[![ko-fi](https://www.ko-fi.com/img/githubbutton_sm.svg)](https://ko-fi.com/T6T41JKMI)

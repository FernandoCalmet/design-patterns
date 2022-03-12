# Decorator Pattern

El patrón de decorador permite al usuario agregar una nueva funcionalidad a un objeto existente sin alterar su estructura. Este tipo de patrón de diseño se incluye en el patrón estructural, ya que este patrón actúa como un envoltorio para la clase existente.

Este patrón crea una clase decoradora que envuelve la clase original y proporciona funcionalidad adicional manteniendo intacta la firma de los métodos de clase.

Estamos demostrando el uso del patrón decorador a través del siguiente ejemplo en el que decoraremos una forma con algún color sin alterar la clase de forma.

## Implementación

Se implementara caché con REDIS para crear una capa de almacenamiento de alta velocidad donde su primer objetivo es mejorar el rendimiento de la aplicación.

Se implementara junto con el patron repository del repositorio del [Repository Pattern](https://github.com/FernandoCalmet/Design-Patterns/tree/master/patternslaravel/repository).

- **Componente Interface**: BaseRepositoryInterface, UserRepositoryInterface
- **Componente Concreto**: BaseRepository, UserRepository
- **Decorador**: BaseCache
- **Decorador Concreto**: UserCache

## Redis

[Redis](https://redis.io/download)

## Paso 1

Crear un proyecto con Laravel

```bash
composer create-project laravel/laravel decorator
```

## Paso 2

Agregar implementación del repository del **Repository Pattern**.

## Paso 3

Editar el seeder de usuario para precargar 30 mil usuarios para poder la diferencia entre usar la base de datos y la cáche.

> database/seeders/UserSeeder.php

```php
<?php

namespace Database\Seeders;

use App\Models\Car;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        User::factory()->times(30000)->create();
    }
}
```

## Paso 4

Configurar el archivo **.env**

```bash
CACHE_DRIVER=redis
REDIS_HOST=decoratorredis
```

## Paso 5

Instalar el paquete de Predis

```bash
composer require predis/predis
```

## Paso 6

Crear una carpeta **Contracts** para crear la interfaz **BaseRepositoryInterface** y **UserRepositoryInterface**.

> app/Contracts/BaseRepositoryInterface.php

```php
<?php

namespace App\Contracts;

use Illuminate\Database\Eloquent\Model;

interface BaseRepositoryInterface
{
    public function all();

    public function get(int $id);

    public function save(Model $model);

    public function delete(Model $model);
}
```

> app/Contracts/UserRepositoryInterface.php

```php
<?php

namespace App\Contracts;

interface UserRepositoryInterface
{
    public function getWithSameFirstAndLastName(string $name);
}
```

## Paso 7

Implementar interface en repositorios.

> app/Repositories/BaseRepository.php

```php
<?php

namespace App\Repositories;

use App\Contracts\BaseRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class BaseRepository implements BaseRepositoryInterface
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

        if(!empty($this->relations)) {
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

> app/Repositories/UserRepository.php

```php
<?php

namespace App\Repositories;

use App\Contracts\UserRepositoryInterface;
use App\Models\User;

class UserRepositories extends  BaseRepository implements UserRepositoryInterface
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

Crear una carpeta **Cache** para crear la interfaz **BaseCache** y **UserCache**.

> app/Contracts/BaseCache.php

```php
<?php

namespace App\Cache;

use App\Contracts\BaseRepositoryInterface;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\Cache;

abstract class BaseCache implements BaseRepositoryInterface
{
    const TTL = 864000;
    protected $repository;
    protected $key;
    protected $cache;

    public function __construct(Object $repository, string $key)
    {
        $this->repository = $repository;
        $this->key = $key;
        $this->cache = new Cache();
    }

    protected function forget($key)
    {
        $this->cache::forget($key);
    }
}
```

> app/Contracts/UserCache.php

```php
<?php

namespace App\Cache;

use App\Contracts\UserRepositoryInterface;
use App\Repositories\UserRepositories;
use Illuminate\Database\Eloquent\Model;

class UserCache extends BaseCache implements UserRepositoryInterface
{
    public function __construct(UserRepositories $userRepositories)
    {
        parent::__construct($userRepositories, 'user');
    }

    public function all()
    {
        return $this->cache::remember($this->key, self::TTL, function() {
            return $this->repository->all();
        });
    }

    public function get(int $id)
    {
        return $this->repository->get($id);
    }

    public function save(Model $model)
    {
        $this->forget($this->key);

        return $this->repository->save($model);
    }

    public function delete(Model $model)
    {
        $this->forget($this->key);

        return $this->repository->delete($model);
    }

    public function getWithSameFirstAndLastName(string $name)
    {
        return $this->cache::remember("$this->key.same_name", self::TTL, function() use ($name) {
            return $this->repository->getWithSameFirstAndLastName($name);
        });
    }
}
```

## Paso 9

Hacer un binding entre la interface del usuario y la clase que queramos usar, sea cual sea el repository.

> app/Providers/AppServiceProvider.php

```php
<?php

namespace App\Providers;

use App\Cache\UserCache;
use App\Contracts\UserRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    protected $bindings = [
        UserRepositoryInterface::class => UserCache::class
    ];
    
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
```

## Paso 10

> Ejecutar en local con docker

```bash
# Ejecutar una sola vez
sh setup-local.sh
# Ejecutar el proyecto siempre que se necesite
sh start-local.sh
```

> Ejecutar en localhost:8080

```bash
php artisan serve
```

Pruebe y verifique la salidas con la colección de Postman: [Importar Colección](https://www.getpostman.com/collections/2226dc5f59c19b3bd56c).

[![Run in Postman](https://run.pstmn.io/button.svg)](https://www.getpostman.com/collections/2226dc5f59c19b3bd56c)  
  
HTTP Method | URL
--- | ---
GET | `/api/users`

---

:octocat: [Check more about me.](https://github.com/FernandoCalmet)

[![ko-fi](https://www.ko-fi.com/img/githubbutton_sm.svg)](https://ko-fi.com/T6T41JKMI)

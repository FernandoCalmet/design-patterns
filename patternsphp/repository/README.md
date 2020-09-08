# Repository Pattern

El patrón de repositorio ha ganado bastante popularidad desde que se introdujo por primera vez como parte del diseño basado en dominios en 2004. Esencialmente, proporciona una abstracción de datos, de modo que su aplicación puede funcionar con una abstracción simple que tiene una interfaz que se aproxima el de una colección. La adición, eliminación, actualización y selección de elementos de esta colección se realiza a través de una serie de métodos sencillos, sin la necesidad de lidiar con problemas de bases de datos como conexiones, comandos, cursores o lectores. El uso de este patrón puede ayudar a lograr un acoplamiento flexible y puede mantener ignorante la persistencia de los objetos de dominio. Aunque el patrón es muy popular (o quizás debido a esto), también se malinterpreta y se utiliza con frecuencia. Hay muchas formas diferentes de implementar el patrón Repository. Consideremos algunos de ellos y sus méritos e inconvenientes.

## Paso 1

Crear el archivo de **composer.json**

> composer.json

```json
{
  "name": "repository-pattern/php-7",
  "autoload": {
    "psr-4": {
      "Sales\\": "sales/",
      "App\\": "app/"
    }
  }
}
```

Generar/Actualizar el paquete de **Vendor** para las autocargas.

```bash
composer dump-autoload
```

## Paso 2

Crear los directorios especificados en el psr-4. Dentro del directorio de Ventas crear la carpeta **Database** para crear una clase para el **Provider** de la base de datos.

> sales/Database.php

```php
<?php

namespace Sales\Database;

use Pdo;

class DbProvider
{
    private static $_db;

    public static function get()
    {
        if (!self::$_db) {
            $pdo = new Pdo(
                __CONFIG__['db']['host'],
                __CONFIG__['db']['user'],
                __CONFIG__['db']['password']
            );

            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);

            self::$_db = $pdo;
        }

        return self::$_db;
    }
}
```

## Paso 3

Los modelos son las entidades que hacen referencia a las tablas. Crear las clases modelos.

> app/Models/Order.php

```php
<?php
namespace App\Models;

class Order
{
    public $id;

    // User client
    public $user_id;
    public $client;

    public $total = 0;

    // User creater
    public $creater_id;
    public $creater;

    public $created_at;
    public $updated_at;

    // Order Detail
    public $detail = [];
}
```

> app/Models/OrderDetail.php

```php
<?php
namespace App\Models;

class OrderDetail
{
    public $id;
    public $order_id;

    // Product
    public $product_id;
    public $product;

    public $quantity;
    public $price;
    public $total = 0;
    public $created_at;
    public $updated_at;
}
```

> app/Models/Product.php

```php
<?php
namespace App\Models;

class Product
{
    public $id;
    public $name;
    public $price;
    public $created_at;
    public $updated_at;
}
```

> app/Models/User.php

```php
<?php
namespace App\Models;

class User
{
    public $id;
    public $first_name;
    public $last_name;
    public $user_name;
    public $password;
    public $created_at;
    public $updated_at;
}
```

## Paso 4

Los service son los encargados de consumir los repositorios y mapear los modelos. Crear las clases services.

> app/Services/OrderService.php

```php
<?php

namespace App\Services;

use App\Models\Order;
use App\Repositories\{OrderRepository, UserRepository, OrderDetailRepository, ProductRepository};
use PDOException;

class OrderService
{
    private $_userRepository;
    private $_orderRepository;
    private $_orderDetailRepository;
    private $_productRepository;

    public function __construct()
    {
        $this->_userRepository = new UserRepository();
        $this->_orderRepository = new OrderRepository();
        $this->_orderDetailRepository = new OrderDetailRepository();
        $this->_productRepository = new ProductRepository();
    }

    public function get(int $id): ?Order
    {
        $result = null;

        try {
            $data = $this->_orderRepository->find($id);

            if ($data) {
                $result = $data;
                // Client
                $result->client = $this->_userRepository->find($result->user_id);
                // Creater
                $result->creater = $this->_userRepository->find($result->creater_id);
                // Detail
                $result->detail = $this->getDetail($result->id);
            }
        } catch (PDOException $ex) {
            print($ex->getMessage());
        }

        return $result;
    }

    private function getDetail(int $order_id): array
    {
        $result = [];

        try {
            $result = $this->_orderDetailRepository->findAllByOrderId($order_id);

            foreach ($result as $item) {
                $item->product = $this->_productRepository->find($item->product_id);
            }
        } catch (PDOException $ex) {
            print($ex->getMessage());
        }

        return $result;
    }

    public function create(Order $model): void
    {
        try {
            // Begin transacation
            $this->_db->beginTransaction();
            // Prepare order creation
            $this->prepareOrderCreation($model);
            // Order creation
            $this->_orderRepository->add($model);
            // Order Detail creation
            $this->_orderRepository->addByOrderId($model->id, $model->detail);
            // Commit transaction
            $this->_db->commit();
        } catch (PDOException $ex) {
            $this->_db->rollBack();
        }
    }

    private function prepareOrderCreation(Order &$model): void
    {
        $now = date('Y-m-d H:i:s');

        $model->created_at = $now;
        $model->updated_at = $now;

        foreach ($model->detail as $item) {
            $item->total = $item->price * $item->quantity;

            $item->created_at = $now;
            $item->updated_at = $now;

            $model->total += $item->total;
        }
    }
}
```

> app/Services/ProductService.php

```php
<?php

namespace App\Services;

use App\Models\Product;
use App\Repositories\ProductRepository;
use PDOException;

class ProductService
{
    private $_productRepository;

    public function __construct()
    {
        $this->_productRepository = new ProductRepository();
    }

    public function getAll(): array
    {
        $result = [];

        try {
            $result = $this->_productRepository->findAll();
        } catch (PDOException $ex) {
            print $ex->getMessage();
        }

        return $result;
    }

    public function get(int $id): ?Product
    {
        $result = null;

        try {
            $result = $this->_productRepository->find($id);
        } catch (PDOException $ex) {
            print $ex->getMessage();
        }

        return $result;
    }

    public function create(Product $model): void
    {
        try {
            $this->_productRepository->add($model);
        } catch (PDOException $ex) {
            print $ex->getMessage();
        }
    }

    public function update(Product $model): void
    {
        try {
            $this->_productRepository->update($model);
        } catch (PDOException $ex) {
            print $ex->getMessage();
        }
    }

    public function delete(int $id): void
    {
        try {
            $this->_productRepository->remove($id);
        } catch (PDOException $ex) {
            print $ex->getMessage();
        }
    }
}
```

## Paso 5

Crear repositorios los cuales realizaran las transacciones con la base de datos.

> Repositories/OrderDetailRepository.php

```php
<?php

namespace App\Repositories;

use Sales\Database\DbProvider;
use PDO;

class OrderDetailRepository
{
    private $_db;

    public function __construct()
    {
        $this->_db = DbProvider::get();
    }

    public function findAllByOrderId(int $order_id): Array
    {
        $result = [];

        // 01. Prepare query
        $stm = $this->_db->prepare('select * from order_detail where order_id = :order_id');
        // 02. Execute query
        $stm->execute(['order_id' => $order_id]);
        // 03. Fetch All
        $data = $stm->fetchAll(\PDO::FETCH_CLASS, '\\App\\Models\\OrderDetail');
        // 04. Verify if result is null
        if ($data) {
            $result = $data;
        }

        return $result;
    }
}
```

> Repositories/OrderRepository.php

```php
<?php

namespace App\Repositories;

use Sales\Database\DbProvider;
use App\Models\Order;
use PDO;

class OrderRepository
{
    private $_db;

    public function __construct()
    {
        $this->_db = DbProvider::get();
    }

    public function find(int $id): ?Order
    {
        $result = null;

        // 01. Prepare query
        $stm = $this->_db->prepare('select * from orders where id = :id');
        // 02. Execute query
        $stm->execute(['id' => $id]);
        // 03. Fetch All
        $data = $stm->fetchObject('\\App\\Models\\Order');
        // 04. Verify if result is null
        if ($data) {
            $result = $data;
        }

        return $result;
    }

    public function findAll(): array
    {
        $result = [];

        // 01. Prepare query
        $stm = $this->_db->prepare('select * from orders');
        // 02. Execute query
        $stm->execute();
        // 03. Fetch All
        $data = $stm->fetchAll(PDO::FETCH_CLASS, '\\App\\Models\\Order');
        // 04. Verify if result is null
        if ($data) {
            $result = $data;
        }

        return $result;
    }

    public function add(Order $model): void
    {
        // 01. Prepare query
        $stm = $this->_db->prepare('
            insert into orders(user_id, total, creater_id, created_at, updated_at)
            values(:user_id, :total, :creater_id, :created, :updated)
        ');
        // 02. Execute query
        $stm->execute([
            'user_id' => $model->user_id,
            'total' => $model->total,
            'creater_id' => $model->creater_id,
            'created' => $model->created_at,
            'updated' => $model->updated_at,
        ]);

        $model->id = $this->_db->lastInsertId();
    }

    public function addByOrderId(int $orderId, array $model): void
    {
        foreach ($model as $item) {
            $stm = $this->_db->prepare('
                insert into order_detail(order_id, product_id, quantity, price, total, created_at, updated_at)
                values(:order_id, :product_id, :quantity, :price, :total, :created_at, :updated_at)
            ');

            $stm->execute([
                'order_id' => $orderId,
                'product_id' => $item->product_id,
                'quantity' => $item->quantity,
                'price' => $item->price,
                'total' => $item->total,
                'created_at' => $item->created_at,
                'updated_at' => $item->updated_at,
            ]);
        }
    }

    public function remove(int $id): void
    {
        // 01. Prepare query
        $stm = $this->_db->prepare(
            'delete from orders where id = :id'
        );
        // 02. Execute query
        $stm->execute(['id' => $id]);
    }
}
```

> Repositories/ProductRepository.php

```php
<?php

namespace App\Repositories;

use Sales\Database\DbProvider;
use App\Models\Product;
use PDO;

class ProductRepository
{
    private $_db;

    public function __construct()
    {
        $this->_db = DbProvider::get();
    }

    public function find(int $id): ?Product
    {
        $result = null;

        // 01. Prepare query
        $stm = $this->_db->prepare('select * from products where id = :id');
        // 02. Execute query
        $stm->execute(['id' => $id]);
        // 03. Fetch Single
        $data = $stm->fetchObject('\\App\\Models\\Product');
        // 04. Verify if result is null
        if ($data) {
            $result = $data;
        }

        return $result;
    }

    public function findAll(): array
    {
        $result = [];

        // 01. Prepare query
        $stm = $this->_db->prepare('select * from products');
        // 02. Execute query
        $stm->execute();
        // 03. Fetch All
        $data = $stm->fetchAll(PDO::FETCH_CLASS, '\\App\\Models\\Product');
        // 04. Verify if result is null
        if ($data) {
            $result = $data;
        }

        return $result;
    }

    public function add(Product $model): void
    {
        // 01. Prepare query
        $stm = $this->_db->prepare(
            'insert into products(name, price, created_at, updated_at) values (:name, :price, :created, :updated)'
        );

        $now = date('Y-m-d H:i:s');
        // 02. Execute query
        $stm->execute([
            'name' => $model->name,
            'price' => $model->price,
            'created' => $now,
            'updated' => $now,
        ]);
    }

    public function update(Product $model): void
    {
        // 01. Prepare query
        $stm = $this->_db->prepare('
                update products
                set
                    name = :name,
                    price = :price,
                    updated_at = :updated
                where id = :id
            ');
        // 02. Execute query
        $stm->execute([
            'name' => $model->name,
            'price' => $model->price,
            'updated' => date('Y-m-d H:i:s'),
            'id' => $model->id,
        ]);
    }

    public function remove(int $id): void
    {
        // 01. Prepare query
        $stm = $this->_db->prepare(
            'delete from products where id = :id'
        );
        // 02. Execute query
        $stm->execute(['id' => $id]);
    }
}
```

> Repositories/UserRepository.php

```php
<?php

namespace App\Repositories;

use Sales\Database\DbProvider;
use App\Models\User;
use PDO;

class UserRepository
{
    private $_db;

    public function __construct()
    {
        $this->_db = DbProvider::get();
    }

    public function find(int $id): ?User
    {
        $result = null;

        // 01. Prepare query
        $stm = $this->_db->prepare('select * from users where id = :id');
        // 02. Execute query
        $stm->execute(['id' => $id]);
        // 03. Fetch Single
        $data = $stm->fetchObject('\\App\\Models\\User');
        // 04. Verify if result is null
        if ($data) {
            $result = $data;
        }

        return $result;
    }

    public function findAll(): array
    {
        $result = [];

        // 01. Prepare query
        $stm = $this->_db->prepare('select * from users');
        // 02. Execute query
        $stm->execute();
        // 03. Fetch All
        $data = $stm->fetchAll(PDO::FETCH_CLASS, '\\App\\Models\\User');
        // 04. Verify if result is null
        if ($data) {
            $result = $data;
        }

        return $result;
    }

    public function add(User $model): void
    {
        // 01. Prepare query
        $stm = $this->_db->prepare(
            'insert into users(first_name, last_name, user_name, password, created_at, updated_at) values (:first_name, :last_name, :user_name, :password, :created, :updated)'
        );

        $now = date('Y-m-d H:i:s');
        // 02. Execute query
        $stm->execute([
            'first_name' => $model->first_name,
            'last_name' => $model->last_name,
            'user_name' => $model->user_name,
            'password' => $model->password,
            'created' => $now,
            'updated' => $now,
        ]);
    }

    public function update(User $model): void
    {
        // 01. Prepare query
        $stm = $this->_db->prepare('
                update users
                set
                    first_name = :first_name,
                    last_name = :last_name,
                    user_name = :user_name,
                    password = : password,
                    updated_at = :updated
                where id = :id
            ');
        // 02. Execute query
        $stm->execute([
            'name' => $model->name,
            'price' => $model->price,
            'updated' => date('Y-m-d H:i:s'),
            'id' => $model->id,
        ]);
    }

    public function remove(int $id): void
    {
        // 01. Prepare query
        $stm = $this->_db->prepare(
            'delete from users where id = :id'
        );
        // 02. Execute query
        $stm->execute(['id' => $id]);
    }
}

```

---

:octocat: [Check more about me.](https://github.com/FernandoCalmet)

[![ko-fi](https://www.ko-fi.com/img/githubbutton_sm.svg)](https://ko-fi.com/T6T41JKMI)

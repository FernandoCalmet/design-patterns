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

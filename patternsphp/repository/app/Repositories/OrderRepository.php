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

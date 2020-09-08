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

    public function findAllByOrderId(int $order_id): array
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

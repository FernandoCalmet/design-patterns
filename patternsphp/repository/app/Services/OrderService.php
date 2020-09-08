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

<?php

namespace App\Services;

use App\Models\Order;
use App\Repositories\{OrderRepository, UserRepository, OrderDetailRepository, ProductRepository};
use PDOException;
use Sales\Container;

class OrderService
{
    private $_userRepository;
    private $_orderRepository;
    private $_orderDetailRepository;
    private $_productRepository;
    private $_logger;

    public function __construct()
    {
        $this->_userRepository = new UserRepository();
        $this->_orderRepository = new OrderRepository();
        $this->_orderDetailRepository = new OrderDetailRepository();
        $this->_productRepository = new ProductRepository();
        $this->_logger = Container::get('logger');
    }

    public function get(int $id): ?Order
    {
        $result = null;

        try {
            // Begin transacation      
            $this->_db->beginTransaction();

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
            $this->_db->rollBack();
            $this->logger->error($ex->getMessage());
            print($ex->getMessage());
        }

        return $result;
    }

    private function getDetail(int $order_id): array
    {
        $result = [];

        try {
            // Begin transacation
            $this->_db->beginTransaction();

            $result = $this->_orderDetailRepository->findAllByOrderId($order_id);

            foreach ($result as $item) {
                $item->product = $this->_productRepository->find($item->product_id);
            }
        } catch (PDOException $ex) {
            $this->_db->rollBack();
            $this->logger->error($ex->getMessage());
            print($ex->getMessage());
        }

        return $result;
    }

    public function create(Order $model): void
    {
        try {
            // Begin transacation
            $this->_db->beginTransaction();

            $this->logger->info('Comenzó creación de orden'); //log info

            // Prepare order creation
            $this->prepareOrderCreation($model);

            $this->logger->info('Se preparó el modelo para la nueva orden'); //log info

            // Order creation
            $this->_orderRepository->add($model);

            $this->logger->info('Se creo la nueva orden'); //log info
            $this->logger->info('Se asoció el ID' . $model->id . ' a la nueva orden'); //log info

            // Order Detail creation
            $this->_orderRepository->addByOrderId($model->id, $model->detail);

            $this->logger->info('Se creo el detalle de la orden'); //log info

            // Commit transaction
            $this->_db->commit();

            $this->logger->info('Finalizó la creación de la orden'); //log info
        } catch (PDOException $ex) {
            $this->_db->rollBack();
            $this->logger->error($ex->getMessage());
            print($ex->getMessage());
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

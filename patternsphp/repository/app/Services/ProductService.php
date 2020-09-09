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
            // Begin transacation
            $this->_db->beginTransaction();

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
            // Begin transacation
            $this->_db->beginTransaction();

            $result = $this->_productRepository->find($id);
        } catch (PDOException $ex) {
            $this->_db->rollBack();
            print $ex->getMessage();
        }

        return $result;
    }

    public function create(Product $model): void
    {
        try {
            // Begin transacation
            $this->_db->beginTransaction();

            $this->_productRepository->add($model);
        } catch (PDOException $ex) {
            $this->_db->rollBack();
            print $ex->getMessage();
        }
    }

    public function update(Product $model): void
    {
        try {
            // Begin transacation
            $this->_db->beginTransaction();

            $this->_productRepository->update($model);
        } catch (PDOException $ex) {
            $this->_db->rollBack();
            print $ex->getMessage();
        }
    }

    public function delete(int $id): void
    {
        try {
            // Begin transacation
            $this->_db->beginTransaction();

            $this->_productRepository->remove($id);
        } catch (PDOException $ex) {
            $this->_db->rollBack();
            print $ex->getMessage();
        }
    }
}

<?php

declare(strict_types=1);

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

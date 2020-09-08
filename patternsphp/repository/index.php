<?php
require_once 'vendor/autoload.php';
require_once 'config.php';

use App\Services\OrderService;
use App\Models\Order;
use App\Models\OrderDetail;

$service = new OrderService;

var_dump($service->get(1));


// CREATE LOGIC
// // Header
// $model = new Order();
// $model->user_id = 1;
// $model->creater_id = 2;

// // Detail
// $detail1 = new OrderDetail;
// $detail1->product_id = 1;
// $detail1->price = 2500;
// $detail1->quantity = 2;

// $detail2 = new OrderDetail;
// $detail2->product_id = 4;
// $detail2->price = 7;
// $detail2->quantity = 3;

// // Attach to order
// $model->detail[] = $detail1;
// $model->detail[] = $detail2;

// $service->create($model);

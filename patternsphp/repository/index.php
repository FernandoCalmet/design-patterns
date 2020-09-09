<?php
require_once 'vendor/autoload.php';
require_once 'config.php';

use Sales\Container;
use App\Services\OrderService;
use App\Models\Order;
use App\Models\OrderDetail;

Container::set('logger', function () {
    $logger = new \Monolog\Logger(__CONFIG__['log']['channel']);
    //Handler para trabajar con archivos de texto
    $file_handler = new \Monolog\Handler\StreamHandler(__CONFIG__['log']['path'] . date('Ymd') . '.log');
    //Agregar Handler
    $logger->pushHandler($file_handler);

    return $logger;
});

// TESTING
/* $logger = Container::get('logger');
$logger->info('Project started'); */

$service = new OrderService;
var_dump($service->get(1));

// CREATE LOGIC
// Header
$model = new Order();
$model->user_id = 1;
$model->creater_id = 2;

// Detail
$detail1 = new OrderDetail;
$detail1->product_id = 1;
$detail1->price = 2500;
$detail1->quantity = 2;

$detail2 = new OrderDetail;
$detail2->product_id = 4;
$detail2->price = 7;
$detail2->quantity = 3;

// Attach to order
$model->detail[] = $detail1;
$model->detail[] = $detail2;

$service->create($model);

<?php

require 'vendor/autoload.php';

use App\Controllers\PurchaseOrderController;

$order = new PurchaseOrderController();
var_dump($order->getFollowingStates("in_transit"));
var_dump($order->getFollowingStates("billed"));
var_dump($order->getFollowingStates("payed"));
var_dump($order->getFollowingStates("certified"));
var_dump($order->getFollowingStates("at_destination"));
var_dump($order->getFollowingStates("cancelled"));

<?php

namespace App\Controllers;

use App\Values\PurchaseOrderStatusValues;

class PurchaseOrderController
{
    public function getFollowingStates(string $state)
    {
        $strategyClass = PurchaseOrderStatusValues::STRATEGY[$state];

        return (new $strategyClass)->getFollowingStates();
    }
}

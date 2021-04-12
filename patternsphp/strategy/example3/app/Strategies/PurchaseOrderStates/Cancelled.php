<?php

namespace App\Strategies\PurchaseOrderStates;

use App\Strategies\PurchaseOrderStatesInterface;

class Cancelled implements PurchaseOrderStatesInterface
{
    public function getFollowingStates()
    {
        return [];
    }
}

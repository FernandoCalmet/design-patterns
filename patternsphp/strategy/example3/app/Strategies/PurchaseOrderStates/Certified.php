<?php

namespace App\Strategies\PurchaseOrderStates;

use App\Strategies\PurchaseOrderStatesInterface;

class Certified implements PurchaseOrderStatesInterface
{
    public function getFollowingStates()
    {
        return ['cancelled', 'billed', 'payed'];
    }
}

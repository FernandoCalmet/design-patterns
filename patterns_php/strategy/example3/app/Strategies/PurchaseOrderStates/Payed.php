<?php

namespace App\Strategies\PurchaseOrderStates;

use App\Strategies\PurchaseOrderStatesInterface;

class Payed implements PurchaseOrderStatesInterface
{
    public function getFollowingStates()
    {
        return ['certified'];
    }
}

<?php

namespace App\Strategies\PurchaseOrderStates;

use App\Strategies\PurchaseOrderStatesInterface;

class Billed implements PurchaseOrderStatesInterface
{
    public function getFollowingStates()
    {
        return ['certified', 'payed'];
    }
}

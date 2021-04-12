<?php

namespace App\Strategies\PurchaseOrderStates;

use App\Strategies\PurchaseOrderStatesInterface;

class InTransit implements PurchaseOrderStatesInterface
{
    public function getFollowingStates()
    {
        return ['cancelled', 'at_destination'];
    }
}

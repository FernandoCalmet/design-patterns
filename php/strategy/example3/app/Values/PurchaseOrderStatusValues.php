<?php

namespace App\Values;

use App\Strategies\PurchaseOrderStates;

final class PurchaseOrderStatusValues
{
    const STRATEGY = [
        'in_transit' => PurchaseOrderStates\InTransit::class,
        'cancelled' => PurchaseOrderStates\Cancelled::class,
        'billed' => PurchaseOrderStates\Billed::class,
        'payed' => PurchaseOrderStates\Payed::class,
        'certified' => PurchaseOrderStates\Certified::class,
        'at_destination' => PurchaseOrderStates\AtDestination::class
    ];
}

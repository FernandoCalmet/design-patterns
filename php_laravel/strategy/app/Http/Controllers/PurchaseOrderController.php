<?php

namespace App\Http\Controllers;

use App\Values\PurchaseOrderStatusValues;
use Illuminate\Http\Request;

class PurchaseOrderController extends Controller
{
    //Implementación sin usar el Patron Strategy
    /*
    public function getFollowingStates(Request $request)
    {
        $state = $request->input('state');

        if ($state == 'in_transit') {
            return ['cancelled', 'at_destination'];
        }

        if ($state == 'at_destination') {
            return ['cancelled', 'certified'];
        }

        if ($state == 'certified') {
            return ['cancelled', 'billed', 'payed'];
        }

        if ($state == 'billed') {
            return ['certified', 'payed'];
        }

        if ($state == 'payed') {
            return ['certified'];
        }

        return [];        
    }
    */

    //Implementación usando el Patron Strategy    
    public function getFollowingStates(Request $request)
    {
        $state = $request->input('state');

        $strategyClass = PurchaseOrderStatusValues::STRATEGY[$state];
        
        return (new $strategyClass)->getFollowingStates();
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Ticket;

class TicketController extends Controller
{
    public function index()
    {
        $tickets = Ticket::get();

        return response()->json($tickets);
    }
}

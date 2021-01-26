<?php

use App\Http\Controllers\TicketController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('users/with-same-first-and-last-name', [UserController::class, 'getWithSameFirstAndLastName']);
Route::apiResource('users', UserController::class);

Route::apiResource('tickets', TicketController::class);

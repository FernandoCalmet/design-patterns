<?php

use App\Http\Controllers\CountryController;
use Illuminate\Support\Facades\Route;

Route::get('/countries', [CountryController::class, 'getCountries']);
Route::get('/country-by-name', [CountryController::class, 'getCountryByName']);
Route::get('/country-by-capital', [CountryController::class, 'getCountryByCapital']);

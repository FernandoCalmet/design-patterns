<?php

namespace App\Adapters;

use App\Contracts\CountriesService;
use Illuminate\Support\Facades\Http;

class RestCountriesAdapter implements CountriesService
{
    private $endpoint;

    public function __construct()
    {
        $this->endpoint = config('services.restcountries.endpoint');
    }

    public function getCountries()
    {
        $response = Http::get("{$this->endpoint}all");

        return $response->json();
    }

    public function getCountryByName(string $name)
    {
        $response = Http::get("{$this->endpoint}name/$name");

        return $response->json();
    }

    public function getCountryByCapital(string $capital)
    {
        $response = Http::get("{$this->endpoint}capital/$capital");

        return $response->json();
    }
}

<?php

namespace App\Contracts;

interface CountriesService
{
    public function getCountries();
    public function getCountryByName(string $name);
    public function getCountryByCapital(string $capital);
}

<?php

namespace App\Http\Controllers;

use App\Contracts\CountriesService;

class CountryController extends Controller
{
    private $restCountriesAdapter;

    public function __construct(CountriesService $countryService)
    {
        $this->restCountriesAdapter = $countryService;
    }

    public function getCountries()
    {
        return $this->restCountriesAdapter->getCountries();
    }

    public function getCountryByName()
    {
        $name = request()->get('name');

        return $this->restCountriesAdapter->getCountryByName($name);
    }

    public function getCountryByCapital()
    {
        $capital = request()->get('capital');

        return $this->restCountriesAdapter->getCountryByCapital($capital);
    }
}

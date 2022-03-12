<?php

namespace App\Providers;

use App\Adapters\RestCountriesAdapter;
use App\Contracts\CountriesService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public $bindings = [
        CountriesService::class => RestCountriesAdapter::class
    ];
    
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}

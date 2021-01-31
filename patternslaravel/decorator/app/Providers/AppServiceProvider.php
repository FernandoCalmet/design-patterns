<?php

namespace App\Providers;

use App\Cache\UserCache;
use App\Contracts\UserRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    protected $bindings = [
        UserRepositoryInterface::class => UserCache::class
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

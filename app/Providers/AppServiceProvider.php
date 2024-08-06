<?php

namespace App\Providers;

use App\Contracts\GoogleMapService as GoogleMapIService;
use App\Services\GoogleMapService;
use GuzzleHttp\Client;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{

    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(GoogleMapIService::class, function ($app) {
            return new GoogleMapService($app->make(Client::class));
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}

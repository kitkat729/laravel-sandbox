<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use GuzzleHttp\Client as GuzzleHttpClient;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
        $this->app->singleton('GuzzleHttpClient', function($app) {
            return new GuzzleHttpClient;
        });
    }
}

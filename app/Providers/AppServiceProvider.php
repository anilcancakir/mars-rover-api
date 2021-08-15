<?php

namespace App\Providers;

use Exception;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
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
     * @throws Exception
     */
    public function boot()
    {
        if (! $this->app->runningInConsole() and ! Redis::connection()->client()->isConnected()) {
            throw new Exception('Redis connection must be available for the Project.');
        }
    }
}

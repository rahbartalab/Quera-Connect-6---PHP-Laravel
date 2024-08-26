<?php

namespace App\Providers;

use App\Auth\OpenUserProvider;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
    }

    public function boot(): void
    {
        Auth::extend('open', function ($app, $name, array $config) {
            $provider = Auth::createUserProvider($config['provider']);
            return new \Illuminate\Auth\SessionGuard($name, $provider, $app['session.store'], $app['request']);
        });

        Auth::provider('open', function (Application $app, array $config) {
            return new OpenUserProvider();
        });
    }
}

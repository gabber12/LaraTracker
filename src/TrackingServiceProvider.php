<?php

namespace Laratracker\Links;

use Illuminate\Support\ServiceProvider;

class TrackingServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot(\Illuminate\Routing\Router $router)
    {
        $this->loadRoutesFrom(__DIR__.'/Routes/web.php');

        $this->publishes([
            __DIR__.'/Config/tracker.php' => config_path('tracker.php'),
        ], 'tracker_config');

        $router->middleware('links.middleware', config('links.middleware'));

        $this->loadViewsFrom(__DIR__.'/Views', 'tracker');

        $this->loadMigrationsFrom(__DIR__.'/Migrations');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/Config/tracker.php', 'tracker');
    }
}

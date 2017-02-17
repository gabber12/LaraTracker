<?php

namespace Laratracker\Links;

use Illuminate\Support\ServiceProvider;

class LinksServiceProvider extends ServiceProvider
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
            __DIR__.'/Config/links.php' => config_path('links.php'),
        ], 'links_config');

        $router->middleware('links.middleware', config('links.middleware'));

        $this->loadViewsFrom(__DIR__.'/Views', 'links');

        $this->loadMigrationsFrom(__DIR__.'/Migrations');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/Config/links.php', 'links');
    }
}

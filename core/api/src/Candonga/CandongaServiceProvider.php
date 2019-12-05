<?php

namespace Candonga;

use Illuminate\Support\ServiceProvider;
use Illuminate\Http\Resources\Json\Resource;
use Candonga\Commands\ProductsPending;

class CandongaServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        Resource::withoutWrapping();

        if ($this->app->runningInConsole()) {
            $this->commands([
                ProductsPending::class,
            ]);
        }

        $this->loadRoutesFrom(__DIR__.'/routes.php');
        $this->loadMigrationsFrom(__DIR__.'/migrations');
        $this->loadViewsFrom(__DIR__.'/views', 'api');
        $this->publishes([
            __DIR__.'/config/publish' => base_path('config'),
            __DIR__.'/views' => base_path('resources/views'),
            __DIR__.'/assets' => public_path('assets'),
        ], 'candonga');
        $this->mergeConfigFrom(__DIR__.'/config/channels.php', 'logging.channels');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {

    }

}

<?php

namespace Candonga;

use Illuminate\Support\ServiceProvider;
use Illuminate\Http\Resources\Json\Resource;

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

        $this->loadRoutesFrom(__DIR__.'/routes.php');
        $this->loadMigrationsFrom(__DIR__.'/migrations');
        $this->loadViewsFrom(__DIR__.'/views', 'api');
        $this->publishes([
            __DIR__.'/config/publish' => base_path('config'),
            __DIR__.'/views' => base_path('resources/views'),
        ]);
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

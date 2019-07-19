<?php

namespace Wjxcodes\Express;

/**
 * laravel集成
 */
class ServiceProvider extends \Illuminate\Support\ServiceProvider
{

    protected $defer = true;

    public function boot()
    {
        $this->publishes([ __DIR__ . '/config' => config_path()],'wjxcodes-express');

        $this->loadMigrationsFrom(__DIR__.'/database/migrations');
        
    }


    public function register()
    {

        $this->app->singleton(Express::class, function () {
            return new Express(config('express.appkey'));
        });

        $this->app->alias(Express::class, 'express');

    }

    public function provides()
    {
        return [Express::class, 'express'];
    }

}

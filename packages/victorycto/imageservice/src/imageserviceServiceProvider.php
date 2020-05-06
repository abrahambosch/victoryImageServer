<?php

namespace victorycto\imageservice;

use Illuminate\Support\ServiceProvider;

class imageserviceServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        // $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'victorycto');
        // $this->loadViewsFrom(__DIR__.'/../resources/views', 'victorycto');
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        // $this->loadRoutesFrom(__DIR__.'/routes.php');

        // Publishing is only necessary when using the CLI.
        if ($this->app->runningInConsole()) {
            $this->bootForConsole();
        }
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/imageservice.php', 'imageservice');

        // Register the service the package provides.
        $this->app->singleton('imageservice', function ($app) {
            return new imageservice;
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['imageservice'];
    }

    /**
     * Console-specific booting.
     *
     * @return void
     */
    protected function bootForConsole()
    {
        // Publishing the configuration file.
        $this->publishes([
            __DIR__.'/../config/imageservice.php' => config_path('imageservice.php'),
        ], 'imageservice.config');

        // Publishing the views.
        /*$this->publishes([
            __DIR__.'/../resources/views' => base_path('resources/views/vendor/victorycto'),
        ], 'imageservice.views');*/

        // Publishing assets.
        /*$this->publishes([
            __DIR__.'/../resources/assets' => public_path('vendor/victorycto'),
        ], 'imageservice.views');*/

        // Publishing the translation files.
        /*$this->publishes([
            __DIR__.'/../resources/lang' => resource_path('lang/vendor/victorycto'),
        ], 'imageservice.views');*/

        // Registering package commands.
        // $this->commands([]);
    }
}

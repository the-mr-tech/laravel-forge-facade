<?php

namespace TheMrTech\LaravelForgeFacade;

use Illuminate\Support\ServiceProvider;

class LaravelForgeFacadeServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        // $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'themrtech');
        // $this->loadViewsFrom(__DIR__.'/../resources/views', 'themrtech');
        // $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
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
        $this->mergeConfigFrom(
            __DIR__ . '/../config/services.php', 'services'
        );

        $this->app->singleton('LaravelForge', function($app) {
            $forgeToken = $app['config']->get('services.laravel-forge.token');
            $app['log']->info('[LaravelForge] Config key: ' . $forgeToken);
            return new ThemsaidForge($forgeToken);
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['LaravelForge'];
    }

    /**
     * Console-specific booting.
     *
     * @return void
     */
    protected function bootForConsole()
    {

    }
}

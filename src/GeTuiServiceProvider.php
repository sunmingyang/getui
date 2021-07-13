<?php

namespace HaiXin\GeTui;

use Illuminate\Foundation\Application;
use Illuminate\Support\ServiceProvider;

class GeTuiServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot(): void
    {
        if ($this->app->runningInConsole()) {
            $this->bootForConsole();
        }
    }
    
    /**
     * Console-specific booting.
     *
     * @return void
     */
    protected function bootForConsole(): void
    {
        // Publishing the configuration file.
        $this->publishes([
            __DIR__.'/../config/getui.php' => config_path('getui.php'),
        ], 'getui.config');
    }
    
    /**
     * Register any package services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__.'/../config/getui.php', 'getui');
        
        // Register the service the package provides.
        $this->app->singleton('getui', function (Application $app) {
            return new GeTui($app['config']->get('getui'));
        });
    }
    
    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['getui'];
    }
}

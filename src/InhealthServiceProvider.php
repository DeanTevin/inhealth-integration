<?php

namespace Deantev\Inhealth\Integration;

use Illuminate\Support\ServiceProvider;

class InhealthServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        // Register any bindings or services here
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        // Publish the configuration file
        $this->publishes([
            __DIR__.'/../config/inhealth.php' => config_path('inhealth.php'),
        ], 'inhealth-config');
    
        $this->mergeConfigFrom(__DIR__.'/../config/inhealth.php', 'inhealth');
    }
}
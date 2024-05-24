<?php

declare(strict_types=1);

namespace Jonaspoelmans\LaravelGpt\Providers;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\ServiceProvider;

final class PackageServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        // Merge package configuration with the application's published configuration
        $this->mergeConfigFrom(
            __DIR__.'/../../config/laravelgpt.php', 'laravelgpt'
        );
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        // Publish configuration file
        $this->publishes([
            __DIR__.'/../../config/laravelgpt.php' => $this->app->configPath('laravelgpt.php'),
        ], 'laravel-gpt-config');
    }
}

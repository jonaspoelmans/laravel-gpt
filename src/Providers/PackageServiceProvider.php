<?php

declare(strict_types=1);

namespace Jonaspoelmans\LaravelGpt\Providers;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\ServiceProvider;

final class PackageServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * This method is used to bind things into the service container.
     * Here, we are merging the package's configuration file with the application's published configuration.
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
     * Bootstrap any application services.
     *
     * This method is called after all other services have been registered.
     * It is used to perform any actions required by your package, such as publishing configuration files.
     *
     * @return void
     */
    public function boot()
    {
        // The publishes method is used to publish package assets, such as configuration files, to the application's own directories.
        $this->publishes([
            __DIR__.'/../../config/laravelgpt.php' => $this->app->configPath('laravelgpt.php'),
        ], 'laravel-gpt-config');
    }
}

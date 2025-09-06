<?php

namespace Imamsudarajat04\LaravelBaseServiceRepo\Providers;

use Illuminate\Support\ServiceProvider;
use Imamsudarajat04\LaravelBaseServiceRepo\Console\Commands\MakeServiceCommand;
use Imamsudarajat04\LaravelBaseServiceRepo\Console\Commands\MakeRepositoryCommand;
use Imamsudarajat04\LaravelBaseServiceRepo\Console\Commands\PublishConfigCommand;
use Imamsudarajat04\LaravelBaseServiceRepo\ServiceRepo;

class LaravelBaseServiceRepoServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // Merge config so that users can still override configuration
        $this->mergeConfigFrom(
            __DIR__ . '/../Config/servicerepo.php',
            'servicerepo'
        );

        // Register package services
        $this->registerServices();
    }

    /**
     * Register package services.
     *
     * @return void
     */
    protected function registerServices()
    {
        // Register ServiceRepo as singleton
        $this->app->singleton('servicerepo', function ($app) {
            return new ServiceRepo($app);
        });

        // Register ServiceRepo alias
        $this->app->alias('servicerepo', ServiceRepo::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Publish configuration with clear tags
        $this->publishes([
            __DIR__ . '/../Config/servicerepo.php' => config_path('servicerepo.php'),
        ], 'servicerepo-config');

        // Register commands only when running in console
        if ($this->app->runningInConsole()) {
            $this->registerCommands();
        }
    }

    /**
     * Register package commands.
     *
     * @return void
     */
    protected function registerCommands()
    {
        $this->commands([
            MakeServiceCommand::class,
            MakeRepositoryCommand::class,
            PublishConfigCommand::class,
        ]);
    }
}

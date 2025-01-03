<?php

namespace Imamsudarajat04\LaravelBaseServiceRepo\Providers;

use Illuminate\Support\ServiceProvider;
use Imamsudarajat04\LaravelBaseServiceRepo\Commands\MakeServiceCommand;
use Imamsudarajat04\LaravelBaseServiceRepo\Commands\MakeRepositoryCommand;

class LaravelBaseServiceRepoServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->publishes([
            __DIR__ . '/../Config/servicerepo.php' => config_path('servicerepo.php'),
        ]);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->mergeConfigFrom(
            __DIR__ . '/../Config/servicerepo.php',
            'servicerepo'
        );

        // Register commands if the package is used in the console
        if ($this->app->runningInConsole()) {
            $this->commands([
                MakeServiceCommand::class,
                MakeRepositoryCommand::class,
            ]);
        }
    }
}
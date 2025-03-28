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
        # Merge config so that users can still override configuration
        $this->mergeConfigFrom(
            __DIR__ . '/../Config/servicerepo.php',
            'servicerepo'
        );
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        # Publish configuration with clear tags
        $this->publishes([
            __DIR__ . '/../Config/servicerepo.php' => config_path('servicerepo.php'),
        ], 'servicerepo-config');

        if ($this->app->runningInConsole()) {
            $this->commands([
                MakeServiceCommand::class,
                MakeRepositoryCommand::class,
            ]);
        }
    }
}

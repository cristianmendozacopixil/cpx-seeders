<?php

namespace CpxProject\Seeders;

use Illuminate\Support\ServiceProvider;
use CpxProject\Seeders\Commands\Migrate;
use CpxProject\Seeders\Commands\MigrateFresh;
use CpxProject\Seeders\Commands\MigrateStatus;
use CpxProject\Seeders\Commands\SeederCreate;
use CpxProject\Seeders\Commands\SeederSeed;
use CpxProject\Seeders\Commands\SeederSeedStatus;

class CpxProjectSeedersServiceProvider extends ServiceProvider
{
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                Migrate::class,
                MigrateFresh::class,
                MigrateStatus::class,
                SeederCreate::class,
                SeederSeed::class,
                SeederSeedStatus::class,
            ]);
            $this->loadMigrationsFrom(__DIR__ . '/migrations');
        }
    }

    public function register()
    {
        //
    }
}

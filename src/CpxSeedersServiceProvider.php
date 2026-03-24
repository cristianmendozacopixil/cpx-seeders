<?php

namespace Cpx\Seeders;

use Illuminate\Support\ServiceProvider;
use Cpx\Seeders\Commands\Migrate;
use Cpx\Seeders\Commands\MigrateFresh;
use Cpx\Seeders\Commands\MigrateStatus;
use Cpx\Seeders\Commands\SeederCreate;
use Cpx\Seeders\Commands\SeederInstall;
use Cpx\Seeders\Commands\SeederSeed;
use Cpx\Seeders\Commands\SeederSeedStatus;

class CpxSeedersServiceProvider extends ServiceProvider
{
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                Migrate::class,
                MigrateFresh::class,
                MigrateStatus::class,
                SeederCreate::class,
                SeederInstall::class,
                SeederSeed::class,
                SeederSeedStatus::class,
            ]);
        }
    }

    public function register()
    {
        //
    }
}

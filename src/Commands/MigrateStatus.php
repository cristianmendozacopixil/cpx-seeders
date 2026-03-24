<?php

namespace Cpx\Seeders\Commands;

use Illuminate\Console\GeneratorCommand;

use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class MigrateStatus extends GeneratorCommand
{
	protected $signature = 'cpx-migrate:status';
	protected $description = 'Show the status of migrations and seeders (php artisan migrate:status && php artisan cpx-seed:status)';

	public function handle()
	{
		$this->info("Migration status:");
		$this->call('migrate:status');
		$this->info("Seeder status:");
		$this->call('cpx-seed:status');
	}

	protected function getStub()
	{
		return "";
	}
}
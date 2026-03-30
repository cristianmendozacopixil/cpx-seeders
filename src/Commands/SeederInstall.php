<?php

namespace CpxProject\Seeders\Commands;

use Illuminate\Console\GeneratorCommand;

use Illuminate\Support\Facades\Schema;

class SeederInstall extends GeneratorCommand
{
	protected $signature = 'cpx-seed:install';
	protected $description = 'Create database table to track seeders';

	public function handle()
	{
		$name = date('Y_m_d_His')."_create_cpx_seeders_table.php";
		$directory = $this->laravel['path.database'].'/migrations/';
		//The function makeDirectory accepts a path with file name to create his directory
		$this->makeDirectory($directory.$name);

		$template = __DIR__.'/../stubs/seeder_install.stub';

		$content = $this->files->get($template);

		$this->files->put($directory.$name, $content);
		$this->info('Seeder table created successfully.');
	}

	protected function getStub()
	{
		return "";
	}
}
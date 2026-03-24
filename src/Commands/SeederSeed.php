<?php

namespace Cpx\Seeders\Commands;

use Illuminate\Console\GeneratorCommand;

use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class SeederSeed extends GeneratorCommand
{
	protected $signature = 'cpx-seed';
	protected $description = 'Run the database seeders.';

	public function handle()
	{
		$fs = new Filesystem();
		$seederFiles = $fs->files(database_path('cpx_seeders'));
		$seeded = DB::table('cpx_seeders')->pluck('name', 'name')->toArray();
		$lastBatch = DB::table('cpx_seeders')->max('batch') ?? 0;

		foreach ($seederFiles as $file) {
			$seederName = pathinfo($file, PATHINFO_FILENAME);
			
			if (isset($seeded[$seederName])) {
				continue;
			}

			// Include the seeder file
			require_once $file->getPathname();

			$fullClass = "\\Database\\CpxSeeders\\".$this->getSeederClassName($seederName);
			$seederInstance = new $fullClass;
			$seederInstance->run();
			
			DB::table('cpx_seeders')->insert([
				'name' => $seederName,
				'batch' => $lastBatch + 1,
				'created_at' => now(),
			]);

				$this->output->writeln("  $seederName ".str_repeat('.', 146 - strlen("$seederName  Done")) ." <options=bold;fg=green>Done</>" );
		}
	}

	private function getSeederClassName($fileName)
	{
		$parts = explode('_', $fileName);
		unset($parts[0], $parts[1], $parts[2], $parts[3]);
		return Str::studly(implode('_', $parts));
	}

	protected function getStub()
	{
		return "";
	}
}
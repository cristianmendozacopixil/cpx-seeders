<?php

namespace Cpx\Seeders\Commands;

use Illuminate\Console\GeneratorCommand;

use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class SeederSeedStatus extends GeneratorCommand
{
	protected $signature = 'cpx-seed:status';
	protected $description = 'Show the status of each seeder';

	public function handle()
	{
		$fs = new Filesystem();
		$seederFiles = $fs->files(database_path('cpx_seeders'));
		$seeded = DB::table('cpx_seeders')->pluck('name', 'name')->toArray();
		$lastBatch = DB::table('cpx_seeders')->max('batch') ?? 0;

		$this->output->writeln("<question> INFO </question> Mostrando listado de seeders" );
		

		$this->output->writeln("  Seeder name ".str_repeat('.', 146 - 20) ." Status" );
		foreach ($seederFiles as $file) {
			$seederName = pathinfo($file, PATHINFO_FILENAME);
			$isSeeded = isset($seeded[$seederName]) ? 'Ran' : 'Pending';
			$strlen = strlen("$seederName  $isSeeded");
			if ($isSeeded === 'Ran') {
				$this->output->writeln("  $seederName ".str_repeat('.', 146 - $strlen) ." <options=bold;fg=green>$isSeeded</>" );
			} else {
				$this->output->writeln("  $seederName ".str_repeat('.', 146 - $strlen) ." <options=bold;fg=yellow>$isSeeded</>" );
			}
		}
	}

	protected function getStub()
	{
		return "";
	}
}
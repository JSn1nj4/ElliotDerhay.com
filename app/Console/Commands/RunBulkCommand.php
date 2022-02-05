<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class RunBulkCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'run:bulk
							{signature* : A list of 1 or more command signatures}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Run any number of artisan commands passed by command signature';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

	/**
	 * Check that all passed commands are registered
	 */
	private function allCommandsExist(): bool
	{
		$missingCommands = array_diff($this->argument('signature'), array_keys(Artisan::all()));

		if(count($missingCommands) > 0) {
			$this->error("Some command signatures are not registered: " . implode(', ', $missingCommands));

			return false;
		}

		return true;
	}

	private function executeAll(): void
	{
		foreach($this->argument('signature') as $command) {
			$this->call($command);
		}
	}

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
		if(!$this->allCommandsExist()) return Command::FAILURE;

		$this->executeAll();

		$this->info("All commands ran successfully");

        return Command::SUCCESS;
    }


}

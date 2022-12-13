<?php

namespace App\Console\Commands;

use App\Events\GithubEventPruneCommandRun;
use App\Models\GithubEvent;
use Illuminate\Console\Command;

class GithubEventPruneCommand extends Command
{
	/**
	 * The name and signature of the console command.
	 *
	 * @var string
	 */
	protected $signature = 'github:event:prune ' .
						   '{--k|keep=10 : The number of events to keep when pruning} ';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Prune GitHub events to keep storage small.';

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
	 * Execute the console command.
	 *
	 * @return int
	 */
	public function handle()
	{
		$keep_count = $this->option('keep');

		$keep_ids = GithubEvent::latest('date')
					->take($keep_count)
					->get()
					->map(fn($item, $key) => $item->id)
					->toArray();

		GithubEvent::whereNotIn('id', $keep_ids)->delete();

		GithubEventPruneCommandRun::dispatch();

		return 0;
	}
}

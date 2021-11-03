<?php

namespace App\Console\Commands;

use App\Models\Tweet;
use Illuminate\Console\Command;

class TweetPruneCommand extends Command
{
	/**
	 * The name and signature of the console command.
	 *
	 * @var string
	 */
	protected $signature = 'tweet:prune ' .
						   '{--k|keep=10 : The number of tweets to retain after pruning} ';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Keep tweet storage to a minimum';

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

		$keep_ids = Tweet::latest('date')
					->take($keep_count)
					->get()
					->map(fn($item, $key) => $item->id)
					->toArray();

		Tweet::whereNotIn('id', $keep_ids)->delete();

		return 0;
	}
}

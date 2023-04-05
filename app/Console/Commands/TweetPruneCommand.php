<?php

namespace App\Console\Commands;

use App\Events\TweetsPrunedEvent;
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
	public function handle(): int
	{
		$keep_count = (int) $this->option('keep');

		if ($keep_count === 0) {
			if (!$this->confirm("You're about to delete all stored tweets. Are you sure?")) {
				TweetsPrunedEvent::dispatch(self::FAILURE, "User aborted deleting all tweets.");

				return self::FAILURE;
			}

			Tweet::truncate();

			TweetsPrunedEvent::dispatch(self::SUCCESS, "All tweets deleted.");

			return self::SUCCESS;
		}

		$keep_ids = Tweet::latest('date')
					->take($keep_count)
					->get()
					->map(fn($item, $key) => $item->id)
					->toArray();

		Tweet::whereNotIn('id', $keep_ids)->delete();

		TweetsPrunedEvent::dispatch(self::SUCCESS, "Tweets pruned down to latest $keep_count.");

		return self::SUCCESS;
	}
}

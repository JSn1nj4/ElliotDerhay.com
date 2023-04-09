<?php

namespace App\Console\Commands;

use App\Events\TweetsPulledEvent;
use App\Features\TwitterFeed;
use App\Models\Tweet;
use App\Services\Twitter\TwitterService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Laravel\Pennant\Feature;

class TweetPullCommand extends Command
{
	/**
	 * The name and signature of the console command.
	 *
	 * @var string
	 */
	protected $signature = 'tweet:pull {--d|debug} {--f|fake}';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Pull tweets from the Twitter API';

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
	public function handle(TwitterService $twitter)
	{
		if (Feature::inactive(TwitterFeed::class)) {
			$this->error("The TwitterFeed feature is currently disabled.");

			TweetsPulledEvent::dispatch(self::FAILURE, "TwitterFeed feature is disabled.");

			return self::FAILURE;
		}

		$user = 'jsn1nj4';

		if($this->option('debug')) /** @noinspection DebugFunctionUsageInspection */
			dd($twitter->getPosts(
				username: $user,
				count: 1
			));

		$newest_id = optional(DB::table('tweets')->latest('date')->first())->id;

		$this->info("Fetching tweets" .
			($newest_id !== null ? " since tweet {$newest_id}" : "") .
			"...");

		// Run the command without actually connecting to the Twitter API
		if(!$this->option('fake')) {
			$tweets = $twitter->getPosts($user, $newest_id);

			$tweets->each(fn ($tweet) => Tweet::fromDTO($tweet));
		}

		$this->info('Tweets fetched');

		TweetsPulledEvent::dispatch(self::SUCCESS);

		return self::SUCCESS;
	}
}

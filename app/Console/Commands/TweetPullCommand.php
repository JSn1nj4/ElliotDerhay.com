<?php

namespace App\Console\Commands;

use App\Events\TweetsPulledEvent;
use App\Models\Tweet;
use App\Services\TwitterService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

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
		$user = 'jsn1nj4';

		if($this->option('debug')) {
			dd($twitter->getPosts(
				username: $user,
				count: 1
			));
		}

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

		TweetsPulledEvent::dispatch();

		return 0;
	}
}

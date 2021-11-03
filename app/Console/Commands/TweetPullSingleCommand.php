<?php

namespace App\Console\Commands;

use App\Http\Clients\TwitterClient;
use Illuminate\Console\Command;

class TweetPullSingleCommand extends Command
{
	/**
	 * The name and signature of the console command.
	 *
	 * @var string
	 */
	protected $signature = 'tweet:pull:single {id} {--d|debug}';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Pull a single tweet from the Twitter API for inspection';

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
		$twitter = new TwitterClient;

		if($this->option('debug')) {
			dd($twitter->getSingleTweet($this->argument('id')));
		}

		return $twitter->getSingleTweet($this->argument('id'));
	}
}

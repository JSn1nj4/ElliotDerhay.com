<?php

namespace App\Console\Commands;

use App\Events\GithubEventsPulledEvent;
use App\Features\GithubFeed;
use App\Models\GithubEvent;
use App\Services\Github\GithubService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use Laravel\Pennant\Feature;

class GithubEventPullCommand extends Command
{
	/**
	 * The name and signature of the console command.
	 *
	 * @var string
	 */
	protected $signature = 'github:event:pull
							{--d|debug : Dump response data or log API errors.}
							{--f|file= : Name of file to store JSON response to. Assumes response is for debugging only, not database storage. Response will also not be dumped to the console.}
							{--c|count=5 : Choose how many events to pull from GitHub API. Only works if --debug is used.}';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Fetch events from GitHub\'s events API.';

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
	 * @param \App\Services\Github\GithubService $github
	 * @return int
	 * @throws \Exception
	 */
	public function handle(GithubService $github): int
	{
		if (Feature::inactive(GithubFeed::class)) {
			$this->error('The GitHub feed feature is currently disabled.');

			GithubEventsPulledEvent::dispatch(self::FAILURE, "GitHub feed feature is disabled.");

			return self::FAILURE;
		}

		$this->info("Fetching GitHub events...");

		$events = $github->getEvents('JSn1nj4', $this->option('count'));

		if($this->option('file')) {
			Storage::disk('debug')->put($this->option('file'), $events->toJson());

			return self::SUCCESS;
		}

		if($this->option('debug')) {
			dd($events);
		}

		$events->each(fn ($event) => GithubEvent::fromDTO($event));

		$this->info('GitHub events fetched');

		GithubEventsPulledEvent::dispatch(self::SUCCESS);

		return self::SUCCESS;
	}
}

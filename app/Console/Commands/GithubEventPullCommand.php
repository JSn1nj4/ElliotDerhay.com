<?php

namespace App\Console\Commands;

use App\Events\GithubEventsPulledEvent;
use App\Models\GithubEvent;
use App\Services\GithubService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

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
	 * @return int
	 */
	public function handle(GithubService $github)
	{
		$this->info("Fetching GitHub events...");

		$events = $github->getEvents('JSn1nj4', $this->option('count'));

		if($this->option('file')) {
			Storage::disk('debug')->put($this->option('file'), $events->toJson());

			return 0;
		}

		if($this->option('debug')) {
			dd($events);
		}

		$events->each(fn ($event) => GithubEvent::fromDTO($event));

		$this->info('GitHub events fetched');

		GithubEventsPulledEvent::dispatch();

		return 0;
	}
}

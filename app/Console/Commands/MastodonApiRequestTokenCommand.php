<?php

namespace App\Console\Commands;

use App\Services\MastodonService;
use Illuminate\Console\Command;

class MastodonApiRequestTokenCommand extends Command
{
	/**
	 * The name and signature of the console command.
	 *
	 * @var string
	 */
	protected $signature = 'app:mastodon:request-token';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Command description';

	/**
	 * Execute the console command.
	 */
	public function handle()
	{
		$service = resolve(MastodonService::class);

		$service->requestToken();
	}
}

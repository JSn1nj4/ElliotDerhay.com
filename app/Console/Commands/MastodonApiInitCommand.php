<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class MastodonApiInitCommand extends Command
{
	/**
	 * The name and signature of the console command.
	 *
	 * @var string
	 */
	protected $signature = 'app:mastodon:oauth-init';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Initialize Mastodon connection based on provided config values';

	/**
	 * Execute the console command.
	 */
	public function handle()
	{
		//
	}
}

/**
 * INIT APPLICATION
 * curl -X POST \
 *    -F 'client_name=<client-name>' \
 *    -F 'redirect_uris=urn:ietf:wg:oauth:2.0:oob' \
 *    -F 'scopes=<scope1> <scope2> <scope3>' \
 *    -F 'website=https://<example.com>' \
 *    https://<domain.name>/api/v1/apps
 */

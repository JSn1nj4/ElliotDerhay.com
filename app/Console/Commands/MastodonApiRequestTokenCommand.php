<?php

namespace App\Console\Commands;

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
		//
	}
}

/**
 * REQUEST TOKEN
 * curl -X POST \
 *    -F 'grant_type=client_credentials' \
 *    -F 'code=<auth-code>' \
 *    -F 'client_id=<client-id>' \
 *    -F 'client_secret=<client-secret>' \
 *    -F 'redirect_uri=urn:ietf:wg:oauth:2.0:oob' \
 *    https://<domain.name>/oauth/token
 *
 * Need to save token (encrypted) and expiration time
 */

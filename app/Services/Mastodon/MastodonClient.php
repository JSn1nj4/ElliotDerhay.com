<?php

namespace App\Services\Mastodon;

use App\DataTransferObjects\MastodonApiCredentials;
use App\Models\Token;

class MastodonClient
{
	public function __construct(
		#[\SensitiveParameter] protected MastodonApiCredentials $credentials,
	) {}

	/**
	 * Reduce cached Rate Limit Remaining count by 1
	 * @return void
	 */
	public function decreaseRemaining(): void {}

	/**
	 * Fetches the current API token.
	 *
	 * If expired, an attempt will be made to renew it. Failure will result in default number of retries and then triggering an administrative notification.
	 * @return \App\Models\Token
	 */
	protected function token(): Token
	{
		$token = Token::mastodon()->first();

		if ($token !== null) return $token;

		return $this->requestToken();
	}

	protected function rateLimited(): bool {}

	protected function requestToken(): Token {}

	/*
	 * @return true
	 * @throws \App\Exceptions\TokenVerificationFailedException
	 */
	protected function verifyToken(): true {}
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

/**
 * REQUEST TOKEN
 * curl -X POST \
 *    -F 'client_id=<client-id>' \
 *    -F 'client_secret=<client-secret>' \
 *    -F 'redirect_uri=urn:ietf:wg:oauth:2.0:oob' \
 *    -F 'grant_type=client_credentials' \
 *    https://<domain.name>/oauth/token
 *
 * Need to save token (encrypted) and expiration time
 */

/**
 * VERIFY CREDENTIALS
 * curl \
 *    -H 'Authorization: Bearer <token>' \
 *    https://<domain.name>/api/v1/apps/verify_credentials
 */

/**
 * RATE LIMITING HEADERS
 * X-RateLimit-Limit: allowed requests per time period
 * X-RateLimit-Remaining: remaining requests in time period
 * X-RateLimit-Reset: timestamp for when limit will be reset
 * if (cache('domain.name.ratelimit.reset') === null) {
 *   try post;
 *   update cache: allowed, remaining, reset;
 *   return;
 * }
 *
 * if (cache('domain.name.ratelimit.remaining') === 0) {
 *   log retrying at X;
 *   schedule retry;
 *   return;
 * }
 *
 * if (cache('domain.name.ratelimit.remaining') === null) {
 *    try post;
 *    if failure:
 *        log cache miss on remaining;
 *        schedule retry;
 *        return;
 * }
 *
 * try post;
 *        get 'reset' value;
 *        update 'remaining', including new reset time in seconds;
 *    if failure:
 *        log cache misses;
 *        if allowed/remaining/reset headers:
 *            cache;
 *            schedule retry at later time;
 *        else:
 *            log unknown failure API failure;
 *            return;
 */

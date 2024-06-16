<?php

namespace App\Services\Mastodon;

use App\DataTransferObjects\MastodonApiCredentials;

class MastodonClient
{
	public function __construct(
		#[\SensitiveParameter] protected MastodonApiCredentials $credentials,
	) {}
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

<?php

namespace App\Services;

use App\Contracts\SocialMediaService;
use App\DataTransferObjects\MastodonApiCredentials;
use App\DataTransferObjects\MastodonTokenRequestCredentials;
use App\DataTransferObjects\OperationResult;
use App\DataTransferObjects\SocialPostDTO;
use App\Exceptions\ApiClientErrorException;
use App\Exceptions\ApiUnauthorizedException;
use App\Exceptions\ApiUnknownErrorException;
use App\Http\Authenticators\MastodonClientCredentialAuthenticator;
use App\Http\Clients\MastodonConnector;
use App\Http\Requests\MastodonTokenRequest;
use App\Models\Token;
use Illuminate\Support\Collection;
use Saloon\Data\MultipartValue;

class MastodonService implements SocialMediaService
{
	public function __construct(
		protected MastodonConnector|null $client = null,
	)
	{
		$this->client ??= resolve(MastodonConnector::class);
	}

	public function requestToken(): void
	{
		$request = new MastodonTokenRequest();

		$request->body()
			// might redirect to a signed URL later for storage / displaying a success page
			->set(new MultipartValue('redirect_uri', 'urn:ietf:wg:oauth:2.0:oob'));

		$response = $this->client
			->authenticate(new MastodonClientCredentialAuthenticator(
				resolve(MastodonApiCredentials::class),
				resolve(MastodonTokenRequestCredentials::class),
			))->send($request);

		if ($response->status() === 400) throw new ApiClientErrorException(
			$response->collect()->get('error_description'),
			$response->status(),
		);

		if ($response->status() === 401) throw new ApiUnauthorizedException(
			$response->collect()->get('error_description'),
			$response->status(),
		);

		// handled unexpected errors
		if ($response->status() !== 200) throw new ApiUnknownErrorException(
			$response->collect()->get('error_description'),
			$response->status(),
		);

		Token::create([
			'service' => 'mastodon',
			'value' => $response->collect()
				->get('access_token'),
		]);
	}

	public function getPosts(string $username, ?string $since = null, bool $reposts = true, ?int $count = null): Collection
	{
		// TODO: Implement getPosts() method.
	}

	public function post(SocialPostDTO $postDTO): OperationResult
	{
		// TODO: Implement post() method.
	}
}

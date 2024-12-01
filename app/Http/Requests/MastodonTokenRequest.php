<?php

namespace App\Http\Requests;

use Saloon\Contracts\Body\HasBody;
use Saloon\Data\MultipartValue;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Traits\Body\HasMultipartBody;

class MastodonTokenRequest extends Request implements HasBody
{
	use HasMultipartBody;

	protected Method $method = Method::POST;

	/**
	 * @return \Saloon\Data\MultipartValue[]
	 */
	protected function defaultBody(): array
	{
		return [
			new MultipartValue('grant_type', 'client_credentials'),
		];
	}

	/**
	 * @inheritDoc
	 */
	public function resolveEndpoint(): string
	{
		return '/oauth/token';
	}
}

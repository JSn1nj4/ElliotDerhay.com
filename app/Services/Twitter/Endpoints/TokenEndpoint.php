<?php

namespace App\Services\Twitter\Endpoints;

use App\Definitions\HttpMethod;
use Exception;

class TokenEndpoint extends BaseEndpoint
{
	protected array $headers = [
		'Authorization' => "",
	];

	protected array $params = [
		'grant_type' => 'client_credentials',
	];

	public function __construct(array $headers, array $params = [])
	{
		$this->endpoint = "oauth2/token";

		$this->method = HttpMethod::POST;

		foreach(array_keys($this->headers) as $key) {
			if(!isset($headers[$key])) {
				throw new Exception("Header '{$key}' is required for endpoint '{$this->base}/{$this->endpoint}'");
			}
		}

		$this->headers = array_merge($this->headers, $headers);

		$this->params = array_merge($this->params, $params);
	}
}

<?php

namespace App\Services\Twitter\Endpoints;

use App\Enums\HttpMethod;

class TokenEndpoint extends BaseEndpoint
{
	protected array $headers = [
		'Authorization' => "",
	];

	protected array $params = [
		'grant_type' => 'client_credentials',
	];

	public function __construct()
	{
		parent::__construct();

		$this->endpoint = "oauth2/token";

		$this->method = HttpMethod::POST;
	}
}

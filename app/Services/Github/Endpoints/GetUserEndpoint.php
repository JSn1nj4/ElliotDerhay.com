<?php

namespace App\Services\Github\Endpoints;

class GetUserEndpoint extends BaseEndpoint
{
	protected array $headers = [
		"Authorization" => '',
		"Accept" => "application/vnd.github.v3+json",
		"User-Agent" =>  "Elliot-Derhay-App",
	];

	protected array $params = [];

	public function __construct()
	{
		parent::__construct();
	}

	public function withUser(string $user): self
	{
		return tap($this, fn () => $this->endpoint = "users/{$user}");
	}
}

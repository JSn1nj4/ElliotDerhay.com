<?php

namespace App\Services\Github\Endpoints;

class ListUserPublicEventsEndpoint extends BaseEndpoint
{
	protected array $headers = [
		"Authorization" => '',
		"Accept" => "application/vnd.github.v3+json",
		"User-Agent" =>  "Elliot-Derhay-App",
	];

	protected array $params = [
		'per_page' => '',
	];

	public function __construct()
	{
		parent::__construct();
	}

	public function withUser(string $user): self
	{
		$this->endpoint = "users/{$user}/events/public";

		return $this;
	}
}

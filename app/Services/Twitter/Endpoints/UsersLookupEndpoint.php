<?php

namespace App\Services\Twitter\Endpoints;

class UsersLookupEndpoint extends BaseEndpoint
{
	protected array $headers = [

	];

	protected array $params = [
		'screen_name' => ''
	];

	public function __construct()
	{
		parent::__construct();

		$this->endpoint = "1.1/users/lookup.json";
	}
}

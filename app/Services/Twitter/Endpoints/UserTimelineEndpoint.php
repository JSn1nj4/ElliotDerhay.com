<?php

namespace App\Services\Twitter\Endpoints;

class UserTimelineEndpoint extends BaseEndpoint
{
	protected array $headers = [
		'Authorization' => '',
	];

	public function __construct()
	{
		parent::__construct();

		$this->endpoint = '1.1/statuses/user_timeline.json';
	}
}

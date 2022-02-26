<?php

namespace App\Services\Twitter\Endpoints;

use App\Services\AbstractEndpoint;

class BaseEndpoint extends AbstractEndpoint
{
	public function __construct()
	{
		$this->base = "https://api.twitter.com";
	}
}

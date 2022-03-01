<?php

namespace App\Services\Github\Endpoints;

use App\Services\AbstractEndpoint;

class BaseEndpoint extends AbstractEndpoint
{
	public function __construct()
	{
		$this->base = "https://api.github.com";
	}
}

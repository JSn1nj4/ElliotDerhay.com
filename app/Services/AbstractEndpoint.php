<?php

namespace App\Services;

use App\Definitions\HttpMethod;

abstract class AbstractEndpoint
{
	protected string $base;
	protected string $endpoint = '';
	protected HttpMethod $method = HttpMethod::GET;
	protected array $headers = [];
	protected array $params = [];

	public function __get($name)
	{
		return $this->{$name};
	}
}
<?php

namespace App\Services\Twitter\Endpoints;

use App\Services\AbstractEndpoint;
use Exception;

class BaseEndpoint extends AbstractEndpoint
{
	public function __construct()
	{
		$this->base = "https://api.twitter.com";
	}

	public function with(array $headers, array $params = []): self
	{
		$this->checkArgs($headers, 'headers');

		$this->checkArgs($params, 'params');

		$this->headers = array_merge($this->headers, $headers);

		$this->params = array_merge($this->params, $params);

		return $this;
	}

	protected function checkArgs(array $args, string $field_name): void
	{
		foreach ($this->$field_name as $key => $value) {
			if (strlen($value) > 0) {
				continue;
			}

			if (!isset($args[$key])) {
				throw new Exception(str($field_name)
					->singular()
					->title() . " '{$key}' is required for endpoint '{$this->url()}'");
			}
		}
	}
}

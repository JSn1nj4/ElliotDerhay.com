<?php

namespace App\Services;

use App\Enums\HttpMethod;
use Exception;

abstract class AbstractEndpoint
{
	protected string $base;
	protected string $endpoint;
	protected HttpMethod $method = HttpMethod::Get;
	protected array $headers = [];
	protected array $params = [];

	public function __get($name)
	{
		return $this->$name;
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

	public static function make(): static
	{
		return new static();
	}

	public function url(): string
	{
		return "{$this->base}/{$this->endpoint}";
	}

	public function with(array $headers, array $params = []): self
	{
		$this->checkArgs($headers, 'headers');

		$this->checkArgs($params, 'params');

		$this->headers = array_merge($this->headers, $headers);

		$this->params = array_merge($this->params, $params);

		return $this;
	}
}

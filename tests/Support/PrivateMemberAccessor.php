<?php

namespace Tests\Support;

use ReflectionObject;

class PrivateMemberAccessor
{
	private object $object;

	private ReflectionObject $reflector;

	public function __construct()
	{
		// ...
	}

	public function from(object $object): self
	{
		$this->object = $object;

		$this->reflector = new ReflectionObject($this->object);

		return $this;
	}

	public function getProperty(string $propertyName): mixed
	{
		$property = $this->reflector->getProperty($propertyName);
		$property->setAccessible(true);

		return $property->getValue($this->object);
	}

	public function callMethod(string $methodName, ...$args): mixed
	{
		$method = $this->reflector->getMethod($methodName);
		$method->setAccessible(true);

		return $method->invoke($this->object, ...$args);
	}

	public static function make(): self
	{
		return new self;
	}
}

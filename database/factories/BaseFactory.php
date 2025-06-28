<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Model;

abstract class BaseFactory extends Factory
{
	/**
	 * @var array<callable>
	 */
	protected array $steps = [];

	#[\Override]
	public function create($attributes = [], ?Model $parent = null)
	{
		return $this->process(parent::create($attributes, $parent));
	}

	#[\Override]
	public function createOne($attributes = [])
	{
		return $this->process(parent::createOne($attributes));
	}

	#[\Override]
	public function createOneQuietly($attributes = [])
	{
		return $this->process(parent::createOneQuietly($attributes));
	}

	#[\Override]
	public function make($attributes = [], ?Model $parent = null)
	{
		return $this->process(parent::make($attributes, $parent));
	}

	#[\Override]
	public function makeOne($attributes = [])
	{
		return $this->process(parent::makeOne($attributes));
	}

	private function process(Collection|Model $input): Collection|Model
	{
		if (count($this->steps) < 1) return $input;

		$result = Collection::wrap($input)
			->transform(function (Model $item): Model {
				return array_reduce($this->steps, function (Model $item, callable $step) {
					return $step($item);
				}, $item);
			});

		return ($result->count() === 1) ? $result->first() : $result;
	}
}

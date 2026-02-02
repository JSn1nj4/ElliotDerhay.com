<?php

namespace App\Models\Scopes;

use App\Enums\PostStatus;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class PostPublishedScope implements Scope
{
	/**
	 * Apply the scope to a given Eloquent query builder.
	 */
	public function apply(Builder $builder, Model $model): void
	{
		$builder->where('status', PostStatus::Published->value)
			->where('published_at', '<>', null)
			->where('published_at', '<', now());  //
	}
}

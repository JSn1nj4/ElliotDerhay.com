<?php

namespace App\Models\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class WithCount implements Scope
{
	public function __construct(
		protected array $relations,
	) {}

	/**
	 * Apply the scope to a given Eloquent query builder.
	 * @param \Illuminate\Database\Eloquent\Builder $builder
	 * @param \Illuminate\Database\Eloquent\Model $model
	 * @return void
	 */
    public function apply(Builder $builder, Model $model)
    {
        $builder->withCount($this->relations);
    }
}

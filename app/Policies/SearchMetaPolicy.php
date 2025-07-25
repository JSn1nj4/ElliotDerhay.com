<?php

namespace App\Policies;

use App\Models\SearchMeta;
use App\Models\User;

class SearchMetaPolicy
{
	/**
	 * Determine whether the user can view any models.
	 */
	public function viewAny(User $user): bool
	{
		return true;
	}

	/**
	 * Determine whether the user can view the model.
	 */
	public function view(User $user, SearchMeta $searchMeta): bool
	{
		return $searchMeta->exists;
	}

	/**
	 * Determine whether the user can create models.
	 */
	public function create(User $user): bool
	{
		return $user->exists;
	}

	/**
	 * Determine whether the user can update the model.
	 */
	public function update(User $user, SearchMeta $searchMeta): bool
	{
		return $user->exists && $searchMeta->exists;
	}

	/**
	 * Determine whether the user can delete the model.
	 */
	public function delete(User $user, SearchMeta $searchMeta): bool
	{
		return $user->exists && $searchMeta->exists;
	}

	/**
	 * Determine whether the user can restore the model.
	 */
	public function restore(User $user, SearchMeta $searchMeta): bool
	{
		return $user->exists && $searchMeta->exists;
	}

	/**
	 * Determine whether the user can permanently delete the model.
	 */
	public function forceDelete(User $user, SearchMeta $searchMeta): bool
	{
		return $user->exists && $searchMeta->exists;
	}
}

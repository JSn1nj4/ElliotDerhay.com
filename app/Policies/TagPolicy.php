<?php

namespace App\Policies;

use App\Models\Tag;
use App\Models\User;

class TagPolicy
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
	public function view(User $user, Tag $tag): bool
	{
		return $tag->exists;
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
	public function update(User $user, Tag $tag): bool
	{
		return $user->exists && $tag->exists;
	}

	/**
	 * Determine whether the user can delete the model.
	 */
	public function delete(User $user, Tag $tag): bool
	{
		return $user->exists && $tag->exists;
	}

	/**
	 * Determine whether the user can restore the model.
	 */
	public function restore(User $user, Tag $tag): bool
	{
		return $user->exists && $tag->exists;
	}

	/**
	 * Determine whether the user can permanently delete the model.
	 */
	public function forceDelete(User $user, Tag $tag): bool
	{
		return $user->exists && $tag->exists;
	}
}

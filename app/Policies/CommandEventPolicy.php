<?php

namespace App\Policies;

use App\Models\CommandEvent;
use App\Models\User;

class CommandEventPolicy
{
	/**
	 * Determine whether the user can view any models.
	 */
	public function viewAny(User $user): bool
	{
		return $user->exists;
	}

	/**
	 * Determine whether the user can view the model.
	 */
	public function view(User $user, CommandEvent $commandEvent): bool
	{
		// return $user->exists && $commandEvent->exists;
		return false;
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
	public function update(User $user, CommandEvent $commandEvent): bool
	{
		// return $user->exists && $commandEvent->exists;
		return false;
	}

	/**
	 * Determine whether the user can delete the model.
	 */
	public function delete(User $user, CommandEvent $commandEvent): bool
	{
		// return $user->exists && $commandEvent->exists;
		return false;
	}

	/**
	 * Determine whether the user can restore the model.
	 */
	public function restore(User $user, CommandEvent $commandEvent): bool
	{
		// return $user->exists && $commandEvent->exists;
		return false;
	}

	/**
	 * Determine whether the user can permanently delete the model.
	 */
	public function forceDelete(User $user, CommandEvent $commandEvent): bool
	{
		return $user->exists && $commandEvent->exists;
	}
}

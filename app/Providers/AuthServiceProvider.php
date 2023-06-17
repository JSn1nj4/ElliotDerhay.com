<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
	/**
	 * The policy mappings for the application.
	 *
	 * @var array
	 */
	protected $policies = [
		// 'App\Models\Model' => 'App\Policies\ModelPolicy',
	];

	/**
	 * Register any authentication / authorization services.
	 *
	 * @return void
	 */
	public function boot(): void
	{
		Gate::define('admin', function (User $user) {
			return User::whereId(\Auth::id())->exists();
		})->define('upload-files', function (User $user) {
			return User::whereId(\Auth::id())->exists();
		})->define('save-category', function (User $user) {
			return User::whereId(\Auth::id())->exists();
		});
	}
}

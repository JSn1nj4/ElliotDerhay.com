<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Command;
use App\Models\CommandEvent;
use App\Models\Image;
use App\Models\Post;
use App\Models\Project;
use App\Models\SearchMeta;
use App\Models\Tag;
use App\Models\User;
use App\Policies\CategoryPolicy;
use App\Policies\CommandEventPolicy;
use App\Policies\CommandPolicy;
use App\Policies\ImagePolicy;
use App\Policies\PostPolicy;
use App\Policies\ProjectPolicy;
use App\Policies\SearchMetaPolicy;
use App\Policies\TagPolicy;
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
		Category::class => CategoryPolicy::class,
		CommandEvent::class => CommandEventPolicy::class,
		Command::class => CommandPolicy::class,
		Image::class => ImagePolicy::class,
		Post::class => PostPolicy::class,
		Project::class => ProjectPolicy::class,
		SearchMeta::class => SearchMetaPolicy::class,
		Tag::class => TagPolicy::class,
	];

	/**
	 * Register any authentication / authorization services.
	 *
	 * @return void
	 */
	public function boot(): void
	{
		// ...
	}
}

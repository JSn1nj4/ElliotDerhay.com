<?php

/*
|--------------------------------------------------------------------------
| Test Case
|--------------------------------------------------------------------------
|
| The closure you provide to your test functions is always bound to a specific PHPUnit test
| case class. By default, that class is "PHPUnit\Framework\TestCase". Of course, you may
| need to change it using the "uses()" function to bind a different classes or traits.
|
*/

use App\Actions\HashPassword;
use App\Models\Image;
use App\Models\Post;
use App\Models\Project;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Livewire\Volt\Volt;
use Pest\Expectation;

pest()
	->extend(Tests\TestCase::class)
	->use(RefreshDatabase::class)
	->in('Feature');

/*
|--------------------------------------------------------------------------
| Expectations
|--------------------------------------------------------------------------
|
| When you're writing tests, you often need to check that values meet certain conditions. The
| "expect()" function gives you access to a set of "expectations" methods that you can use
| to assert different things. Of course, you may extend the Expectation API at any time.
|
*/

expect()->extend('toBeOne', function () {
	return $this->toBe(1);
});

/*
|--------------------------------------------------------------------------
| Functions
|--------------------------------------------------------------------------
|
| While Pest is very powerful out-of-the-box, you may have some testing code specific to your
| project that you don't want to repeat in every file. Here you can also expose helpers as
| global functions to help you to reduce the number of lines of code in your test files.
|
*/

function expectPostPublished(Post $post): Expectation
{
	return expect($post->published)
		->toBeTrue('Testing "published" field')
		->and($post->published_at)
		->toBeInstanceOf(Carbon::class, 'Testing "published_at" field');
}

function expectPostNotPublished(Post $post): Expectation
{
	return expect($post->published)
		->toBeIn([null, false], 'Testing "published" field')
		->and($post->published_at)
		->toBeNull('Testing "published_at" field');
}

function createImage(): Image
{
	return Image::factory()->createOne();
}

function createPost(bool|null $publish = null): Post|null
{
	return createPosts(1, $publish)->first();
}

function createPosts(int $count = 1, bool|null $publish = null): Collection|null
{
	$factory = Post::factory()->count($count);

	if ($publish) return $factory->published()->create();

	return $factory->create();
}


function createProject(): Project
{
	return Project::factory()->createOne();
}

function createUser(): User
{
	return User::factory()->createOne();
}

function hashPassword(#[SensitiveParameter] string $password): string
{
	$hashPassword = new HashPassword();

	return $hashPassword($password);
}

function invoke(string $className, array $params): mixed
{
	$class = resolve($className);

	return $class(...$params);
}

function makeImage(): Image
{
	return Image::factory()->makeOne();
}

function makePost(): Post
{
	return Post::factory()->makeOne();
}

function makeProject(): Project
{
	return Project::factory()->makeOne();
}

function makeUser(): User
{
	return User::factory()->makeOne();
}

// borrowed from Ryan Chandler:
// https://x.com/ryangjchandler/status/1808796458260341189
function livewireMountable(string $class, Closure|null $params = null): void
{
	it('can be mounted', function () use ($class, $params) {
		Livewire::test($class, is_callable($params) ? $params() : [])->assertOk();
	});
}

function voltMountable(string $component, Closure|null $params = null): void
{
	it('can be mounted', function () use ($component, $params) {
		Volt::test($component, is_callable($params) ? $params() : [])->assertOk();
	});
}

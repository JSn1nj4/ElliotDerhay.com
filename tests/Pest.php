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

use App\Models\Image;
use App\Models\Post;
use App\Models\Project;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

uses(TestCase::class, RefreshDatabase::class)
	->in('Unit');

uses(TestCase::class, RefreshDatabase::class)
	->beforeEach(fn () => Storage::fake())
	->in('Feature');

/*
|--------------------------------------------------------------------------
| Assertions
|--------------------------------------------------------------------------
*/

/**
 * Assert that a condition is false.
 * @param $condition
 * @param string $message
 * @return void
 */
function assertFalse($condition, string $message = ''): void
{
	\PHPUnit\Framework\assertFalse($condition, $message);
}

/**
 * Assert that a condition is true.
 * @param $condition
 * @param string $message
 * @return void
 */
function assertTrue($condition, string $message = ''): void
{
	\PHPUnit\Framework\assertTrue($condition, $message);
}

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

function createImage(): Image
{
	return Image::factory()->createOne();
}

function createPost(): Post
{
	return Post::factory()->createOne();
}

function createProject(): Project
{
	return Project::factory()->createOne();
}

function createUser(): User
{
	return User::factory()->createOne();
}

function hashPassword(string $password): string
{
	$hashPassword = new \App\Actions\HashPassword();

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

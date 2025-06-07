<?php

use App\Models\SearchMeta;
use App\Policies\SearchMetaPolicy;

function createSearchMeta(): SearchMeta
{
	return SearchMeta::create([
		'search_displayable_id' => fake()->randomNumber(),
		'search_displayable_type' => \App\Models\Post::class,
		'search_title' => fake()->sentence(),
		'search_description' => fake()->paragraph(),
	]);
}

it('allows listing for any user', function () {
	expect(new SearchMetaPolicy())
		->viewAny(makeUser())
		->toBeTrue()
		->viewAny(createUser())
		->toBeTrue();
});

it('allows viewing for any user', function () {
	$meta = createSearchMeta();

	expect(new SearchMetaPolicy())
		->view(makeUser(), $meta)
		->toBeTrue()
		->view(createUser(), $meta)
		->toBeTrue();
});

it('does not allow creating for anonymous users', function () {
	expect(new SearchMetaPolicy())
		->create(makeUser())
		->toBeFalse();
});

it('allows creating for a logged-in user', function () {
	expect(new SearchMetaPolicy())
		->create(createUser())
		->toBeTrue();
});

it('does not allow updating for anonymous users', function () {
	expect(new SearchMetaPolicy())
		->update(makeUser(), createSearchMeta())
		->toBeFalse();
});

it('allows updating for a logged-in user', function () {
	expect(new SearchMetaPolicy())
		->update(createUser(), createSearchMeta())
		->toBeTrue();
});

it('does not allow deleting for anonymous users', function () {
	expect(new SearchMetaPolicy())
		->delete(makeUser(), createSearchMeta())
		->toBeFalse();
});

it('allows deleting for a logged-in user', function () {
	expect(new SearchMetaPolicy())
		->delete(createUser(), createSearchMeta())
		->toBeTrue();
});

it('does not allow restoring for anonymous users', function () {
	expect(new SearchMetaPolicy())
		->restore(makeUser(), createSearchMeta())
		->toBeFalse();
});

it('allows restoring for a logged-in user', function () {
	expect(new SearchMetaPolicy())
		->restore(createUser(), createSearchMeta())
		->toBeTrue();
});

it('does not allow force-deleting for anonymous users', function () {
	expect(new SearchMetaPolicy())
		->forceDelete(makeUser(), createSearchMeta())
		->toBeFalse();
});

it('allows force-deleting for a logged-in user', function () {
	expect(new SearchMetaPolicy())
		->forceDelete(createUser(), createSearchMeta())
		->toBeTrue();
});

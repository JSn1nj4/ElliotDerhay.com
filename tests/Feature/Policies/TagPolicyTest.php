<?php

use App\Models\Tag;
use App\Policies\TagPolicy;

function createTag(): Tag
{
	return Tag::factory()->createOne();
}

it('allows listing for any user', function () {
	expect(new TagPolicy())
		->viewAny(makeUser())
		->toBeTrue()
		->viewAny(createUser())
		->toBeTrue();
});

it('allows viewing for any user', function () {
	$tag = createTag();

	expect(new TagPolicy())
		->view(makeUser(), $tag)
		->toBeTrue()
		->view(createUser(), $tag)
		->toBeTrue();
});

it('does not allow creating for anonymous users', function () {
	expect(new TagPolicy())
		->create(makeUser())
		->toBeFalse();
});

it('allows creating for a logged-in user', function () {
	expect(new TagPolicy())
		->create(createUser())
		->toBeTrue();
});

it('does not allow updating for anonymous users', function () {
	expect(new TagPolicy())
		->update(makeUser(), createTag())
		->toBeFalse();
});

it('allows updating for a logged-in user', function () {
	expect(new TagPolicy())
		->update(createUser(), createTag())
		->toBeTrue();
});

it('does not allow deleting for anonymous users', function () {
	expect(new TagPolicy())
		->delete(makeUser(), createTag())
		->toBeFalse();
});

it('allows deleting for a logged-in user', function () {
	expect(new TagPolicy())
		->delete(createUser(), createTag())
		->toBeTrue();
});

it('does not allow restoring for anonymous users', function () {
	expect(new TagPolicy())
		->restore(makeUser(), createTag())
		->toBeFalse();
});

it('allows restoring for a logged-in user', function () {
	expect(new TagPolicy())
		->restore(createUser(), createTag())
		->toBeTrue();
});

it('does not allow force-deleting for anonymous users', function () {
	expect(new TagPolicy())
		->forceDelete(makeUser(), createTag())
		->toBeFalse();
});

it('allows force-deleting for a logged-in user', function () {
	expect(new TagPolicy())
		->forceDelete(createUser(), createTag())
		->toBeTrue();
});

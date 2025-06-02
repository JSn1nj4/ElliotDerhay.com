<?php

use App\Policies\PostPolicy;

it('allows listing for any user', function () {
	expect(new PostPolicy())
		->viewAny(makeUser())
		->toBeTrue();
});

it('allows viewing for any user if published', function () {
	$post = createPost(true);

	expect(new PostPolicy())
		->view(makeUser(), createPost(true))
		->toBeTrue()
		->view(createUser(), $post)
		->toBeTrue();

	/** @note: the opposite is not tested because unpublished posts are filtered out with a global scope. */
});

it('does not allow creating for anonymous users', function () {
	expect(new PostPolicy())
		->create(makeUser())
		->toBeFalse();
});

it('allows creating for a logged-in user', function () {
	expect(new PostPolicy())
		->create(createUser())
		->toBeTrue();
});

it('does not allow updating for anonymous users', function () {
	expect(new PostPolicy())
		->update(makeUser(), createPost())
		->toBeFalse();
});

it('allows updating for a logged-in user', function () {
	expect(new PostPolicy())
		->update(createUser(), createPost())
		->toBeTrue();
});

it('does not allow deleting for anonymous users', function () {
	expect(new PostPolicy())
		->delete(makeUser(), createPost())
		->toBeFalse();
});

it('allows deleting for a logged-in user', function () {
	expect(new PostPolicy())
		->delete(createUser(), createPost())
		->toBeTrue();
});

it('does not allow restoring for anonymous users', function () {
	expect(new PostPolicy())
		->restore(makeUser(), createPost())
		->toBeFalse();
});

it('allows restoring for a logged-in user', function () {
	expect(new PostPolicy())
		->restore(createUser(), createPost())
		->toBeTrue();
});

it('does not allow force-deleting for anonymous users', function () {
	expect(new PostPolicy())
		->forceDelete(makeUser(), createPost())
		->toBeFalse();
});

it('allows force-deleting for a logged-in user', function () {
	expect(new PostPolicy())
		->forceDelete(createUser(), createPost())
		->toBeTrue();
});

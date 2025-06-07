<?php

use App\Policies\ProjectPolicy;

it('allows listing for any user', function () {
	expect(new ProjectPolicy())
		->viewAny(makeUser())
		->toBeTrue()
		->viewAny(createUser())
		->toBeTrue();
});

it('allows viewing for any user', function () {
	$project = createProject();

	expect(new ProjectPolicy())
		->view(makeUser(), $project)
		->toBeTrue()
		->view(createUser(), $project)
		->toBeTrue();
});

it('does not allow creating for anonymous users', function () {
	expect(new ProjectPolicy())
		->create(makeUser())
		->toBeFalse();
});

it('allows creating for a logged-in user', function () {
	expect(new ProjectPolicy())
		->create(createUser())
		->toBeTrue();
});

it('does not allow updating for anonymous users', function () {
	expect(new ProjectPolicy())
		->update(makeUser(), createProject())
		->toBeFalse();
});

it('allows updating for a logged-in user', function () {
	expect(new ProjectPolicy())
		->update(createUser(), createProject())
		->toBeTrue();
});

it('does not allow deleting for anonymous users', function () {
	expect(new ProjectPolicy())
		->delete(makeUser(), createProject())
		->toBeFalse();
});

it('allows deleting for a logged-in user', function () {
	expect(new ProjectPolicy())
		->delete(createUser(), createProject())
		->toBeTrue();
});

it('does not allow restoring for anonymous users', function () {
	expect(new ProjectPolicy())
		->restore(makeUser(), createProject())
		->toBeFalse();
});

it('allows restoring for a logged-in user', function () {
	expect(new ProjectPolicy())
		->restore(createUser(), createProject())
		->toBeTrue();
});

it('does not allow force-deleting for anonymous users', function () {
	expect(new ProjectPolicy())
		->forceDelete(makeUser(), createProject())
		->toBeFalse();
});

it('allows force-deleting for a logged-in user', function () {
	expect(new ProjectPolicy())
		->forceDelete(createUser(), createProject())
		->toBeTrue();
});

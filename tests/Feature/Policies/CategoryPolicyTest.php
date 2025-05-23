<?php

use App\Models\Category;
use App\Policies\CategoryPolicy;

it('can be listed by anonymous users', function () {
	expect(new CategoryPolicy())
		->viewAny(makeUser())
		->toBeTrue();
});

it('can be listed by logged-in users', function () {
	expect(new CategoryPolicy())
		->viewAny(createUser())
		->toBeTrue();
});

it('can be viewed by an anonymous user', function () {
	expect(new CategoryPolicy())
		->view(makeUser(), Category::factory()->createOne())
		->toBeTrue();
});

it('can be viewed by a logged-in user', function () {
	expect(new CategoryPolicy())
		->view(createUser(), Category::factory()->createOne())
		->toBeTrue();
});

it('cannot be created by an anonymous user', function () {
	expect(new CategoryPolicy())
		->create(makeUser())
		->toBeFalse();
});

it('can be created by a logged-in user', function () {
	expect(new CategoryPolicy())
		->create(createUser())
		->toBeTrue();
});

it('cannot be updated by an anonymous user', function () {
	expect(new CategoryPolicy())
		->update(makeUser(), Category::factory()->createOne())
		->toBeFalse();
});

it('can be updated by a logged-in user', function () {
	expect(new CategoryPolicy())
		->update(createUser(), Category::factory()->createOne())
		->toBeTrue();
});

it('cannot be deleted by an anonymous user', function () {
	expect(new CategoryPolicy())
		->delete(makeUser(), Category::factory()->createOne())
		->toBeFalse();
});

it('can be deleted by a logged-in user', function () {
	expect(new CategoryPolicy())
		->delete(createUser(), Category::factory()->createOne())
		->toBeTrue();
});
// restore

it('cannot be restored by an anonymous user', function () {
	expect(new CategoryPolicy())
		->restore(makeUser(), Category::factory()->createOne())
		->toBeFalse();
});

it('can be restored by a logged-in user', function () {
	expect(new CategoryPolicy())
		->restore(createUser(), Category::factory()->createOne())
		->toBeTrue();
});
// force-delete
it('cannot be force-deleted by an anonymous user', function () {
	expect(new CategoryPolicy())
		->forceDelete(makeUser(), Category::factory()->createOne())
		->toBeFalse();
});

it('can be force-deleted by a logged-in user', function () {
	expect(new CategoryPolicy())
		->forceDelete(createUser(), Category::factory()->createOne())
		->toBeTrue();
});

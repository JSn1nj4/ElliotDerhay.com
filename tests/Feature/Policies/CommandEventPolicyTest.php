<?php

use App\Models\Command;
use App\Models\CommandEvent;
use App\Policies\CommandEventPolicy;

it('cannot be listed by anonymous users', function () {
	expect(new CommandEventPolicy())
		->viewAny(makeUser())
		->toBeFalse();
});

it('can be listed by logged-in users', function () {
	expect(new CommandEventPolicy())
		->viewAny(createUser())
		->toBeTrue();
});

it('cannot be viewed by an anonymous user', function () {
	Command::create([
		'signature' => 'github:event:prune',
		'description' => '',
	]);

	expect(new CommandEventPolicy())
		->view(makeUser(), CommandEvent::factory()->createOne())
		->toBeFalse();
});

it('can be viewed by a logged-in user', function () {
	Command::create([
		'signature' => 'github:event:prune',
		'description' => '',
	]);

	expect(new CommandEventPolicy())
		->view(createUser(), CommandEvent::factory()->createOne())
		->toBeTrue();
});

it('cannot be created by an anonymous user', function () {
	expect(new CommandEventPolicy())
		->create(makeUser())
		->toBeFalse();
});

it('can be created by a logged-in user', function () {
	expect(new CommandEventPolicy())
		->create(createUser())
		->toBeTrue();
});

it('cannot be updated by any user', function () {
	Command::create([
		'signature' => 'github:event:prune',
		'description' => '',
	]);

	expect(new CommandEventPolicy())
		->update(makeUser(), CommandEvent::factory()->createOne())
		->toBeFalse()
		->update(createUser(), CommandEvent::factory()->createOne())
		->toBeFalse();
});

it('cannot be deleted by any user', function () {
	Command::create([
		'signature' => 'github:event:prune',
		'description' => '',
	]);

	expect(new CommandEventPolicy())
		->delete(makeUser(), CommandEvent::factory()->createOne())
		->toBeFalse()
		->delete(createUser(), CommandEvent::factory()->createOne())
		->toBeFalse();
});

it('cannot be restored by any user', function () {
	Command::create([
		'signature' => 'github:event:prune',
		'description' => '',
	]);

	expect(new CommandEventPolicy())
		->restore(makeUser(), CommandEvent::factory()->createOne())
		->toBeFalse()
		->restore(createUser(), CommandEvent::factory()->createOne())
		->toBeFalse();
});

it('cannot be force-deleted by any user', function () {
	Command::create([
		'signature' => 'github:event:prune',
		'description' => '',
	]);

	expect(new CommandEventPolicy())
		->forceDelete(makeUser(), CommandEvent::factory()->createOne())
		->toBeFalse()
		->forceDelete(createUser(), CommandEvent::factory()->createOne())
		->toBeFalse();
});

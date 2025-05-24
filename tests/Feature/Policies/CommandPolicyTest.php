<?php


use App\Models\Command;
use App\Policies\CommandPolicy;

it('cannot be listed by anonymous users', function () {
	expect(new CommandPolicy())
		->viewAny(makeUser())
		->toBeFalse();
});

it('can be listed by logged-in users', function () {
	expect(new CommandPolicy())
		->viewAny(createUser())
		->toBeTrue();
});

it('cannot be viewed by an anonymous user', function () {
	expect(new CommandPolicy())
		->view(makeUser(), Command::create([
			'signature' => 'github:event:prune',
			'description' => '',
		]))
		->toBeFalse();
});

it('can be viewed by a logged-in user', function () {
	expect(new CommandPolicy())
		->view(createUser(), Command::create([
			'signature' => 'github:event:prune',
			'description' => '',
		]))
		->toBeTrue();
});

it('cannot be created by an anonymous user', function () {
	expect(new CommandPolicy())
		->create(makeUser())
		->toBeFalse();
});

it('can be created by a logged-in user', function () {
	expect(new CommandPolicy())
		->create(createUser())
		->toBeTrue();
});

it('cannot be updated by an anonymous user', function () {
	expect(new CommandPolicy())
		->update(makeUser(), Command::create([
			'signature' => 'github:event:prune',
			'description' => '',
		]))
		->toBeFalse();
});

it('can be updated by a logged-in user', function () {
	expect(new CommandPolicy())
		->update(createUser(), Command::create([
			'signature' => 'github:event:prune',
			'description' => '',
		]))
		->toBeTrue();
});

it('cannot be deleted by an anonymous user', function () {
	expect(new CommandPolicy())
		->delete(makeUser(), Command::create([
			'signature' => 'github:event:prune',
			'description' => '',
		]))
		->toBeFalse();
});

it('can be deleted by a logged-in user', function () {
	expect(new CommandPolicy())
		->delete(createUser(), Command::create([
			'signature' => 'github:event:prune',
			'description' => '',
		]))
		->toBeTrue();
});

it('cannot be restored by an anonymous user', function () {
	expect(new CommandPolicy())
		->restore(makeUser(), Command::create([
			'signature' => 'github:event:prune',
			'description' => '',
		]))
		->toBeFalse();
});

it('can be restored by a logged-in user', function () {
	expect(new CommandPolicy())
		->restore(createUser(), Command::create([
			'signature' => 'github:event:prune',
			'description' => '',
		]))
		->toBeTrue();
});

it('cannot be force-deleted by an anonymous user', function () {
	expect(new CommandPolicy())
		->forceDelete(makeUser(), Command::create([
			'signature' => 'github:event:prune',
			'description' => '',
		]))
		->toBeFalse();
});

it('can be force-deleted by a logged-in user', function () {
	expect(new CommandPolicy())
		->forceDelete(createUser(), Command::create([
			'signature' => 'github:event:prune',
			'description' => '',
		]))
		->toBeTrue();
});

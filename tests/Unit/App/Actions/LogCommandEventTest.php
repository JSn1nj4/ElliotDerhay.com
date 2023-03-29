<?php

use App\Actions\LogCommandEvent;
use App\Models\Command;
use App\Models\CommandEvent;

it('throws an integrity constraint violation if trying to log an event for a command that does not exist', function () {
	$logCommandEvent = resolve(LogCommandEvent::class);

	$logCommandEvent(Command::make([
		'signature' => 'sig:test',
		'description' => 'lorem',
	]), true, 'command run');
})->throws('Integrity constraint violation');

it('logs an event for a given command', function () {
	$command = Command::create([
		'signature' => 'sig:test',
		'description' => 'lorem',
	]);
	$command->loadCount('events');

	$events = CommandEvent::all();

	expect($command->events_count)
		->toEqual(0)
		->and($events->count())
		->toEqual(0);

	$logCommandEvent = resolve(LogCommandEvent::class);

	$logCommandEvent($command, true, 'command run');

	$command->loadCount('events');
	$command->load('events');
	$events = CommandEvent::all();

	expect($command->events_count)
		->toEqual(1)
		->and($command->events->contains($events->first()))
		->toBeTrue()
		->and($events->count())
		->toEqual(1)
		->and($events->first()->command->id)
		->toEqual($command->id);
});

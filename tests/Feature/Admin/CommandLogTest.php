<?php

use function Pest\Laravel\actingAs;

test('redirects a logged-out user away from the command log', function () {
	$this->get(route('command-events.index'))
		->assertRedirect(route('login'));
});

it('shows the command log page if the user is an admin', function () {
	actingAs(createUser())
		->get(route('command-events.index'))
		->assertStatus(200);
});

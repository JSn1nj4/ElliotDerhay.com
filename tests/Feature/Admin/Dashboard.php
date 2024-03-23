<?php

it('allows loading the dashboard when logged in', function () {
	$this->actingAs(createUser())
		->get('/admin')
		->assertStatus(200);
});

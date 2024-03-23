<?php

it('loads the login page when logged out', function () {
	$this->get('/admin/login')->assertStatus(200);
});

it('redirects away from the login page when logged in', function () {
	$this->actingAs(createUser())
		->get('/admin/login')
		->assertStatus(302);
});

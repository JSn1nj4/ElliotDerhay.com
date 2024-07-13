<?php

voltMountable('google-analytics');

test('homepage renders the volt component')
	->get('/')
	->assertOk()
	->assertSeeVolt('google-analytics');

<?php

livewireMountable('google-analytics');

test('homepage renders the volt component')
	->get('/')
	->assertOk()
	->assertSeeLivewire('google-analytics');

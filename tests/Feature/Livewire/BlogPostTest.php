<?php

use Livewire\Volt\Volt;

it('can render', function () {
	$component = Volt::test('blog-post');

	$component->assertSee('');
});

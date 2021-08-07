<?php

use Laravel\Dusk\Browser;
use Tests\Browser\Pages\HomePage;

it('can visit the homepage', function (): void {
	$this->browse(function (Browser $browser) {
		$homepage = new HomePage;

		$browser->visit($homepage)
			->assertVisible('@main')
			->assertVisible('@about_section')
			->assertVisible('@projects_section')
			->assertVisible('@connect_section')
			->assertVisible('@twitter')
			->assertVisible('@github');
	});
});

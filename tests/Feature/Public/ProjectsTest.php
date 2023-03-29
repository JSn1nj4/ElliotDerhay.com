<?php

it('loads the project page', function () {
	$this->get(route('portfolio'))->assertStatus(200);
});

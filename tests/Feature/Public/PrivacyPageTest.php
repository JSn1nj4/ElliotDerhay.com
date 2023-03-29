<?php

it('loads the privacy page', function () {
	$this->get(route('privacy'))->assertStatus(200);
});

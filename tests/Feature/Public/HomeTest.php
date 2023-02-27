<?php

it('loads the homepage', function () {
    $this->get(route('home'))->assertStatus(200);
});

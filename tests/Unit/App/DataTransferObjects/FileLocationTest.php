<?php

use App\DataTransferObjects\FileLocation;

it('constructs a new instance')
	->expect(new FileLocation('local', 'test'))
	->toBeInstanceOf(FileLocation::class);

it('returns true when 2 instances have the same data', function () {
	$location1 = new FileLocation('local', 'test');
	$location2 = new FileLocation('local', 'test');

	assertTrue($location1->matches($location2));
});

it('returns false when 2 instances have different disks', function () {
	$location1 = new FileLocation('local', 'test');
	$location2 = new FileLocation('public', 'test');

	assertFalse($location1->matches($location2));
});

it('returns false when 2 instances have different paths', function () {
	$location1 = new FileLocation('local', 'test');
	$location2 = new FileLocation('local', 'temp');

	assertFalse($location1->matches($location2));
});

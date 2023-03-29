<?php

use App\Enums\PerPage;

test('\'isIntegerLike\' returns true for integers')
	->with('integers')
	->expect(fn ($val) => PerPage::isIntegerLike($val))
	->toBeTrue();

test('\'isIntegerLike\' returns true for integer strings')
	->with('integer_strings')
	->expect(fn ($val) => PerPage::isIntegerLike($val))
	->toBeTrue();

test('\'isIntegerLike\' returns false for any other value')
	->with('random_non_ints')
	->expect(fn ($random) => PerPage::isIntegerLike($random))
	->toBeFalse();

test('\'isIntegerLike\' throws an error for objects')
	->with('random_objects')
	->expect(fn ($obj) => PerPage::isIntegerLike($obj))
	->toThrow('');

test('\'filter\' returns the default value for anything that\'s not integer-like')
	->with('random_non_ints')
	->expect(fn ($int) => PerPage::filter($int))
	->toBe(PerPage::Default->value);

test('\'filter\' returns an integer of 1 to 100 as-is')
	->with('int_between_1_and_100')
	->expect(fn ($int) => PerPage::filter($int) === $int)
	->toBeTrue();

test('\'filter\' returns the integer version of an integer-like string')
	->with('int_string_between_1_and_100')
	->expect(fn ($str) => PerPage::filter($str) === intval($str))
	->toBeTrue();

test('\'filter\' returns the max value if the given value is higher')
	->with('ints_above_100')
	->expect(fn ($int) => PerPage::filter($int))
	->toBe(PerPage::Max->value);

test('\'filter\' returns the min value if the given value is lower')
	->with('ints_below_1')
	->expect(fn ($int) => PerPage::filter($int))
	->toBe(PerPage::Min->value);

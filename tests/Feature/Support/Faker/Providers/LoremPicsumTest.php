<?php

use App\Support\Faker\Factory;
use App\Support\Faker\Providers\LoremPicsum;

$supported_image_formats = ['jpg', 'jpeg', 'webp'];
$unsupported_image_formats = ['png', 'bmp', 'gif', 'tif', 'ico'];

dataset('random_supported_image_format', function () use ($supported_image_formats) {
	yield fake()->randomElement($supported_image_formats);
});

dataset('all_supported_image_formats', $supported_image_formats);

dataset('all_unsupported_image_formats', $unsupported_image_formats);

dataset('random_x_y_coordinates', function () {
	yield fake()->randomElements(range(-5000, 10000), count: 2);
});

dataset('random_blur_value', function () {
	yield fake()->randomElement([null, ...range(-50, 50)]);
});

it('returns the list of valid image format constants')
	->expect(LoremPicsum::getFormatConstants())
	->toContain(IMAGETYPE_JPEG, IMAGETYPE_WEBP);

it('returns the list of valid image formats')
	->expect(LoremPicsum::getFormats())
	->toContain(...$supported_image_formats);

it('provides a correctly-formatted image URL', function (
	int      $w,
	int      $h,
	bool     $gray,
	string   $format,
	int|null $blur
) {
	/**
	 * @noinspection PhpArgumentWithoutNamedIdentifierInspection
	 * this imageUrl() method is from a different provider than the default
	 */
	$sampleUrl = new LoremPicsum(Factory::create(config('app.faker_locale')))
		->imageUrl($w, $h, gray: $gray, format: $format, blur: $blur);

	/** @var $expression | goals: test whole string, capture width/height to see if within min/max range */
	$expression = '/^https:\/\/picsum\.photos(?:\/(?P<x>[0-9]{1,4}))(?:\/(?P<y>[0-9]{1,4}))\.(?:jpg|webp)(?:\?(?:grayscale(?:&blur(?:\=(?P<blur>[0-9]{1,2}))?)?|blur(?:\=(?P<blur_alt>[0-9]{1,2}))?))?$/i';

	preg_match($expression, $sampleUrl, $matches);

	$blur_val = match (true) {
		!empty($matches['blur']) => (int)$matches['blur'],
		!empty($matches['blur_alt']) => (int)$matches['blur_alt'],
		default => null,
	};

	expect($sampleUrl)->toMatch($expression)
		->and($matches['x'])->toBeBetween(1, 5000)
		->and($matches['y'])->toBeBetween(1, 5000)
		->and($blur_val)
		->unless($blur_val === null, function ($expectation) {
			$expectation->toBeBetween(1, 10);
		});
})
	->with('random_x_y_coordinates')
	->with(function () {
		yield fake()->boolean();
	})
	->with('random_supported_image_format')
	->with('random_blur_value')
	->repeat(15);

it('throws when given invalid image formats', function (
	int      $w,
	int      $h,
	bool     $gray,
	string   $format,
	int|null $blur
) {
	new LoremPicsum(Factory::create(config('app.faker_locale')))
		->imageUrl($w, $h, gray: $gray, format: $format, blur: $blur);
})
	->throws(\InvalidArgumentException::class)
	->with('random_x_y_coordinates')
	->with([
		fake()->boolean(),
	])
	->with('all_unsupported_image_formats')
	->with('random_blur_value');

it('fetches and stores a valid image', function (
	int      $w,
	int      $h,
	bool     $gray,
	string   $format,
	int|null $blur
) {
	$disk = Storage::fake('temp');

	$imagePath = fake()->image($disk->path(''), $w, $h, gray: $gray, format: $format, blur: $blur);

	expect($imagePath)
		->toBeFile()
		->toEndWith("." . $format === 'jpeg' ? 'jpg' : $format)
		->and(mime_content_type($imagePath))
		->toBeIn(['image/jpeg', 'image/webp']);
})
	->with('random_x_y_coordinates')
	->with([fake()->boolean()])
	->with('all_supported_image_formats')
	->with('random_blur_value');

<?php

use App\Support\Faker\Factory;
use App\Support\Faker\Providers\LoremPicsum;

$supported_image_formats = ['jpg', 'jpeg', 'webp'];
$unsupported_image_formats = ['png', 'bmp', 'gif', 'tif', 'ico'];

dataset('random_supported_image_format', [[
	fn () => fake()->randomElement($supported_image_formats),
]]);

dataset('all_supported_image_formats', $supported_image_formats);

dataset('all_unsupported_image_formats', $unsupported_image_formats);

dataset('random_x_y_coordinates', [[
	fn () => fake()->randomElement(range(-5000, 10000)),
	fn () => fake()->randomElement(range(-5000, 10000)),
]]);

dataset('random_blur_value', [[
	fn () => fake()->randomElement([null, ...range(-50, 50)]),
]]);

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
		!empty($matches['blur-sm']) => (int)$matches['blur-sm'],
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
	->with([fn () => fake()->boolean()]) // for grayscale
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
	->with([fn () => fake()->boolean()]) // for grayscale
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

	/**
	 * This one needed `fake()` so the underlying generator would be configured correctly.
	 *
	 * Type-hinting might still think `image()` is the same method belonging to the deprecated Image provider. This is due to `\Faker\Generator` including the old `image()` signature in its PHPDoc.
	 *
	 * But in this application, `image()` is actually the one belonging to the new LoremPicsum provider. So all arguments and named params end up being correct underneath.
	 *
	 * The _ide_helper.php file has an entry for `\Faker\Generator` near the top to try to resolve this.
	 */
	$imagePath = fake()->image($disk->path(''), $w, $h, gray: $gray, format: $format, blur: $blur);

	expect($imagePath)
		->toBeFile()
		->toEndWith("." . $format === 'jpeg' ? 'jpg' : $format)
		->and(mime_content_type($imagePath))
		->toBeIn(['image/jpeg', 'image/webp']);
})
	->with('random_x_y_coordinates')
	->with([fn () => fake()->boolean()]) // for grayscale
	->with('all_supported_image_formats')
	->with('random_blur_value');

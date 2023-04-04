<?php

use App\Models\Image;
use function Pest\Faker\fake;
use function Pest\Laravel\actingAs;
use function Pest\Laravel\delete;
use function Pest\Laravel\get;

it('redirects a logged-out user away from the commands index page', function () {
	get(route('images.index'))->assertRedirect(route('login'));
});

it('allows an admin to access images index page', function () {
	actingAs(createUser())
		->get(route('images.index'))
		->assertStatus(200);
});

it('redirects a logged-out user away from the image view page', function () {
	get(route('images.show', [
		'image' => fake()->randomNumber(),
	]))
		->assertRedirect(route('login'));
});

it('loads the admin image view page for signed-in users', function () {
	$image = createImage();

	actingAs(createUser())
		->get(route('images.show', [
			'image' => $image,
		]))
		->assertSessionHasNoErrors()
		->assertStatus(200);
});

it('prevents a logged-out user from deleting an image', function () {
	$image = createImage();

	$count = Image::count();

	delete(route('images.destroy', [
		'image' => $image,
	]))
		->assertRedirect(route('login'));

	expect(Image::count())->toEqual($count);
});

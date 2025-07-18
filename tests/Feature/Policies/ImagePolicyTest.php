<?php

use App\Models\Image;
use App\Policies\ImagePolicy;

/** @todo replace real image generating process with fake image data for policy testing */

it('can be listed by any user', fn () => expect(new ImagePolicy())
	->viewAny(makeUser())
	->toBeTrue());

it('can be viewed by any user', function () {
	expect(new ImagePolicy())
		->view(makeUser(), Image::factory()
			->fakeFileInfo()
			->exists()
			->createOne())
		->toBeTrue();
});

it('cannot be created by anonymous users', fn () => expect(new ImagePolicy())
	->create(makeUser())
	->toBeFalse());

it('can be created by a logged-in user', fn () => expect(new ImagePolicy())
	->create(createUser())
	->toBeTrue());

it('cannot be updated by anonymous users', function () {
	expect(new ImagePolicy())
		->update(makeUser(), Image::factory()
			->fakeFileInfo()
			->exists()
			->createOne())
		->toBeFalse();
});

it('can be updated by a logged-in user', function () {
	expect(new ImagePolicy())
		->update(createUser(), Image::factory()
			->fakeFileInfo()
			->exists()
			->createOne())
		->toBeTrue();
});

it('cannot be deleted by anonymous users', function () {
	expect(new ImagePolicy())
		->delete(makeUser(), Image::factory()
			->fakeFileInfo()
			->exists()
			->createOne())
		->toBeFalse();
});

it('can be deleted by a logged-in user', function () {
	expect(new ImagePolicy())
		->delete(createUser(), Image::factory()
			->fakeFileInfo()
			->exists()
			->createOne())
		->toBeTrue();
});

it('cannot be restored by anonymous users', function () {
	$diskName = 'public';
	$disk = Storage::fake($diskName);

	Storage::fake('temp');

	expect(new ImagePolicy())
		->restore(makeUser(), Image::factory()
			->setDisk($diskName, $disk)
			->fakeFileInfo()
			->exists()
			->createOne())
		->toBeFalse();
});

it('can be restored by a logged-in user', function () {
	$diskName = 'public';
	$disk = Storage::fake($diskName);

	Storage::fake('temp');

	expect(new ImagePolicy())
		->restore(createUser(), Image::factory()
			->setDisk($diskName, $disk)
			->fakeFileInfo()
			->exists()
			->createOne())
		->toBeTrue();
});

it('cannot be force-deleted by anonymous users', function () {
	$diskName = 'public';
	$disk = Storage::fake($diskName);

	Storage::fake('temp');

	expect(new ImagePolicy())
		->forceDelete(makeUser(), Image::factory()
			->setDisk($diskName, $disk)
			->fakeFileInfo()
			->exists()
			->createOne())
		->toBeFalse();
});

it('can be force-deleted by a logged-in user', function () {
	$diskName = 'public';
	$disk = Storage::fake($diskName);

	Storage::fake('temp');

	expect(new ImagePolicy())
		->forceDelete(createUser(), Image::factory()
			->setDisk($diskName, $disk)
			->fakeFileInfo()
			->exists()
			->createOne())
		->toBeTrue();
});

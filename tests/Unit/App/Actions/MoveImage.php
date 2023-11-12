<?php

use App\Actions\MoveImage;
use App\DataTransferObjects\FileLocation;
use App\DataTransferObjects\OperationResult;
use Illuminate\Http\UploadedFile;

beforeEach(function () {
	$this->fromDiskName = 'temp';
	$this->fromDisk = Storage::fake($this->fromDiskName);
	$this->toDiskName = 'public';
	$this->toDisk = Storage::fake($this->toDiskName);
});

test('move fails when file doesn\'t exist at source path', function () {
	$file = UploadedFile::fake()
		->create('test')
		->store('test', $this->fromDiskName);

	$bad_filename = $file . '-bad_filename';

	MoveImage::execute(
		new FileLocation($this->fromDiskName, $bad_filename),
		new FileLocation($this->toDiskName, $bad_filename),
	);
})->throws(\League\Flysystem\InvalidStreamProvided::class);

it('skips moving file due to matching source and target locations', function () {
	$file = UploadedFile::fake()
		->create('test')
		->store('test', $this->fromDiskName);

	$location = new FileLocation($this->fromDiskName, $file);

	expect(MoveImage::execute($location, $location))
		->toBeInstanceOf(OperationResult::class)
		->toHaveProperty('succeeded', false)
		->toHaveProperty('message', 'File transfer skipped. Source and destination are the same.');
});

// moves existing file in 'from' to 'to'
test('move succeeds', function () {
	$file = UploadedFile::fake()
		->create('test')
		->store('test', $this->fromDiskName);

	expect(MoveImage::execute(
		new FileLocation($this->fromDiskName, $file),
		new FileLocation($this->toDiskName, $file),
	))
		->toBeInstanceOf(OperationResult::class)
		->toHaveProperty('succeeded', true)
		->toHaveProperty('message', "File on disk '{$this->fromDiskName}' at path '{$file}' moved to disk '{$this->toDiskName}' at path '{$file}'.");
});

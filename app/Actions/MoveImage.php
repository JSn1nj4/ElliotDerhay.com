<?php

namespace App\Actions;

use App\DataTransferObjects\FileLocation;
use App\DataTransferObjects\OperationResult;
use Illuminate\Support\Facades\Storage;

class MoveImage
{
	public function __invoke(FileLocation $from, FileLocation $to): OperationResult
	{
		if ($to->matches($from)) return $this->failure(
			'File transfer skipped. Source and destination are the same.'
		);

		if ($from->disk === $to->disk) {
			$succeeded = Storage::disk($to->disk)->move($from->path, $to->path);

			return $succeeded ?
				$this->success("File on disk '{$to->disk}' moved from '{$from->path}' to '{$to->path}'.") :
				$this->failure("Failed to move file on disk '{$to->disk}' from '{$from->path}' to '{$to->path}'.");
		}

		$succeeded = Storage::disk($to->disk)
			->writeStream($to->path, Storage::disk($from->disk)
				->readStream($from->path));

		return $succeeded ?
			$this->success("File on disk '{$from->disk}' at path '{$from->path}' moved  to disk '{$to->disk}' at path '{$to->path}'.") :
			$this->failure("Failed to move file on disk '{$from->disk}' at path disk '{$to->disk}' at path '{$to->path}'.");
	}

	public static function execute(
		FileLocation $from,
		FileLocation $to,
	): OperationResult
	{
		return (new self())($from, $to);
	}

	protected function failure(string $message): OperationResult
	{
		return new OperationResult(false, $message);
	}

	protected function success(string $message): OperationResult
	{
		return new OperationResult(true, $message);
	}
}

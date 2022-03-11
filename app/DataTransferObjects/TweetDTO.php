<?php

namespace App\DataTransferObjects;

use App\Contracts\Actions\CreatesTwitterUserDTO;
use Carbon\Carbon;
use Spatie\DataTransferObject\DataTransferObject;

class TweetDTO extends DataTransferObject
{
	public int $id;

	public TwitterUserDTO $user;

	public string $body;

	public string $date;

	public array $entities;

	public static function getDate(array $tweetData): string
	{
		return Carbon::make($tweetData['created_at'])->format('Y-m-d H:i:s');
	}

	/**
	 * @throws \Spatie\DataTransferObject\Exceptions\UnknownProperties
	 * @throws \Illuminate\Validation\ValidationException
	 */
	public static function fromArray(array $data, CreatesTwitterUserDTO $createTwitterUserDTO): self
	{
		return new self(
			id: $data['id'],
			user: $createTwitterUserDTO($data['user']),
			body: $data['text'],
			date: self::getDate($data),
			entities: $data['entities'],
		);
	}
}

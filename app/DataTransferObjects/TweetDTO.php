<?php

namespace App\DataTransferObjects;

use Carbon\Carbon;
use Spatie\DataTransferObject\DataTransferObject;

class TweetDTO extends DataTransferObject
{
	public int $id;

	public TwitterUserDTO $user;

	public string $body;

	public string $date;

	public array $entities;

	public static function getDate(array $eventData): string
	{
		return Carbon::make($eventData['created_at'])->format('Y-m-d H:i:s');
	}
}

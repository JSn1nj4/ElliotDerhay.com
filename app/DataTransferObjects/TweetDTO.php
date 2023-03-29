<?php

namespace App\DataTransferObjects;

use Illuminate\Support\Carbon;

class TweetDTO
{
	public function __construct(
		public readonly int $id,
		public readonly TwitterUserDTO $user,
		public readonly string $body,
		public readonly string $date,
		public readonly array $entities,
	) {}

	public static function getDate(array $tweetData): string
	{
		return Carbon::make($tweetData['created_at'])->format('Y-m-d H:i:s');
	}
}

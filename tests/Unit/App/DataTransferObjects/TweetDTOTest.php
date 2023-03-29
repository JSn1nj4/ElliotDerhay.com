<?php

use App\DataTransferObjects\TweetDTO;
use App\DataTransferObjects\TwitterUserDTO;
use Illuminate\Support\Carbon;

it('creates a TweetDTO')
	->with('tweet_data')
	->expect(fn ($data) => new TweetDTO(
		$data['id'],
		TwitterUserDTO::fromArray($data['user']),
		$data['text'],
		TweetDTO::getDate($data),
		$data['entities'],
	))
	->toBeInstanceOf(TweetDTO::class);

test('\'getDate\' returns a datetime string', function ($data) {
	expect(TweetDTO::getDate($data))
		->toBe(Carbon::make($data['created_at'])
			->format('Y-m-d H:i:s'));
})->with('tweet_data');

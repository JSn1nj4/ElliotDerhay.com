<?php

use Tests\Support\TweetDataFactory;
use Tests\Support\TwitterUserDataFactory;

dataset('tweet_data', [
	TweetDataFactory::init()->count(1)->make(),
	TweetDataFactory::init()->count(1)->make(),
	TweetDataFactory::init()->count(1)->make(),
	TweetDataFactory::init()->count(1)->make(),
	TweetDataFactory::init()->count(1)->make(),
]);

dataset('twitter_user', [
	[TwitterUserDataFactory::init()->makeOne()]
]);


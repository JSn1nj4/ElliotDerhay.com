<?php

use Tests\Support\GithubUserDataFactory;

dataset('github_user_data_one', [
	[GithubUserDataFactory::init()->makeOne()],
]);

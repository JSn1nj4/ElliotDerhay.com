<?php

return [
	'feature' => [
		'categories_widget' => env('BLOG_ENABLE_CATEGORIES_WIDGET') === true,
		'tags_widget' => env('BLOG_ENABLE_TAGS_WIDGET') === true,
		'github_activity_widget' => env('BLOG_ENABLE_GITHUB_ACTIVITY_WIDGET') === true,
	],
];

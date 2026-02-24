<?php

namespace App\Events;

use App\Models\Post;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class PostPublishedEvent
{
	use Dispatchable, SerializesModels;

	public function __construct(public readonly Post $post) {}
}

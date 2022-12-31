<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class Image extends Model
{
    use HasFactory;

	public function posts(): MorphToMany
	{
		return $this->morphedByMany(Post::class, 'imageable');
	}

	public function projects(): MorphToMany
	{
		return $this->morphedByMany(Project::class, 'imageable');
	}
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Str;

/**
 * @property int $id
 * @property string $title
 * @property string $slug
 * @property string $body
 * @property string $excerpt
 * @property string $cover_image
 * @property Category[] $categories
 * @property Tag[] $tags
 */
class Post extends Model
{
    use HasFactory;

	public function categories(): BelongsToMany
	{
		return $this->belongsToMany(Category::class);
	}

	public function excerpt(): Attribute
	{
		return Attribute::get(fn () => str($this->body)->words(20));
	}

	public function tags(): BelongsToMany
	{
		return $this->belongsToMany(Tag::class);
	}
}

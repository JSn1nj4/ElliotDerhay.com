<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Str;

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

	public function slug(): Attribute
	{
		return Attribute::get(fn () => Str::slug($this->title));
	}

	public function tags(): BelongsToMany
	{
		return $this->belongsToMany(Tag::class);
	}
}

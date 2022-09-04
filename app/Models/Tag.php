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
 */
class Tag extends Model
{
    use HasFactory;

	public function posts(): BelongsToMany
	{
		return $this->belongsToMany(Post::class);
	}

	public function slug(): Attribute
	{
		return Attribute::get(fn () => Str::slug($this->title));
	}
}

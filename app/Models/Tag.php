<?php

namespace App\Models;

use App\DataTransferObjects\TagDTO;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

/**
 * App\Models\Tag
 *
 * @property int $id
 * @property string $title
 * @property string $slug
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Post[] $posts
 * @property-read int|null $posts_count
 * @method static \Database\Factories\TagFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Tag newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Tag newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Tag query()
 * @method static \Illuminate\Database\Eloquent\Builder|Tag whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tag whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tag whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tag whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tag whereSlug($value)
 * @mixin \Eloquent
 */
class Tag extends Model
{
    use HasFactory;

	protected $fillable = [
		'title',
		'slug',
	];

	public function posts(): MorphToMany
	{
		return $this->morphedByMany(Post::class, 'taggable');
	}

	public function slug(): Attribute
	{
		return Attribute::set(static fn (string $input) => str($input)
			->slug(dictionary: [
				'@' => 'at',
				'&' => 'and',
			])->toString());
	}

	/**
	 * Get a Tag list from a comma-separated list string
	 * @param string $tag_list
	 * @return \Illuminate\Database\Eloquent\Collection
	 */
	public static function fromString(string $tag_list): Collection
	{
		/** @var \Illuminate\Support\Collection $tagDTOs */
		$tagDTOs = str($tag_list)
			->explode(',')
			->map(static fn ($tag) => trim($tag))
			->filter() // remove empty values - blanks, breaks, nulls etc.
			->values() // removes keys explicitly set by `filter()`
			->map(static fn (string $tag) => new TagDTO($tag));

		static::upsert(
			$tagDTOs->map(static fn (TagDTO $dto) => $dto->toArray())->all(),
			['slug'], ['title']
		);

		return static::whereIn('slug', $tagDTOs->map(static fn (TagDTO $dto) => $dto->slug))->get();
	}
}

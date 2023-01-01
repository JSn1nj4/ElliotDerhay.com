<?php

namespace App\Models;

use App\Contracts\ImageableContract;
use App\Enums\PerPage;
use App\Traits\Imageable;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Http\Request;
use Illuminate\Pagination\AbstractPaginator;

/**
 * App\Models\Post
 *
 * @property int $id
 * @property string $title
 * @property string $slug
 * @property string $body
 * @property string $excerpt
 * @property string $cover_image
 * @property Category[] $categories
 * @property Tag[] $tags
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property-read int|null $categories_count
 * @property-read int|null $tags_count
 * @method static \Database\Factories\PostFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Post newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Post newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Post query()
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereBody($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereCoverImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Post extends ImageableModel
{
    use HasFactory;

	/**
	 * @var string[]
	 * inline type when allowed
	 */
	public $fillable = [
		'body',
		'slug',
		'title',
	];

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

	/**
	 * Encapsulates shared logic for listing posts
	 *
	 * Checks for query string filters like category, tag, and per_page count.
	 *
	 * @param Request $request
	 * @return AbstractPaginator
	 */
	public static function index(Request $request): AbstractPaginator
	{
		return self::when(optional($request)->category, function ($query, $category_id): void {
				$query->whereRelation('categories', 'category_id', $category_id);
			})
			->when(optional($request)->tag, function ($query, $tag_id): void {
				$query->whereRelation('tags', 'tag_id', $tag_id);
			})
			->latest()
			->paginate(PerPage::filter(
				optional($request)->per_page
			))
			->withQueryString();
	}
}

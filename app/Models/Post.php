<?php

namespace App\Models;

use App\Contracts\CategorizeableContract;
use App\Contracts\SearchDisplayableContract;
use App\Contracts\States\PostStateContract;
use App\Contracts\XMetaContract;
use App\DataTransferObjects\XMetaDTO;
use App\Enums\PerPage;
use App\Enums\XMetaCardType;
use App\Models\Scopes\PostPublishedScope;
use App\States\Posts\PostPublished;
use App\States\Posts\PostUnpublished;
use App\Traits\Categorizeable;
use App\Traits\SearchDisplayable;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Http\Request;
use Illuminate\Pagination\AbstractPaginator;
use Illuminate\Support\Collection;
use Spatie\Sitemap\Contracts\Sitemapable;
use Spatie\Sitemap\Tags\Url;

/**
 * App\Models\Post
 *
 * @property int $id
 * @property string $title
 * @property string $slug
 * @property string $body
 * @property string $excerpt
 * @property Image|null $image
 * @property Category[] $categories
 * @property \Illuminate\Database\Eloquent\Collection|Tag[] $tags
 * @property boolean $published
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property Carbon|null $published_at
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
 * @method \Illuminate\Database\Eloquent\Builder|Post published()
 * @method static \Illuminate\Database\Eloquent\Builder|Post published()
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Image[] $images
 * @property-read int|null $images_count
 * @property string $page_title
 * @property string $meta_description
 * @property \App\Models\SearchMeta $searchMeta
 */
class Post extends ImageableModel implements SearchDisplayableContract, CategorizeableContract, Sitemapable, XMetaContract
{
	// TODO: Implement Taggable stuff too
	// TODO: Replace ImageableModel stuff with contract and trait ONLY
    use Categorizeable,
		HasFactory,
		SearchDisplayable;

	protected $casts = [
		'published' => 'boolean',
		'published_at' => 'datetime',
	];

	/**
	 * @var string[]
	 * inline type when allowed
	 */
	public $fillable = [
		'body',
		'slug',
		'title',
	];

	protected static function booted(): void
	{
		static::addGlobalScope(new PostPublishedScope());
	}

	public function excerpt(): Attribute
	{
		return Attribute::get(fn () => str($this->body)->words(20));
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
		return self::when($request?->get('category'), static function ($query, $category_id): void {
				$query->whereRelation('categories', 'category_id', $category_id);
			})
			->when($request?->get('tag'), static function ($query, $tag_id): void {
				$query->whereRelation('tags', 'tag_id', $tag_id);
			})
			->latest('published_at')
			->paginate(PerPage::filter(
				$request?->get('per_page')
			))
			->withQueryString();
	}

	public function metaDescription(): Attribute
	{
		return Attribute::make(
			get: fn () => $this->searchMeta?->search_description ?? str($this->body)
				->words(30, '')
				->replaceMatches("/(\r\n|\r|\n)+/", " ")
				->whenEndsWith(['.', '?', '!', '...'],
					static fn ($string) => $string->append(''),
					static fn ($string) => $string->append('...'),
				)->toString(),

			// TODO: how can this be more efficient?
			set: function (string $description) {
				$meta = $this->searchMeta()->firstOrCreate();
				$meta->update(['search_description' => $description]);
			},
		);
	}

	public function pageTitle(): Attribute
	{
		return Attribute::make(
			get: fn () => $this->searchMeta?->search_title ?? $this->title,

			// TODO: how can this be more efficient?
			set: function (string $title) {
				$meta = $this->searchMeta()->firstOrCreate();
				$meta->update(['search_title' => $title]);
			},
		);
	}

	/**
	 * @param \Illuminate\Support\Collection<\App\Models\Category|int> $categories
	 * @return self
	 */
	public function syncCategories(Collection $categories): self
	{
		$this->categories()->sync($categories->map(static fn (Category $category) => $category->id)->all());

		return $this;
	}

	/**
	 * @param \Illuminate\Support\Collection<\App\Models\Tag> $tags
	 * @return self
	 */
	public function syncTags(Collection $tags): self
	{
		$this->tags()->sync($tags->map(static fn (Tag $tag) => $tag->id)->all());

		return $this;
	}

	/**
	 * @returns PostStateContract
	 * @throws \Exception
	 */
	public function state(): PostStateContract
	{
		return match($this->published) {
			true => new PostPublished($this),
			false => new PostUnpublished($this),
			default => throw new \Exception("Unresolvable `\$post->published` state. Expected: `true` or `false`. Actual: '{$this->published}'."),
		};
	}

	public function tags(): MorphToMany
	{
		return $this->morphToMany(Tag::class, 'taggable');
	}

	public function toSitemapTag(): Url|string|array
	{
		return route('blog.show', ['post' => $this]);
	}

	public function xCardMeta(): XMetaDTO
	{
		return new XMetaDTO(
			xTitle: $this->page_title,
			xDescription: $this->meta_description,
			xCard: XMetaCardType::SummaryLargeImage,
			xImage: $this->image->url,
		);
	}
}

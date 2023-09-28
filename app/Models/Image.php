<?php

namespace App\Models;

use App\Enums\PerPage;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Http\Request;
use Illuminate\Pagination\AbstractPaginator;

/**
 * App\Models\Image
 *
 * @property int $id
 * @property string $name
 * @property string $file_name
 * @property string $mime_type
 * @property string $path
 * @property string $disk
 * @property string $file_hash
 * @property string|null $collection
 * @property string|null $caption
 * @property int $size
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Post[] $posts
 * @property-read int|null $posts_count
 * @property-read int|null $posts_exists
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Project[] $projects
 * @property-read int|null $projects_count
 * @property-read int|null $projects_exists
 * @property-read string $url
 * @method static \Database\Factories\ImageFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Image newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Image newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Image query()
 * @method static \Illuminate\Database\Eloquent\Builder|Image whereCollection($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Image whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Image whereDisk($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Image whereFileHash($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Image whereFileName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Image whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Image whereMimeType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Image whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Image wherePath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Image whereSize($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Image whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Image extends Model
{
	use HasFactory;

	/**
	 * @var array
	 */
	protected $fillable = [
		'name',
		'file_name',
		'mime_type',
		'path',
		'disk',
		'file_hash',
		'size',
		'collection',
	];

	public static function index(Request $request): AbstractPaginator
	{
		return self::latest()
			->paginate(PerPage::filter(
				optional($request)->per_page ?? 30
			))
			->withQueryString();
	}

	public function isAttached(): bool
	{
		$this->loadExists(['posts', 'projects']);

		return $this->posts_exists && $this->projects_exists;
	}

	public function posts(): MorphToMany
	{
		return $this->morphedByMany(Post::class, 'imageable');
	}

	public function projects(): MorphToMany
	{
		return $this->morphedByMany(Project::class, 'imageable');
	}

	public function url(): Attribute
	{
		return Attribute::get(fn () => image_url($this->path, $this->disk));
	}
}

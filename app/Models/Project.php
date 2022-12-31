<?php

namespace App\Models;

use App\Enums\PerPage;
use App\Traits\Imageable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Pagination\AbstractPaginator;

/**
 * App\Models\Project
 *
 * @property int $id
 * @property string $name
 * @property string $link
 * @property string|null $demo_link
 * @property string $thumbnail
 * @property string $short_desc
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Project newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Project newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Project query()
 * @method static \Illuminate\Database\Eloquent\Builder|Project whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Project whereDemoLink($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Project whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Project whereLink($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Project whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Project whereShortDesc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Project whereThumbnail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Project whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Project extends Model
{
	use HasFactory,
		Imageable;

	public $fillable = [
		'name',
		'link',
		'demo_link',
		'short_desc',
	];

	public static function index(Request $request): AbstractPaginator
	{
		return self::latest()
			->paginate(PerPage::filter(
				optional($request)->per_page
			))
			->withQueryString();
	}
}

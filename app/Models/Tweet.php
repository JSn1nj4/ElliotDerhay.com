<?php

namespace App\Models;

use App\DataTransferObjects\TweetDTO;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\Tweet
 *
 * @property string $id
 * @property int $user_id
 * @property string $body
 * @property \Illuminate\Support\Carbon $date
 * @property int|null $sub_tweet_id
 * @property object $entities
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read string $formatted_body
 * @property-read string $url
 * @property-read \App\Models\TwitterUser|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|Tweet newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Tweet newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Tweet query()
 * @method static \Illuminate\Database\Eloquent\Builder|Tweet whereBody($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tweet whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tweet whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tweet whereEntities($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tweet whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tweet whereSubTweetId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tweet whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tweet whereUserId($value)
 * @mixin \Eloquent
 */
class Tweet extends Model
{
	use HasFactory;

	protected $casts = [
		'id' => 'string',
		'entities' => 'object',
	];

	protected $dates = [
		'date',
	];

	protected $fillable = [
		'id',
		'user_id',
		'body',
		'date',
		'sub_tweet_id',
		'entities',
	];

	public static function fromDTO(TweetDTO $dto): self
	{
		return self::firstOrCreate(['id' => intval($dto->id)], [
			'user_id' => TwitterUser::fromDTO($dto->user)->id,
			'body' => $dto->body,
			'date' => $dto->date,
			'entities' => $dto->entities,
		]);
	}

	public function getFormattedBodyAttribute(): string
	{
		// HTML formatting

		// Link hashtags, according to Twitter's guidelines
		foreach($this->entities->hashtags as $hashtag) {
			$this->body = str_replace(
				"#{$hashtag->text}",
				"<a target=\"_blank\" href=\"https://twitter.com/search?q=%23{$hashtag->text}\">#{$hashtag->text}</a>",
				$this->body
			);
		}

		// Link @mentions, according to Twitter's guidelines
		foreach($this->entities->user_mentions as $mention) {
			$this->body = str_replace(
				"@{$mention->screen_name}",
				"<a target=\"_blank\" href=\"https://twitter.com/{$mention->screen_name}\">@{$mention->screen_name}</a>",
				$this->body
			);
		}

		// Link URLs, according to Twitter's guidelines
		foreach($this->entities->urls as $url) {
			$this->body = str_replace(
				$url->url,
				"<a target=\"_blank\" href=\"{$url->expanded_url}\">{$url->display_url}</a>",
				$this->body
			);
		}

		// Link symbols to Twitter searches
		foreach($this->entities->symbols as $symbol) {
			$this->body = str_replace(
				"\${$symbol->text}",
				"<a target=\"_blank\" href=\"https://twitter.com\"/search?q=%24{$symbol->text}&src=ctag\">\${$symbol->text}</a>",
				$this->body
			);
		}

		// Render images
		if(isset($this->entities->media)) {
			foreach ($this->entities->media as $media) {
				$this->body = str_replace(
					$media->url,
					"<a target=\"_blank\" href=\"{$media->expanded_url}\"><img class=\"mt-4\" src=\"{$media->media_url_https}\" width=\"{$media->sizes->small->w}\" height=\"{$media->sizes->small->h}\"></a>",
					$this->body
				);
			}
		}

		// Insert HTML line breaks where necessary and return
		return preg_replace("/(?:\r\n|\r|\n)/", "<br>", $this->body);
	}

	public function getUrlAttribute(): string
	{
		return "{$this->user->profile_url}/status/{$this->id}";
	}

	public function user(): BelongsTo
	{
		return $this->belongsTo(TwitterUser::class);
	}
}

<?php

namespace App\Models;

use App\DataTransferObjects\TweetDTO;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
			'user_id' => $dto->user->id,
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

	public function user()
	{
		return $this->belongsTo(TwitterUser::class);
	}
}

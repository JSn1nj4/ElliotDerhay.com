<?php

namespace App\DataTransferObjects;

use Illuminate\Support\Str;
use Illuminate\Support\Stringable;

readonly class SocialPostDTO
{
	public function __construct(
		public string $text,
		public array  $links = [],
		public array  $tags = [],
	)
	{
	}

	public function __toString(): string
	{
		return $this->stringify();
	}

	/**
	 * @return string
	 * Currently only supports additional links as a sort of post footer, not additional types of entities like hashtags or mentions.
	 */
	public function stringify(): string
	{
		return implode("\n", [
			$this->text,

			// Format tags correctly
			collect($this->tags)
				->transform(static fn (string $item) => str($item)
					->lower()
					->pipe(static function (Stringable $item) {
						return preg_replace('/[^A-Za-z0-9]/', '', $item);
					})
					->lower()
					->prepend('#')
				)
				->implode(' '),

			// Format and filter links
			collect($this->links)
				->filter(static fn (string $item) => Str::isUrl($item))
				->transform(static fn (string $item) => Str::lower($item))
				->implode("\n")
		]);
	}
}

<?php

namespace App\DataTransferObjects;

readonly class SocialPostDTO
{
	public function __construct(
		public string $text,
		public array  $links = [],
	)
	{
	}

	/**
	 * @return string
	 * Currently only supports additional links as a sort of post footer, not additional types of entities like hashtags or mentions.
	 */
	public function stringify(): string
	{
		return collect($this->links)
			->map(static fn ($item, $key) => match (true) {
				is_numeric($key) => $item,
				default => "{$key}: {$item}",
			})
			->reduce(static function ($str, $link) {
				return "{$str}\n{$link}";
			}, $this->text);
	}
}

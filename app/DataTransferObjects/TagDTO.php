<?php

namespace App\DataTransferObjects;

class TagDTO
{
	public function __construct(
		public string $title,
		public string|null $slug = null,
	) {
		$this->process();
	}

	private function process(): void
	{
		$this->title = trim($this->title);

		$this->setSlug();
	}

	private function setSlug(): void
	{
		if ($this->slug !== null) return;

		$this->slug = str($this->title)->slug(dictionary: [
			'@' => 'at',
			'&' => 'and',
		]);
	}

	public function toArray(): array
	{
		return [
			'title' => $this->title,
			'slug' => $this->slug,
		];
	}
}

<?php

namespace App\DataTransferObjects;

class CategoryDTO
{
	public function __construct(
		public string $title,
		public string|null $slug = null,
	) {
		$this->process();
	}

	public static function fromString(string $title): self
	{
		return new self(str($title)
			->stripTags()
			->trim()
			->remove("{}[]`~!@#\$%^*+=<>/\\\r\n")
			->toString());
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

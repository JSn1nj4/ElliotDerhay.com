<?php

namespace App\Filament\Forms\Components;

use Filament\Forms\Components\Field;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;

class ContentPreview extends Field
{
	protected string $view = 'filament.forms.components.content-preview';

	// protected string $contentCachePrefix = 'content-preview_';

	protected string|null $previewCacheKey = null;
	protected string|null $stalePreviewCacheKey = null; // held until cleanup step completes

	protected \Closure|string $sourceField;

	public function getRoute()
	{
		return route('content-preview', ['previewRef' => $this->previewCacheKey ?? 'preview-not-found']);
	}

	public function getSourceField(): string
	{
		return $this->evaluate($this->sourceField);
	}

	public function preparePreview($fieldContent): void
	{
		$this->stalePreviewCacheKey = $this->previewCacheKey;

		$this->previewCacheKey = $this->getCacheKey();

		Cache::set($this->previewCacheKey, $fieldContent, ttl()->minutes(15)->get());
	}

	public function purgeStalePreview(): void
	{
		if ($this->stalePreviewCacheKey === null) return;

		if (!Cache::forget($this->stalePreviewCacheKey)) return;

		$this->stalePreviewCacheKey = null;
	}

	public function sourceField(\Closure|string $field): static
	{
		$this->sourceField = $field;

		return $this;
	}

	protected function getCacheKey(): string
	{
		return "content_preview-" . Str::random();
	}
}

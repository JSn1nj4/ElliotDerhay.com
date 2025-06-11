<?php

namespace App\View\Renderers\Markdown\Inline;

use App\View\Renderers\Markdown\Traits\Resumeable;
use Illuminate\Support\Facades\Storage;
use League\CommonMark\Extension\CommonMark\Node\Inline\Image;
use League\CommonMark\Node\Inline\Text;
use League\CommonMark\Node\Node;
use League\CommonMark\Renderer\ChildNodeRendererInterface;
use League\CommonMark\Renderer\NodeRendererInterface;
use League\CommonMark\Util\HtmlElement;

/**
 * This class also wraps the image in a <figure>
 */
class CaptionableImageRenderer implements NodeRendererInterface
{
	use Resumeable;

	public function render(Node $node, ChildNodeRendererInterface $childRenderer): \Stringable
	{
		Image::assertInstanceOf($node);

		/** @var Image $node */
		$attrs = $node->data->get('attributes');

		if ($title = $node->getTitle()) $attrs['title'] = $title;

		if (method_exists($node, 'getUrl')) {
			$attrs['src'] = $this->resolveImageUrl($node->getUrl());
		}

		if ($node->hasChildren()) {
			$attrs = $this->getAdditionalAttributes($node, $attrs);
		}

		$img = new HtmlElement('img', $attrs, $this->maybePrepCaption($attrs), true);

		return new HtmlElement('figure', [
			'class' => 'lightbox-trigger inline-block'
		], (string)$img);
	}

	private function getAdditionalAttributes(Node $node, array $attrs): array
	{
		foreach ($node->children() as $child) {
			if ($child::class === Text::class) {
				$attrs['alt'] = $child->getLiteral();
			}
		}

		return $attrs;
	}

	private function maybePrepCaption(array $attrs): string
	{
		return match (isset($attrs['alt'])) {
			true => (string)new HtmlElement(tagName: 'figcaption', attributes: [
				'class' => ''
			], contents: $attrs['alt']),
			default => '',
		};
	}

	private function resolveImageUrl(string $url): string
	{
		$stringable = str($url);

		$assetsBase = Storage::disk(config('filesystems.image_service.assets_disk'))->url('');

		$publicCacheDisk = 'public-cache';
		$publicCacheBase = Storage::disk($publicCacheDisk)->url('');

		$uploadsDisk = config('app.uploads.disk');
		$uploadsBase = Storage::disk($uploadsDisk)->url('');

		return match (true) {
			$stringable->startsWith($assetsBase) => asset_url($stringable->after($assetsBase)),
			$stringable->startsWith($uploadsBase) => image_url($stringable->after($uploadsBase), $uploadsDisk),
			$stringable->startsWith($publicCacheBase) => image_url($stringable->after($publicCacheBase), $publicCacheDisk),
			default => $url,
		};
	}
}

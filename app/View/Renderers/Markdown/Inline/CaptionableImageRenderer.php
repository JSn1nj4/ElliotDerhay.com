<?php

namespace App\View\Renderers\Markdown\Inline;

use App\View\Renderers\Markdown\Traits\Resumeable;
use League\CommonMark\Extension\CommonMark\Node\Inline\Image;
use League\CommonMark\Extension\CommonMark\Renderer\Inline\ImageRenderer;
use League\CommonMark\Node\Inline\Text;
use League\CommonMark\Node\Node;
use League\CommonMark\Renderer\ChildNodeRendererInterface;
use League\CommonMark\Renderer\NodeRendererInterface;
use League\CommonMark\Util\HtmlElement;
use Nette\Utils\Html;

/**
 * This class also wraps the image in a <figure>
 */
class CaptionableImageRenderer implements NodeRendererInterface
{
	use Resumeable;

	public function render(Node $node, ChildNodeRendererInterface $childRenderer): \Stringable
	{
		Image::assertInstanceOf($node);

		$attrs = $node->data->get('attributes');

		if ($title = $node->getTitle()) $attrs['title'] = $title;
		if ($src = $node->getUrl()) $attrs['src'] = $src;

		if ($node->hasChildren()) {
			$attrs = $this->getAdditionalAttributes($node, $attrs);
		}

		$img = new HtmlElement('img', $attrs, $this->maybePrepCaption($attrs), true);

		return new HtmlElement('figure', [
			'class' => 'lightbox-trigger'
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
		return match(isset($attrs['alt'])) {
			true => (string)new HtmlElement(tagName: 'figcaption', contents: $attrs['alt']),
			default => '',
		};
	}
}

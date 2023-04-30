<?php

namespace App\View\Renderers\Markdown\Blocks;

use App\View\Renderers\Markdown\Traits\Resumeable;
use League\CommonMark\Node\Block\Paragraph;
use League\CommonMark\Node\Block\TightBlockInterface;
use League\CommonMark\Node\Node;
use League\CommonMark\Renderer\ChildNodeRendererInterface;
use League\CommonMark\Renderer\NodeRendererInterface;
use League\CommonMark\Util\HtmlElement;
use League\CommonMark\Xml\XmlNodeRendererInterface;

class ParagraphRenderer implements NodeRendererInterface, XmlNodeRendererInterface
{
	use Resumeable;

	/**
	 * @param Paragraph $node
	 *
	 * {@inheritDoc}
	 *
	 * @psalm-suppress MoreSpecificImplementedParamType
	 */
	public function render(Node $node, ChildNodeRendererInterface $childRenderer): HtmlElement|string
	{
		Paragraph::assertInstanceOf($node);

		if ($this->inTightList($node)) {
			return $childRenderer->renderNodes($node->children());
		}

		$attrs = array_merge($node->data->get('attributes'), ['class' => 'text-lg leading-7 mb-4']);

		return new HtmlElement('p', $attrs, $childRenderer->renderNodes($node->children()));
	}

	public function getXmlTagName(Node $node): string
	{
		return 'paragraph';
	}

	/**
	 * {@inheritDoc}
	 */
	public function getXmlAttributes(Node $node): array
	{
		return [];
	}

	private function inTightList(Paragraph $node): bool
	{
		// Only check up to two (2) levels above this for tightness
		$i = 2;
		while (($node = $node->parent()) && $i--) {
			if ($node instanceof TightBlockInterface) {
				return $node->isTight();
			}
		}

		return false;
	}
}

<?php

namespace App\View\Renderers\Markdown\Blocks;

use League\CommonMark\Extension\CommonMark\Node\Block\BlockQuote;
use League\CommonMark\Node\Node;
use League\CommonMark\Renderer\ChildNodeRendererInterface;
use League\CommonMark\Renderer\NodeRendererInterface;
use League\CommonMark\Util\HtmlElement;
use League\CommonMark\Xml\XmlNodeRendererInterface;

class BlockQuoteRenderer implements NodeRendererInterface, XmlNodeRendererInterface
{
	/**
	 * @param BlockQuote $node
	 *
	 * {@inheritDoc}
	 *
	 * @psalm-suppress MoreSpecificImplementedParamType
	 */
	public function render(Node $node, ChildNodeRendererInterface $childRenderer): HtmlElement
	{
		BlockQuote::assertInstanceOf($node);

		$attrs = array_merge($node->data->get('attributes'), ['class' => 'border-l-gray-700 border-l-2 border-solid pl-4']);

		$filling        = $childRenderer->renderNodes($node->children());
		$innerSeparator = $childRenderer->getInnerSeparator();
		if ($filling === '') {
			return new HtmlElement('blockquote', $attrs, $innerSeparator);
		}

		return new HtmlElement(
			'blockquote',
			$attrs,
			$innerSeparator . $filling . $innerSeparator
		);
	}

	public function getXmlTagName(Node $node): string
	{
		return 'block_quote';
	}

	/**
	 * @param BlockQuote $node
	 *
	 * @return array<string, scalar>
	 *
	 * @psalm-suppress MoreSpecificImplementedParamType
	 */
	public function getXmlAttributes(Node $node): array
	{
		return [];
	}
}

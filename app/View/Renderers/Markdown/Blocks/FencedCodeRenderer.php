<?php

namespace App\View\Renderers\Markdown\Blocks;

use App\View\Renderers\Markdown\Traits\Resumeable;
use League\CommonMark\Extension\CommonMark\Node\Block\FencedCode;
use League\CommonMark\Node\Node;
use League\CommonMark\Renderer\ChildNodeRendererInterface;
use League\CommonMark\Renderer\NodeRendererInterface;
use League\CommonMark\Util\HtmlElement;
use League\CommonMark\Xml\XmlNodeRendererInterface;
use Tempest\Highlight\Highlighter;

class FencedCodeRenderer implements NodeRendererInterface, XmlNodeRendererInterface
{
	use Resumeable;

	/**
	 * @inheritDoc
	 */
	public function render(Node $node, ChildNodeRendererInterface $childRenderer)
	{
		FencedCode::assertInstanceOf($node);

		/**
		 * @var FencedCode $node
		 * @note this is necessary for IDE autocompletion
		 */

		$highlighter = new Highlighter();

		$attributes = array_merge($node->data->get('attributes'), ['class' => 'inline-block p-4']);

		return new HtmlElement('pre', ['class' => 'block overflow-x-auto my-4 p-1 w-full'],
			new HtmlElement('code', $attributes, $highlighter->parse($node->getLiteral(), $node->getInfo()))
		);
	}

	public function getXmlTagName(Node $node): string
	{
		return 'fenced_code';
	}

	public function getXmlAttributes(Node $node): array
	{
		return [];
	}
}

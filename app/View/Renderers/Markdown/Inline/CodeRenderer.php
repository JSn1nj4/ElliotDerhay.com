<?php

namespace App\View\Renderers\Markdown\Inline;

use League\CommonMark\Extension\CommonMark\Node\Inline\Code;
use League\CommonMark\Node\Node;
use League\CommonMark\Renderer\ChildNodeRendererInterface;
use League\CommonMark\Renderer\NodeRendererInterface;
use League\CommonMark\Util\HtmlElement;
use League\CommonMark\Util\Xml;
use League\CommonMark\Xml\XmlNodeRendererInterface;

class CodeRenderer implements NodeRendererInterface, XmlNodeRendererInterface
{
    /**
	 * @param Code $node
	 *
     * @inheritDoc
     */
    public function render(Node $node, ChildNodeRendererInterface $childRenderer): HtmlElement
    {
		Code::assertInstanceOf($node);

		$attrs = array_merge($node->data->get('attributes'), ['class' => 'text-teal-200 bg-gray-800 px-1']);

        return new HtmlElement('code', $attrs, Xml::escape($node->getLiteral()));
    }

	public function getXmlTagName(Node $node): string
	{
		return 'code';
	}

	/**
	 * {@inheritDoc}
	 */
	public function getXmlAttributes(Node $node): array
	{
		return [];
	}
}

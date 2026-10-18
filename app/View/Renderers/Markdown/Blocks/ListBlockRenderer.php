<?php

namespace App\View\Renderers\Markdown\Blocks;

use App\View\Renderers\Markdown\Traits\Resumeable;
use League\CommonMark\Extension\CommonMark\Node\Block\ListBlock;
use League\CommonMark\Extension\CommonMark\Node\Block\ListItem;
use League\CommonMark\Node\Node;
use League\CommonMark\Renderer\ChildNodeRendererInterface;
use League\CommonMark\Renderer\NodeRendererInterface;
use League\CommonMark\Util\HtmlElement;
use League\CommonMark\Xml\XmlNodeRendererInterface;

class ListBlockRenderer implements NodeRendererInterface, XmlNodeRendererInterface
{
	use Resumeable;

	public function render(Node $node, ChildNodeRendererInterface $childRenderer)
	{
		ListBlock::assertInstanceOf($node);

		$contents = $childRenderer->renderNodes($node->children());

		$attrs = array_merge($node->data->get('attributes'), match (true) {
			$node->parent() instanceof ListItem => [],
			default => ['class' => 'not-last:mb-8'],
		});

		return new HtmlElement(match ($node->getListData()->type) {
			'ordered' => 'ol',
			default => 'ul',
		}, $attrs, $contents);
	}

	public function getXmlTagName(Node $node): string
	{
		return 'list';
	}

	public function getXmlAttributes(Node $node): array
	{
		return [];
	}
}

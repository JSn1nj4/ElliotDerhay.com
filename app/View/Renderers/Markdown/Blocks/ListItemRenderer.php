<?php

namespace App\View\Renderers\Markdown\Blocks;

use App\View\Renderers\Markdown\Traits\Resumeable;
use League\CommonMark\Extension\CommonMark\Node\Block\ListItem;
use League\CommonMark\Extension\TaskList\TaskListItemMarker;
use League\CommonMark\Node\Block\Paragraph;
use League\CommonMark\Node\Node;
use League\CommonMark\Renderer\ChildNodeRendererInterface;
use League\CommonMark\Renderer\NodeRendererInterface;
use League\CommonMark\Util\HtmlElement;
use League\CommonMark\Xml\XmlNodeRendererInterface;

class ListItemRenderer implements NodeRendererInterface, XmlNodeRendererInterface
{
	use Resumeable;

	/**
	 * @param ListItem $node
	 *
	 * {@inheritDoc}
	 *
	 * @psalm-suppress MoreSpecificImplementedParamType
	 */
	public function render(Node $node, ChildNodeRendererInterface $childRenderer): HtmlElement
	{
		ListItem::assertInstanceOf($node);

		$contents = $childRenderer->renderNodes($node->children());
		if (str_starts_with($contents, '<') && ! $this->startsTaskListItem($node)) {
			$contents = "\n" . $contents;
		}

		if (str_ends_with($contents, '>')) {
			$contents .= "\n";
		}

		$attrs = array_merge($node->data->get('attributes'), ['class' => 'my-2']);

		return new HtmlElement('li', $attrs, $contents);
	}

	public function getXmlTagName(Node $node): string
	{
		return 'item';
	}

	/**
	 * {@inheritDoc}
	 */
	public function getXmlAttributes(Node $node): array
	{
		return [];
	}

	private function startsTaskListItem(ListItem $block): bool
	{
		$firstChild = $block->firstChild();

		return $firstChild instanceof Paragraph && $firstChild->firstChild() instanceof TaskListItemMarker;
	}
}

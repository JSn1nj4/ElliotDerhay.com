<?php

namespace App\Renderers\Markdown\Blocks;

use League\CommonMark\Extension\CommonMark\Node\Block\Heading;
use League\CommonMark\Node\Node;
use League\CommonMark\Renderer\ChildNodeRendererInterface;
use League\CommonMark\Renderer\NodeRendererInterface;
use League\CommonMark\Util\HtmlElement;

class HeadingRenderer implements NodeRendererInterface
{
    /**
     * @inheritDoc
     */
    public function render(Node $node, ChildNodeRendererInterface $childRenderer): HtmlElement
	{
		/** @var Heading $node */
		[$level, $attributes] = match($node->getLevel()) {
			1 => ['h1', ['class' => 'text-4xl']],
			2 => ['h2', ['class' => 'text-3xl']],
			3 => ['h3', ['class' => 'text-2xl']],
			4 => ['h4', ['class' => 'text-xl']],
			5 => ['h5', ['class' => 'text-lg']],
			6 => ['h6', ['class' => 'text-md']],
		};

		return new HtmlElement($level, $attributes, $childRenderer->renderNodes($node->children()));
    }
}

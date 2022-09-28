<?php

namespace App\View\Renderers\Markdown\Blocks;

use League\CommonMark\Node\Node;
use League\CommonMark\Renderer\ChildNodeRendererInterface;
use League\CommonMark\Util\HtmlElement;

class ListItemRenderer implements \League\CommonMark\Renderer\NodeRendererInterface
{
    /**
     * @inheritDoc
     */
    public function render(Node $node, ChildNodeRendererInterface $childRenderer): HtmlElement
    {
        return new HtmlElement('li', ['class' => 'my-2'], $childRenderer->renderNodes($node->children()));
    }
}

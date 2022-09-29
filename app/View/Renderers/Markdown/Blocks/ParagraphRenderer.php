<?php

namespace App\View\Renderers\Markdown\Blocks;

use League\CommonMark\Node\Node;
use League\CommonMark\Renderer\ChildNodeRendererInterface;
use League\CommonMark\Util\HtmlElement;

class ParagraphRenderer implements \League\CommonMark\Renderer\NodeRendererInterface
{
    /**
     * @inheritDoc
     */
    public function render(Node $node, ChildNodeRendererInterface $childRenderer): HtmlElement
    {
        return new HtmlElement('p', ['class' => 'text-lg leading-7 mb-4 last:mb-0'], $childRenderer->renderNodes($node->children()));
    }
}

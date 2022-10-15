<?php

namespace App\View\Renderers\Markdown\Blocks;

use League\CommonMark\Node\Node;
use League\CommonMark\Renderer\ChildNodeRendererInterface;
use League\CommonMark\Util\HtmlElement;

class ThematicBreakRenderer implements \League\CommonMark\Renderer\NodeRendererInterface
{
    /**
     * @inheritDoc
     */
    public function render(Node $node, ChildNodeRendererInterface $childRenderer): HtmlElement
    {
        return new HtmlElement('hr', ['class' => 'my-8 mx-auto border-t-gray-700 border-dashed border-t-2 px-3 w-[40%] max-w-sm'], '');
    }
}

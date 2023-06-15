<?php

namespace App\View\Renderers\Markdown\Blocks;

use App\View\Renderers\Markdown\Traits\Resumeable;
use League\CommonMark\Extension\CommonMark\Node\Block\Heading;
use League\CommonMark\Node\Node;
use League\CommonMark\Renderer\ChildNodeRendererInterface;
use League\CommonMark\Renderer\NodeRendererInterface;
use League\CommonMark\Util\HtmlElement;
use League\CommonMark\Xml\XmlNodeRendererInterface;

class HeadingRenderer implements NodeRendererInterface, XmlNodeRendererInterface
{
	use Resumeable;

	/**
	 * @param Heading $node
	 *
	 * {@inheritDoc}
	 *
	 * @psalm-suppress MoreSpecificImplementedParamType
	 */
	public function render(Node $node, ChildNodeRendererInterface $childRenderer): HtmlElement
	{
		Heading::assertInstanceOf($node);

		[$level, $attributes] = match($node->getLevel()) {
			1 => ['h1', ['class' => 'text-4xl mt-6 first:mt-0']],
			2 => ['h2', ['class' => 'text-3xl mt-6 first:mt-0']],
			3 => ['h3', ['class' => 'text-2xl mt-6 first:mt-0']],
			4 => ['h4', ['class' => 'text-xl mt-6 first:mt-0']],
			5 => ['h5', ['class' => 'text-lg mt-6 first:mt-0']],
			6 => ['h6', ['class' => 'text-md mt-6 first:mt-0']],
		};

		$id = str($node->firstChild()->getLiteral())->slug(separator: '_', dictionary: [
			'@' => 'at',
			'&' => 'and',
		]);

		return new HtmlElement('a', [
			'class' => 'linked-heading',
			'href' => $id->prepend('#')->toString(),
		], (string) new HtmlElement($level,
			// set heading attributes
			[
				...$node->data->get('attributes'),
				...$attributes,
				...[
					'id' => $id->toString(),
				],
			],
			// render child heading child nodes
			$childRenderer->renderNodes($node->children())
		));
	}

	public function getXmlTagName(Node $node): string
	{
		return 'heading';
	}

	/**
	 * @param Heading $node
	 *
	 * @return array<string, scalar>
	 *
	 * @psalm-suppress MoreSpecificImplementedParamType
	 */
	public function getXmlAttributes(Node $node): array
	{
		Heading::assertInstanceOf($node);

		return ['level' => $node->getLevel()];
	}
}

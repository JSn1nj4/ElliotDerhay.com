<?php

namespace App\View\Renderers\Markdown\Blocks;

use App\View\Renderers\Markdown\Traits\Resumeable;
use Illuminate\Support\Stringable;
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
	public function render(Node $node, ChildNodeRendererInterface $childRenderer): HtmlElement|Stringable|string|null
	{
		Heading::assertInstanceOf($node);

		$sharedClasses = join(' ', [
			'relative',
			'mt-6',
			'sm:-ml-8',
			'first:mt-0',
			'sm:pl-8',
		]);

		[$level, $attributes] = match($node->getLevel()) {
			1 => ['h1', ['class' => "{$sharedClasses} text-4xl"]],
			2 => ['h2', ['class' => "{$sharedClasses} text-3xl"]],
			3 => ['h3', ['class' => "{$sharedClasses} text-2xl"]],
			4 => ['h4', ['class' => "{$sharedClasses} text-xl"]],
			5 => ['h5', ['class' => "{$sharedClasses} text-lg"]],
			6 => ['h6', ['class' => "{$sharedClasses} text-md"]],
		};

		$id = str($node->firstChild()->getLiteral())->slug(separator: '_', dictionary: [
			'@' => 'at',
			'&' => 'and',
		]);

		return new HtmlElement($level,
			// set heading attributes
			[
				...$node->data->get('attributes'),
				...$attributes,
				...[
					'id' => $id->toString(),
				],
			],
			// render heading content
			$childRenderer->renderNodes($node->children())
			// render link
			. (string) new HtmlElement('a', [
				'class' => 'heading-anchor sm:absolute sm:top-0 sm:left-0 pl-2 sm:pl-0 inline-block sm:invisible',
				'title' => 'Click to copy',
				'alt' => 'Heading anchor link',
				'href' => $id->prepend('#')->toString(),
			], (string) new HtmlElement('i', [
				'class' => 'fas fa-regular fa-anchor fa-xs sm:fa-sm',
			], ''))
		);
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

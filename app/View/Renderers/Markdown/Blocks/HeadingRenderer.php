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
			'mt-8',
			'sm:-ml-8',
			'first:mt-0',
			'sm:pl-8',
		]);

		[$level, $attributes] = match ($node->getLevel()) {
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
			. (string)new HtmlElement('a', [
				'class' => 'heading-anchor sm:absolute sm:top-0 sm:left-0 pl-2 sm:pl-0 inline-block sm:invisible align-middle',
				'title' => 'Click to copy',
				'alt' => 'Heading anchor link',
				'href' => $id->prepend('#')->toString(),
			], (string)new HtmlElement('svg', [
				'fill' => 'currentColor',
				'xmlns' => 'http://www.w3.org/2000/svg',
				'viewBox' => '0 0 576 512',
				'class' => 'size-[0.8em] inline-block'
			], (string)new HtmlElement('path', [
				// yes I did copy this from the raw SVG output
				'd' => 'M320 96a32 32 0 1 1 -64 0 32 32 0 1 1 64 0zm21.1 80C367 158.8 384 129.4 384 96c0-53-43-96-96-96s-96 43-96 96c0 33.4 17 62.8 42.9 80L224 176c-17.7 0-32 14.3-32 32s14.3 32 32 32l32 0 0 208-48 0c-53 0-96-43-96-96l0-6.1 7 7c9.4 9.4 24.6 9.4 33.9 0s9.4-24.6 0-33.9L97 263c-9.4-9.4-24.6-9.4-33.9 0L7 319c-9.4 9.4-9.4 24.6 0 33.9s24.6 9.4 33.9 0l7-7 0 6.1c0 88.4 71.6 160 160 160l80 0 80 0c88.4 0 160-71.6 160-160l0-6.1 7 7c9.4 9.4 24.6 9.4 33.9 0s9.4-24.6 0-33.9l-56-56c-9.4-9.4-24.6-9.4-33.9 0l-56 56c-9.4 9.4-9.4 24.6 0 33.9s24.6 9.4 33.9 0l7-7 0 6.1c0 53-43 96-96 96l-48 0 0-208 32 0c17.7 0 32-14.3 32-32s-14.3-32-32-32l-10.9 0z',
			])))
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

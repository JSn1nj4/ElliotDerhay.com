<?php

namespace App\View\Renderers\Markdown\Inline;

use Illuminate\Support\Facades\URL;
use League\CommonMark\Extension\CommonMark\Node\Inline\Link;
use League\CommonMark\Node\Node;
use League\CommonMark\Renderer\ChildNodeRendererInterface;
use League\CommonMark\Renderer\NodeRendererInterface;
use League\CommonMark\Util\HtmlElement;
use League\CommonMark\Util\RegexHelper;
use League\CommonMark\Xml\XmlNodeRendererInterface;
use League\Config\ConfigurationAwareInterface;
use League\Config\ConfigurationInterface;

/**
 * based on \League\CommonMark\Extension\CommonMark\Renderer\Inline\LinkRenderer
 */
class LinkRenderer implements NodeRendererInterface, XmlNodeRendererInterface, ConfigurationAwareInterface
{
	/** @psalm-readonly-allow-private-mutation */
	private ConfigurationInterface $config;

	/**
	 * @param Link $node
	 *
	 * {@inheritDoc}
	 *
	 * @psalm-suppress MoreSpecificImplementedParamType
	 */
	public function render(Node $node, ChildNodeRendererInterface $childRenderer): \Stringable
	{
		Link::assertInstanceOf($node);

		$attrs = $node->data->get('attributes');

		$forbidUnsafeLinks = ! $this->config->get('allow_unsafe_links');
		if (! ($forbidUnsafeLinks && RegexHelper::isLinkPotentiallyUnsafe($node->getUrl()))) {
			$attrs['href'] = $node->getUrl();
		}

		if (($title = $node->getTitle()) !== null) {
			$attrs['title'] = $title;
		}

		if (isset($attrs['target']) && $attrs['target'] === '_blank' && ! isset($attrs['rel'])) {
			$attrs['rel'] = 'noopener noreferrer';
		}

		if (!str_starts_with($node->getUrl(), URL::to('/')) && !str_starts_with($node->getUrl(), '/')) {
			$attrs['target'] = '_blank';
		}

		return new HtmlElement('a', $attrs, $childRenderer->renderNodes($node->children()));
	}

	public function setConfiguration(ConfigurationInterface $configuration): void
	{
		$this->config = $configuration;
	}

	public function getXmlTagName(Node $node): string
	{
		return 'link';
	}

	/**
	 * @param Link $node
	 *
	 * @return array<string, scalar>
	 *
	 * @psalm-suppress MoreSpecificImplementedParamType
	 */
	public function getXmlAttributes(Node $node): array
	{
		Link::assertInstanceOf($node);

		return [
			'destination' => $node->getUrl(),
			'title' => $node->getTitle() ?? '',
		];
	}
}

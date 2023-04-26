<?php

use App\View\Renderers\Markdown\Blocks\BlockQuoteRenderer;
use App\View\Renderers\Markdown\Blocks\HeadingRenderer;
use App\View\Renderers\Markdown\Blocks\ListItemRenderer;
use App\View\Renderers\Markdown\Blocks\ParagraphRenderer;
use App\View\Renderers\Markdown\Blocks\ThematicBreakRenderer;
use App\View\Renderers\Markdown\Inline\CodeRenderer;
use App\View\Renderers\Markdown\Inline\LinkRenderer;
use League\CommonMark\Extension\CommonMark\Node\Block\BlockQuote;
use League\CommonMark\Extension\CommonMark\Node\Block\Heading;
use League\CommonMark\Extension\CommonMark\Node\Block\ListItem;
use League\CommonMark\Extension\CommonMark\Node\Block\ThematicBreak;
use League\CommonMark\Extension\CommonMark\Node\Inline\Code;
use League\CommonMark\Extension\CommonMark\Node\Inline\Link;
use League\CommonMark\Node\Block\Paragraph;

return [
    'code_highlighting' => [
        /*
         * To highlight code, we'll use Shiki under the hood. Make sure it's installed.
         *
         * More info: https://spatie.be/docs/laravel-markdown/v1/installation-setup
         */
        'enabled' => true,

        /*
         * The name of or path to a Shiki theme
         *
         * More info: https://github.com/shikijs/shiki/blob/master/docs/themes.md
         */
        'theme' => 'material-theme-palenight',
    ],

    /*
     * When enabled, anchor links will be added to all titles
     */
    'add_anchors_to_headings' => true,

    /*
     * These options will be passed to the league/commonmark package which is
     * used under the hood to render markdown.
     *
     * More info: https://spatie.be/docs/laravel-markdown/v1/using-the-blade-component/passing-options-to-commonmark
     */
    'commonmark_options' => [],

    /*
     * Rendering markdown to HTML can be resource intensive. By default
     * we'll cache the results.
     *
     * You can specify the name of a cache store here. When set to `null`
     * the default cache store will be used. If you do not want to use
     * caching set this value to `false`.
     */
    'cache_store' => null,

    /*
     * This class will convert markdown to HTML
     *
     * You can change this to a class of your own to greatly
     * customize the rendering process
     *
     * More info: https://spatie.be/docs/laravel-markdown/v1/advanced-usage/customizing-the-rendering-process
     */
    'renderer_class' => \Spatie\LaravelMarkdown\MarkdownRenderer::class,

    /*
     * These extensions should be added to the markdown environment. A valid
     * extension implements League\CommonMark\Extension\ExtensionInterface
     *
     * More info: https://commonmark.thephpleague.com/2.1/extensions/overview/
     */
    'extensions' => [
        //
    ],

    /*
     * These block renderers should be added to the markdown environment. A valid
     * renderer implements League\CommonMark\Renderer\NodeRendererInterface;
     *
     * More info: https://commonmark.thephpleague.com/2.1/customization/rendering/
     */
    'block_renderers' => [
		['class' => BlockQuote::class, 'renderer' => new BlockQuoteRenderer(), 'priority' => 1],
		['class' => Heading::class, 'renderer' => new HeadingRenderer(), 'priority' => 1],
		['class' => ListItem::class, 'renderer' => new ListItemRenderer(), 'priority' => 1],
		['class' => Paragraph::class, 'renderer' => new ParagraphRenderer(), 'priority' => 1],
		['class' => ThematicBreak::class, 'renderer' => new ThematicBreakRenderer(), 'priority' => 1],
    ],

    /*
     * These inline renderers should be added to the markdown environment. A valid
     * renderer implements League\CommonMark\Renderer\NodeRendererInterface;
     *
     * More info: https://commonmark.thephpleague.com/2.1/customization/rendering/
     */
    'inline_renderers' => [
		['class' => Code::class, 'renderer' => new CodeRenderer(), 'priority' => 1],
		['class' => Link::class, 'renderer' => new LinkRenderer(), 'priority' => 1],
    ],

    /*
     * These inline parsers should be added to the markdown environment. A valid
     * parser implements League\CommonMark\Renderer\InlineParserInterface;
     *
     * More info: https://commonmark.thephpleague.com/2.3/customization/inline-parsing/
     */
    'inline_parsers' => [
        // ['parser' => new MyCustomInlineParser(), 'priority' => 0]
    ],
];

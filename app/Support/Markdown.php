<?php

namespace App\Support;

use Illuminate\Support\HtmlString;
use League\CommonMark\CommonMarkConverter;
use League\CommonMark\Environment;
use League\CommonMark\Ext\Table\TableExtension;
use League\CommonMark\Ext\Autolink\AutolinkExtension;

class Markdown
{
    /**
     * Parse the given Markdown text into HTML.
     *
     * @param  string  $text
     *
     * @return HtmlString
     */
    public static function parse($text)
    {
        $environment = Environment::createCommonMarkEnvironment();

        $environment->addExtension(new TableExtension());
        $environment->addExtension(new AutolinkExtension());

        $converter = new CommonMarkConverter([
            'html_input'         => 'escape',
            'allow_unsafe_links' => false,
        ], $environment);

        return new HtmlString($converter->convertToHtml($text));
    }
}

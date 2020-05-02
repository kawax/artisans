<?php

namespace App\Support;

use Illuminate\Support\HtmlString;
use League\CommonMark\GithubFlavoredMarkdownConverter;

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
        $converter = new GithubFlavoredMarkdownConverter(
            [
                'html_input'         => 'escape',
                'allow_unsafe_links' => false,
            ]
        );

        return new HtmlString($converter->convertToHtml($text ?? ''));
    }
}

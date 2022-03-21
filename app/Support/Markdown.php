<?php

namespace App\Support;

use Illuminate\Support\HtmlString;
use League\CommonMark\GithubFlavoredMarkdownConverter;

class Markdown
{
    /**
     * Parse the given Markdown text into HTML.
     *
     * @param  string|null  $text
     * @return HtmlString
     */
    public static function parse(?string $text): HtmlString
    {
        $converter = new GithubFlavoredMarkdownConverter(
            [
                'html_input'         => 'escape',
                'allow_unsafe_links' => false,
            ]
        );

        return new HtmlString($converter->convert($text ?? '')->getContent());
    }
}

<?php

namespace App;

use Parsedown;
use Illuminate\Support\HtmlString;

class MarkDown
{
    /**
     * Parse the given Markdown text into HTML.
     *
     * @param  string $text
     *
     * @return \Illuminate\Support\HtmlString
     */
    public static function parse($text)
    {
        $parsedown = new Parsedown;

        return new HtmlString($parsedown->setSafeMode(true)->text($text));
    }
}

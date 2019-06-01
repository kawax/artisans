<?php

namespace App\Support;

use Parsedown;
use Illuminate\Support\HtmlString;

class Markdown
{
    /**
     * Parse the given Markdown text into HTML.
     *
     * @param  string  $text
     * @return \Illuminate\Support\HtmlString
     */
    public static function parse($text)
    {
        $parsedown = (new Parsedown())->setSafeMode(true);

        return new HtmlString($parsedown->text($text));
    }
}

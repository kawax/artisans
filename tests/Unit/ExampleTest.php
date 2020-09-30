<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBasicTest()
    {
        $this->assertTrue(true);
    }

    public function testStrWordWrap()
    {
        $text = Str::wordwrap('abｃあいうｱｲｳ', 3);

        $this->assertEquals('abc'.PHP_EOL.'あいう'.PHP_EOL.'アイウ', $text);
    }
}

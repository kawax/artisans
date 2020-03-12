<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Tweet extends Component
{
    /**
     * @var string
     */
    public $url;

    /**
     * Create a new component instance.
     *
     * @param  string  $url
     *
     * @return void
     */
    public function __construct(string $url = null)
    {
        $this->url = $url;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.tweet');
    }
}

<?php

namespace App\Http\Controllers;

use App\Model\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  Request  $request
     * @param  Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, Tag $tag)
    {
        $users = $tag->users()->artisans();

        return view('tag.show')->with(compact('users', 'tag'));
    }
}

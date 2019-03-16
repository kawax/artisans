<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Model\Tag;

class TagController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  Request $request
     * @param  Tag     $tag
     *
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, Tag $tag)
    {
        $tag->load('users');

        $users = $tag->users()->artisans();

        return view('tag.show')->with(compact('users', 'tag'));
    }
}

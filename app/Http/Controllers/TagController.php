<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Model\Tag;

class TagController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  string                   $name
     *
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, $name)
    {
        $tag = Tag::whereTag($name)->with('users')->firstOrFail();

        $users = $tag->users()->artisans();

        return view('tag.show')->with(compact('users', 'tag'));
    }
}

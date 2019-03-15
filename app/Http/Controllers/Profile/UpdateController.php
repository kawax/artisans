<?php

namespace App\Http\Controllers\Profile;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Model\Tag;

class UpdateController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $request->user()->fill($request->only([
            'title',
            'message',
            'hidden',
        ]))->save();


        $tag_id = [];

        foreach ($request->tags as $name) {
            $tag_id[] = Tag::updateOrCreate([
                'tag' => $name,
            ], [
                'tag' => $name,
            ])->id;
        }

        $request->user()->tags()->sync($tag_id);

        return response()->json(['message' => 'OK']);
    }
}

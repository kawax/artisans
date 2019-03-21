<?php

namespace App\Http\Controllers\Profile;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Model\Tag;

class UpdateController extends Controller
{
    /**
     * プロフィール変更
     *
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

        foreach ($request->tags as $tag) {
            $tag_id[] = Tag::firstOrCreate([
                'tag' => $tag,
            ])->id;
        }

        $request->user()->tags()->sync($tag_id);

        return response()->json(['message' => 'OK']);
    }
}

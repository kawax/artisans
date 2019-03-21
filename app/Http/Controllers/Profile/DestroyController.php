<?php

namespace App\Http\Controllers\Profile;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DestroyController extends Controller
{
    /**
     * アカウント削除
     *
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $request->user()->destroy($request->user()->id);

        auth()->logout();

        return redirect('/');
    }
}

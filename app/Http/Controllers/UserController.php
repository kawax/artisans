<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Model\User;

class UserController extends Controller
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
        $user = User::whereName($name)->with('tags')->firstOrFail();

        return view('user.show')->with(compact('user'));
    }
}

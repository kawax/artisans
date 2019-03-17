<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Model\User;

class UserController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  Request $request
     * @param  User    $user
     *
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, User $user)
    {
        return view('user.show')->with(compact('user'));
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Model\User;

class HomeController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $users = User::artisans();

        return view('home')->with(compact('users'));
    }
}

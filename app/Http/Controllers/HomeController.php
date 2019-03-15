<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Model\User;

class HomeController extends Controller
{
    public function __invoke()
    {
        $users = User::artisans();

        return view('home')->with(compact('users'));
    }
}

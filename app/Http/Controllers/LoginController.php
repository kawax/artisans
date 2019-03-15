<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Laravel\Socialite\Facades\Socialite;

use App\Model\User;

class LoginController extends Controller
{
    public function login()
    {
        return Socialite::driver('github')
                        ->setScopes(['read:user'])
                        ->redirect();
    }

    public function callback(Request $request)
    {
        if (! $request->has('code')) {
            return redirect('/');
        }

        /**
         * @var \Laravel\Socialite\Two\User $user
         */
        $user = Socialite::driver('github')->user();

        /**
         * @var \App\Model\User $loginUser
         */
        $loginUser = User::updateOrCreate(
            [
                'id' => $user->id,
            ],
            [
                'name'   => $user->nickname,
                'avatar' => $user->avatar,
            ]);

        auth()->login($loginUser, true);

        return redirect()->route('user', $loginUser->name);
    }

    public function logout()
    {
        auth()->logout();

        return redirect('/');
    }
}

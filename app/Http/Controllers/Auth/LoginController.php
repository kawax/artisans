<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Model\User;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;

class LoginController extends Controller
{
    /**
     * @return mixed
     */
    public function login()
    {
        return Socialite::driver('github')
                        ->setScopes(['read:user'])
                        ->redirect();
    }

    /**
     * @param  Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function callback(Request $request)
    {
        if (! $request->has('code')) {
            return redirect('/');
        }

        $loginUser = $this->user();

        auth()->login($loginUser, true);

        return redirect()->route('user', $loginUser->name);
    }

    /**
     * @return User
     */
    protected function user()
    {
        /**
         * @var \Laravel\Socialite\Two\User
         */
        $user = Socialite::driver('github')->user();

        return User::updateOrCreate([
            'id' => $user->id,
        ], [
            'name'   => $user->nickname,
            'avatar' => $user->avatar,
        ]);
    }

    /**
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function logout()
    {
        auth()->logout();

        return redirect('/');
    }
}

<?php

namespace App\Http\Controllers\Api;

use App\Model\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Api\UserResource;

class UserController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  Request  $request
     * @return mixed
     */
    public function __invoke(Request $request)
    {
        $page = max(1, min(100, $request->input('limit', 20)));

        $users = User::search($request->input('q'))
                     ->artisans($page)
                     ->appends('q', $request->input('q'));

        return UserResource::collection($users);
    }
}

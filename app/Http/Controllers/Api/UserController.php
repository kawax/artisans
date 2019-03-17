<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Resources\Api\UserResource;
use App\Model\User;

class UserController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  Request $request
     *
     * @return mixed
     */
    public function __invoke(Request $request)
    {
        $users = User::search($request->input('q'))
                     ->artisans(max(1, min(100, $request->input('limit', 20))))
                     ->appends('q', $request->input('q'));

        return UserResource::collection($users);
    }
}

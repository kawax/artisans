<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use App\Http\Resources\Profile\UserResource;
use Illuminate\Http\Request;

class MeController extends Controller
{
    /**
     * 変更時用のjsonデータ
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return UserResource
     */
    public function __invoke(Request $request)
    {
        return new UserResource($request->user());
    }
}

<?php

namespace App\Http\Controllers\Profile;

use App\Jobs\ProfileUpdateJob;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\UpdateRequest;

class UpdateController extends Controller
{
    /**
     * プロフィール変更
     * Handle the incoming request.
     *
     * @param  UpdateRequest  $request
     * @return mixed
     */
    public function __invoke(UpdateRequest $request)
    {
        ProfileUpdateJob::dispatchNow($request);

        return response()->json(['message' => 'OK']);
    }
}

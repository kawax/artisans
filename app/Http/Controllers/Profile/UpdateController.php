<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\UpdateRequest;
use App\Jobs\ProfileUpdateJob;

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

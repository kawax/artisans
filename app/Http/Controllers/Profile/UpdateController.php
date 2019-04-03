<?php

namespace App\Http\Controllers\Profile;

use Illuminate\Http\Response;
use App\Http\Controllers\Controller;

use App\Jobs\ProfileUpdateJob;
use App\Http\Requests\User\UpdateRequest;

class UpdateController extends Controller
{
    /**
     * プロフィール変更
     *
     * Handle the incoming request.
     *
     * @param  UpdateRequest  $request
     *
     * @return Response
     */
    public function __invoke(UpdateRequest $request)
    {
        ProfileUpdateJob::dispatchNow($request);

        return response()->json(['message' => 'OK']);
    }
}

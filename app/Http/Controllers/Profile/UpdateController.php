<?php

namespace App\Http\Controllers\Profile;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;

use App\Jobs\ProfileUpdateJob;

class UpdateController extends Controller
{
    /**
     * プロフィール変更
     *
     * Handle the incoming request.
     *
     * @param  Request  $request
     *
     * @return Response
     */
    public function __invoke(Request $request)
    {
        ProfileUpdateJob::dispatchNow($request);

        return response()->json(['message' => 'OK']);
    }
}

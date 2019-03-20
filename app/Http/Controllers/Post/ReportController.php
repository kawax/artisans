<?php

namespace App\Http\Controllers\Post;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Notification;
use App\Notifications\PostReportNotification;
use App\Model\Post;

class ReportController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param Post                      $post
     *
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, Post $post)
    {
        Notification::route('discord', config('services.discord.channel.post_report'))
                    ->notify(new PostReportNotification($post, $request->user(), $request->input('reason')));

        return response()->json(['message' => 'OK']);
    }
}

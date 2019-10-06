<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use App\Model\Post;
use App\Notifications\PostReportNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

class ReportController extends Controller
{
    /**
     * 報告
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Post  $post
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, Post $post)
    {
        Notification::route('discord', config('services.discord.channel.post_report'))
                    ->notify(new PostReportNotification($post, $request->user(), $request->input('reason')));

        return response()->json(['message' => 'OK']);
    }
}

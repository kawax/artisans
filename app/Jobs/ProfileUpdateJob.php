<?php

namespace App\Jobs;

use App\Models\Tag;
use Illuminate\Bus\Queueable;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Http\Request;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ProfileUpdateJob
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    /**
     * Create a new job instance.
     *
     * @param  Request  $request
     *
     * @return void
     */
    public function __construct(public Request $request)
    {
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this->request->user()->fill(
            $this->request->only(
                [
                    'title',
                    'message',
                    'hidden',
                ]
            )
        )->save();

        $tag_id = [];

        foreach ($this->request->tags as $tag) {
            $tag_id[] = Tag::firstOrCreate(
                [
                    'tag' => $tag,
                ]
            )->id;
        }

        $this->request->user()->tags()->sync($tag_id);
    }
}

<?php

namespace App\Jobs;

use App\Model\Tag;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Http\Request;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ProfileUpdateJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var Request
     */
    public $request;

    /**
     * Create a new job instance.
     *
     * @param  Request  $request
     *
     * @return void
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
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

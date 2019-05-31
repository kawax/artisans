<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;

use NotificationChannels\Discord\DiscordChannel;
use NotificationChannels\Discord\DiscordMessage;

use Illuminate\Notifications\Channels\SlackWebhookChannel;
use Illuminate\Notifications\Messages\SlackMessage;

use App\Model\Post;

class PostNotification extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * @var Post
     */
    protected $post;

    /**
     * @var string
     */
    protected $event;

    /**
     * Create a new notification instance.
     *
     * @param  Post  $post
     * @param  string  $event
     *
     * @return void
     */
    public function __construct(Post $post, string $event = 'created')
    {
        $this->post = $post;
        $this->event = $event;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     *
     * @return array
     */
    public function via($notifiable)
    {
        return [DiscordChannel::class, SlackWebhookChannel::class];
    }

    public function toDiscord($notifiable)
    {
        return DiscordMessage::create("[{$this->event}]".PHP_EOL.route('post.show', $this->post), [
            'author'    => [
                'name'     => $this->post->user->name,
                'url'      => route('user', $this->post->user),
                'icon_url' => $this->post->user->avatar,
            ],
            'title'     => $this->post->title,
            //'description' => $this->post->message,
            'url'       => route('post.show', $this->post),
            'image'     => [
                'url' => route('image.post', $this->post),
            ],
            'timestamp' => $this->post->created_at,
            'color'     => 15156272,
        ]);
    }

    public function toSlack($notifiable)
    {
        return (new SlackMessage())->from('artisans')
                                   ->content("[{$this->event}]".PHP_EOL.route('post.show', $this->post))
                                   ->attachment(function ($attachment) {
                                       $attachment->title($this->post->title, route('post.show', $this->post))
                                                  ->color(config('artisans.primary'));
                                   });
    }
}

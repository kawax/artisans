<?php

namespace App\Notifications;

use App\Models\Post;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;
use NotificationChannels\Discord\DiscordChannel;
use NotificationChannels\Discord\DiscordMessage;

class PostReportNotification extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * @var Post
     */
    public $post;

    /**
     * @var User
     */
    public $user;

    /**
     * @var string
     */
    public $reason;

    /**
     * Create a new notification instance.
     *
     * @param  Post  $post
     * @param  User  $user
     * @param  string  $reason
     * @return void
     */
    public function __construct(Post $post, User $user, string $reason)
    {
        $this->post = $post;
        $this->user = $user;
        $this->reason = $reason;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return [DiscordChannel::class];
    }

    public function toDiscord($notifiable)
    {
        return DiscordMessage::create(route('post.show', $this->post), [
            'author'      => [
                'name'     => $this->user->name,
                'url'      => route('user', $this->user),
                'icon_url' => $this->user->avatar,
            ],
            'title'       => $this->post->title,
            'description' => $this->reason,
            'url'         => route('post.show', $this->post),
            'color'       => 15156272,
        ]);
    }
}

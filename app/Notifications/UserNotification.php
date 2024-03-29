<?php

namespace App\Notifications;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Channels\SlackWebhookChannel;
use Illuminate\Notifications\Messages\SlackMessage;
use Illuminate\Notifications\Notification;
use NotificationChannels\Discord\DiscordChannel;
use NotificationChannels\Discord\DiscordMessage;

class UserNotification extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @param  User  $user
     * @param  string  $event
     * @return void
     */
    public function __construct(
        protected User $user,
        protected string $event = 'created'
    ) {
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        if ($this->user->hidden) {
            return [];
        }

        return [DiscordChannel::class, SlackWebhookChannel::class];
    }

    public function toDiscord($notifiable)
    {
        $embed = [
            'author' => [
                'name' => $this->user->name,
                'url' => route('user', $this->user),
                'icon_url' => $this->user->avatar,
            ],
            'title' => $this->user->title,
            'description' => $this->user->message,
            'url' => route('user', $this->user),
            'timestamp' => $this->user->updated_at,
            'color' => 15156272,
        ];

        return DiscordMessage::create("[$this->event]".PHP_EOL.route('user', $this->user));
    }

    public function toSlack($notifiable)
    {
        return (new SlackMessage())
            ->from('artisans')
            ->content("[$this->event]".PHP_EOL.route('user', $this->user));
    }
}

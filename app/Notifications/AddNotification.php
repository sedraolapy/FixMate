<?php

namespace App\Notifications;

use App\Models\Notification as ModelsNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Notification;

class AddNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public string $title;
    public string $body;
    public string $sendTo;

    public function __construct(string $title = '', string $body = '', string $sendTo = 'all')
    {
        $this->title  = $title;
        $this->body   = $body;
        $this->sendTo = $sendTo;
    }

    /**
     * Create a notification record and attach recipients.
     *
     * @param  string   $title
     * @param  string   $body
     * @param  iterable $recipients   Can be array or Collection of recipients
     * @param  string   $sendTo
     * @return ModelsNotification
     */
    public static function createForRecipients(
        ModelsNotification $notification,
        iterable $recipients = []
    ): ModelsNotification {
        foreach ($recipients as $recipient) {
            if (!is_object($recipient) || !isset($recipient->id)) {
                continue;
            }

            $notification->recipients()->create([
                'notification_id' => $notification->id,
                'recipient_id'    => $recipient->id,
                'recipient_type'  => get_class($recipient),
            ]);

            $recipient->notify(new self($notification->title, $notification->body, $notification->send_to));
        }

        return $notification;
    }


    /**
     * Notification channels
     */
    public function via($notifiable): array
    {
        return ['broadcast']; // no DB, since we already store manually
    }

    /**
     * Broadcast message payload
     */
    public function toBroadcast($notifiable): BroadcastMessage
    {
        return new BroadcastMessage([
            'title'   => $this->title,
            'body'    => $this->body,
            'send_to' => $this->sendTo,
        ]);
    }

    public function toArray($notifiable): array
    {
        return [];
    }
}
